<?php
namespace App\Http\Controllers\Admin;

use Gate;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class HistoryOrderController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('history_order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // Assuming 'products' is the correct relationship name
        $orders = Order::with('products')->get();

        return view('admin.history_orders.index', compact('orders'));
    }
}
