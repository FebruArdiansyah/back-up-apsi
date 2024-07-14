<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        // Calculate the total amount
        $total = array_reduce($cart, function($carry, $item) {
            return $carry + $item['price'] * $item['quantity'];
        }, 0);

        return view('midtrans.checkout', compact('cart', 'total'));
    }

    // Controller method 'process' in CheckoutController.php

    public function process(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'no_telepon' => 'required|string|max:15',
            'alamat' => 'required|string',
            'total' => 'required|numeric|min:0.01',
            'cart' => 'required|string',
        ]);
    
        $cart = json_decode($request->input('cart'), true);
        $total = $request->input('total');
        $name = $request->input('name');
        $email = $request->input('email');
        $no_telepon = $request->input('no_telepon');
        $alamat = $request->input('alamat');
    
        Log::info('Total amount: ' . $total);
    
        $order = Order::create([
            'name' => $name,
            'email' => $email,
            'no_telepon' => $no_telepon,
            'alamat' => $alamat,
            'total' => $total,
            'status' => 'pending',
        ]);
    
        foreach ($cart as $id => $details) {
            $order->products()->attach($id, ['quantity' => $details['quantity']]);
        }
    
        \Midtrans\Config::$serverKey = config('services.midtrans.server_key');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
    
        $params = [
            'transaction_details' => [
                'order_id' => $order->id,
                'gross_amount' => $total,
            ],
            'customer_details' => [
                'first_name' => $name,
                'email' => $email,
                'phone' => $no_telepon,
                'shipping_address' => [
                    'address' => $alamat,
                ],
            ],
        ];
    
        try {
            $snapToken = \Midtrans\Snap::getSnapToken($params);
        } catch (\Exception $e) {
            Log::error('Failed to get Snap token: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to initialize payment');
        }
    
        return view('midtrans.checkout', compact('snapToken', 'order', 'cart', 'total'));
    }


    public function showCart()
    {
        $cart = session()->get('cart', []);

        // Calculate total price
        $total = 0;
        foreach ($cart as $id => $details) {
            $total += $details['price'] * $details['quantity'];
        }

        return view('midtrans.checkout', compact('cart', 'total'));
    }

    public function showOrder($id)
    {
        $order = Order::with('products')->find($id);
        if ($order && $order->status != 'Paid') {
            $order->update(['status' => 'Paid']);

            // Optional: Insert order into the database for record-keeping
            try {
                // Database insert logic here if needed
            } catch (\Exception $e) {
                // Handle database insert error
                Log::error('Failed to save order to database: ' . $e->getMessage());
            }

            // Log successful update
            Log::info('Order status updated to Paid', ['order_id' => $order->id]);
        }

        return view('midtrans.showOrder', compact('order'));
    }
}
