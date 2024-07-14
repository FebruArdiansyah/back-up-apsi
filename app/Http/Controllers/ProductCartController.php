<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductCartController extends Controller
{
    /**
     * Menampilkan halaman dengan daftar produk dan cart.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $products = Product::all();
        $cart = session()->get('cart', []);
        return view('layouts.index', compact('products', 'cart'));
    }

    /**
     * Menambahkan produk ke dalam cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addToCart(Request $request)
    {
        // Validasi request
        $request->validate([
            'id' => 'required|exists:products,id',
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|url',
        ]);

        $cart = session()->get('cart', []);

        $id = $request->id;
        $product = [
            'id' => $id,
            'name' => $request->name,
            'price' => (float) $request->price,
            'quantity' => 1,
            'image' => $request->image,
        ];

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = $product;
        }

        session()->put('cart', $cart);

        return response()->json(['message' => 'Product added to cart successfully!']);
    }

    /**
     * Menampilkan cart.
     *
     * @return \Illuminate\View\View
     */
    public function showCart()
    {
        $cart = session()->get('cart', []);

        // Hitung total harga
        $total = 0;
        foreach ($cart as $details) {
            $total += $details['price'] * $details['quantity'];
        }

        return view('layouts.index', compact('cart', 'total'));
    }

    /**
     * Memperbarui kuantitas produk dalam cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateCart(Request $request)
    {
        // Validasi request
        $request->validate([
            'id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);
        $id = $request->id;
        $quantity = $request->quantity;

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $quantity;
            session()->put('cart', $cart);
            return response()->json(['message' => 'Cart updated successfully!']);
        }

        return response()->json(['message' => 'Product not found in cart.'], 404);
    }

    /**
     * Menghapus produk dari cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeFromCart(Request $request)
    {
        // Validasi request
        $request->validate([
            'id' => 'required|exists:products,id',
        ]);

        $cart = session()->get('cart', []);
        $id = $request->id;

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            return response()->json(['message' => 'Product removed from cart successfully!']);
        }

        return response()->json(['message' => 'Product not found in cart.'], 404);
    }

    
}
