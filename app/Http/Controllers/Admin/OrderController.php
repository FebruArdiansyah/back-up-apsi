<?php

namespace App\Http\Controllers\Admin;

use Gate;
use App\Http\Requests\MassDestroyOrderRequest;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $currentDateTime = Carbon::now();
        
        $orders = Order::with(['products'])->get();

        return view('admin.orders.index', compact('orders'));
    }

    public function create()
    {
        abort_if(Gate::denies('order_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::all();

        // $availableTables = Table::where('status', 'kosong')->get();

        return view('admin.orders.create', compact('products'));
    }

    public function store(StoreOrderRequest $request)
    {
        $total = 0;
        $quantities = $request->input('quantities');

        foreach ($quantities as $product_id => $quantity) {
            $product = Product::find($product_id);
            if ($product->stock < $quantity) {
                return redirect()->back()->withErrors(['error' => 'Stock for product ' . $product->name . ' is insufficient.']);
            }
            $total += $product->price * $quantity;
        }

        $order = Order::create($request->all());

        foreach ($quantities as $product_id => $quantity) {
            $order->products()->attach($product_id, ['quantity' => $quantity]);
        }

        $order->update(['total' => $total]);

        return redirect()->route('admin.orders.index');
    }
    
    
    
    

    public function edit(Order $order)
    {
        abort_if(Gate::denies('order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::all();

        // $tables = Table::all()->pluck('name', 'id');

        return view('admin.orders.edit', compact('order', 'products'));
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        $total = 0;
        $quantities = $request->input('quantities');

        foreach ($quantities as $product_id => $quantity) {
            $product = Product::find($product_id);
            if ($product->stock < $quantity) {
                return redirect()->back()->withErrors(['error' => 'Stock for product ' . $product->name . ' is insufficient.']);
            }
            $total += $product->price * $quantity;
        }
        
        $previousStatus = $order->status;

        $order->update($request->all());

        $order->products()->detach();

        foreach ($quantities as $product_id => $quantity) {
            $order->products()->attach($product_id, ['quantity' => $quantity]);
        }

        $order->update(['total' => $total]);

        // Update stock if status is 'selesai'
        if (in_array($order->status, ['selesai'])) {
            $this->adjustProductStock($order);
        }

        return redirect()->route('admin.orders.index');
    }

    public function show(Order $order)
    {
        abort_if(Gate::denies('ordershow'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $order->load(['products']);

        // $order->load('table');

        return view('admin.orders.show', compact('order_'));
    }

    public function destroy(Order $order)
    {
        abort_if(Gate::denies('order_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $order->delete();

        return back();
    }

    public function massDestroy(MassDestroyOrderRequest $request)
    {
        $orders = Order::find(request('ids'));


        foreach ($orders as $order) {
            $order->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    private function adjustProductStock(Order $order)
    {
        foreach ($order->products as $product) {
            $quantity = $product->pivot->quantity;
            $product->decrement('stock', $quantity);
        }
    }
}
