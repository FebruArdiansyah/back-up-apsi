<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

// class CheckoutController extends Controller
// {
//     public function index()
//     {
//         $cart = session()->get('cart', []);

//         // Calculate the total amount
//         $total = array_reduce($cart, function($carry, $item) {
//             return $carry + $item['price'] * $item['quantity'];
//         }, 0);

//         return view('midtrans.checkout', compact('cart', 'total'));
//     }

//     // Controller method 'process' in CheckoutController.php

//     public function process(Request $request)
//     {
//         $request->validate([
//             'name' => 'required|string|max:255',
//             'email' => 'required|string|email|max:255',
//             'no_telepon' => 'required|string|max:15',
//             'alamat' => 'required|string',
//             'total' => 'required|numeric|min:0.01',
//             'cart' => 'required|string',
//         ]);
    
//         $cart = json_decode($request->input('cart'), true);
//         $total = $request->input('total');
//         $name = $request->input('name');
//         $email = $request->input('email');
//         $no_telepon = $request->input('no_telepon');
//         $alamat = $request->input('alamat');
    
//         Log::info('Total amount: ' . $total);
    
//         $order = Order::create([
//             'name' => $name,
//             'email' => $email,
//             'no_telepon' => $no_telepon,
//             'alamat' => $alamat,
//             'total' => $total,
//             'status' => 'pending',
//         ]);
    
//         foreach ($cart as $id => $details) {
//             $order->products()->attach($id, ['quantity' => $details['quantity']]);
//         }
    
//         \Midtrans\Config::$serverKey = config('services.midtrans.server_key');
//         \Midtrans\Config::$isProduction = false;
//         \Midtrans\Config::$isSanitized = true;
//         \Midtrans\Config::$is3ds = true;
    
//         $params = [
//             'transaction_details' => [
//                 'order_id' => $order->id,
//                 'gross_amount' => $total,
//             ],
//             'customer_details' => [
//                 'first_name' => $name,
//                 'email' => $email,
//                 'phone' => $no_telepon,
//                 'shipping_address' => [
//                     'address' => $alamat,
//                 ],
//             ],
//         ];
    
//         try {
//             $snapToken = \Midtrans\Snap::getSnapToken($params);
//         } catch (\Exception $e) {
//             Log::error('Failed to get Snap token: ' . $e->getMessage());
//             return redirect()->back()->with('error', 'Failed to initialize payment');
//         }
    
//         return view('midtrans.checkout', compact('snapToken', 'order', 'cart', 'total'));
//     }


//     public function showCart()
//     {
//         $cart = session()->get('cart', []);

//         // Calculate total price
//         $total = 0;
//         foreach ($cart as $id => $details) {
//             $total += $details['price'] * $details['quantity'];
//         }

//         return view('midtrans.checkout', compact('cart', 'total'));
//     }

//     public function showOrder($id)
//     {
//         $order = Order::with('products')->find($id);
//         if ($order && $order->status != 'Paid') {
//             $order->update(['status' => 'Paid']);

//             // Optional: Insert order into the database for record-keeping
//             try {
//                 // Database insert logic here if needed
//             } catch (\Exception $e) {
//                 // Handle database insert error
//                 Log::error('Failed to save order to database: ' . $e->getMessage());
//             }

//             // Log successful update
//             Log::info('Order status updated to Paid', ['order_id' => $order->id]);
//         }

//         return view('midtrans.showOrder', compact('order'));
//     }
// }

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
        $total = $request->input('total');

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
            'order_id' => $orderId,
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
        Log::info('Callback received', $request->all());

        $server_key = config('midtrans.serverKey');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $server_key);

        Log::info('Callback validation', ['hashed' => $hashed, 'signature_key' => $request->signature_key]);

        if ($hashed == $request->signature_key) {
            $transactionStatus = $request->transaction_status;
            $orderIdParts = explode('_', $request->order_id);
            $orderId = $orderIdParts[1];
            $order = Order::find($orderId);

            if ($order) {
                if (in_array($transactionStatus, ['capture', 'settlement'])) {
                    $order->update(['status' => 'proses']);
                    Log::info('Order status updated to proses', ['order_id' => $order->id]);
                } elseif ($transactionStatus == 'pending') {
                    $order->update(['status' => 'pending']);
                    Log::info('Order status updated to pending', ['order_id' => $order->id]);
                } else {
                    $order->update(['status' => 'failed']);
                    Log::info('Order status updated to failed', ['order_id' => $order->id]);
                }

                return response()->json(['message' => 'Payment status updated.']);
            } else {
                Log::warning('Order not found', ['order_id' => $request->order_id]);
                return response()->json(['message' => 'Order not found.'], 404);
            }
        } else {
            Log::warning('Callback validation failed', ['hashed' => $hashed, 'signature_key' => $request->signature_key]);
            return response()->json(['message' => 'Invalid signature.'], 400);
        }
    }

    public function success(Order $order)
    {
        return view('order_success', compact('order'));
    }
}
