<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductCartController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $cart = session()->get('cart', []);
        $total = array_sum(array_map(function($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));
        return view('layouts.index', compact('products', 'cart', 'total'));
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:products,id',
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|url',
        ]);

        $cart = session()->get('cart', []);
        $id = $request->id;

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'id' => $id,
                'name' => $request->name,
                'price' => (float) $request->price,
                'quantity' => 1,
                'image' => $request->image,
            ];
        }

        session()->put('cart', $cart);

        return response()->json(['message' => 'Product added to cart successfully!']);
    }

    public function updateCart(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);
        $id = $request->id;

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
            return response()->json(['message' => 'Cart updated successfully!']);
        }

        return response()->json(['message' => 'Product not found in cart.'], 404);
    }

    public function removeFromCart(Request $request)
    {
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
