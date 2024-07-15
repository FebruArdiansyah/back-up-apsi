<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = false; // Set to true for production
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function index()
    {
        $cart = session()->get('cart', []);
        return view('midtrans.checkout', compact('cart'));
    }

    public function process(Request $request)
    {
        $cart = session()->get('cart', []);
        $total = array_sum(array_map(function($item) {
            return $item['quantity'] * $item['price'];
        }, $cart));

        if ($total < 0.01) {
            return response()->json(['message' => 'Invalid total amount'], 400);
        }

        $name = $request->input('name');
        $no_telepon = $request->input('no_telepon');
        $email = $request->input('email');
        $alamat = $request->input('alamat');
        $pengiriman = $request->input('pengiriman');

        // Generate a unique order ID
        $orderId = uniqid('order');

        $order = Order::create([
            'name' => $name,
            'no_telepon' => $no_telepon,
            'email' => $email,
            'alamat' => $alamat,
            'pengiriman' => $pengiriman,
            'total' => $total,
            'status' => 'pending',
        ]);

        foreach ($cart as $id => $details) {
            $order->products()->attach($id, ['quantity' => $details['quantity']]);
        }

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $total,
            ],
            'customer_details' => [
                'first_name' => $name,
                'email' => $email,
                'phone' => $no_telepon,
                'address' => $alamat,
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            return response()->json(['snapToken' => $snapToken, 'order_id' => $order->id]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function callback(Request $request)
    {
        // Log the received callback request
        Log::info('Callback received', $request->all());
    
        // Retrieve the server key from the configuration
        $server_key = config('services.midtrans.server_key');
    
        // Create a hash using the received data and server key
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $server_key);
    
        // Check if the created hash matches the received signature key
        if ($hashed == $request->signature_key) {
            Log::info('Signature valid', ['order_id' => $request->order_id, 'transaction_status' => $request->transaction_status]);
            $transactionStatus = $request->transaction_status;
    
            // Extract the order ID from the received order ID
            $orderIdParts = explode('_', $request->order_id);
            $orderId = $orderIdParts[1];
    
            // Find the order using the extracted order ID
            $order = Order::find($orderId);
    
            if ($order) {
                // Update the order status based on the transaction status
                if (in_array($transactionStatus, ['capture', 'settlement'])) {
                    $order->update(['status' => Order::STATUS['terbayar']]);
                    Log::info('Order status updated to Terbayar', ['order_id' => $orderId]);
                } elseif ($transactionStatus == 'pending') {
                    $order->update(['status' => 'pending']);
                    Log::info('Order status updated to Pending', ['order_id' => $orderId]);
                } else {
                    $order->update(['status' => Order::STATUS['belum terbayar']]);
                    Log::info('Order status updated to Belum Terbayar', ['order_id' => $orderId]);
                }
    
                // Respond with a success message
                return response()->json(['message' => 'Payment status updated.']);
            } else {
                // Respond with an error message if the order is not found
                Log::error('Order not found', ['order_id' => $orderId]);
                return response()->json(['message' => 'Order not found.'], 404);
            }
        } else {
            // Respond with an error message if the signature is invalid
            Log::error('Invalid signature', ['order_id' => $request->order_id]);
            return response()->json(['message' => 'Invalid signature.'], 400);
        }
    }
    

    

    public function showOrder($id)
{
    $order = Order::findOrFail($id);

    // If 'product' is a comma-separated string in the order table
    $products = explode(',', $order->product);

    return view('midtrans.showorder', compact('order', 'products'));
}

    
}