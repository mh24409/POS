<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('client')->get();
        return view('Dashboard.Orders.index', compact('orders'));
    }
    public function products(Order $order)
    {
        $products = $order->products;

        return view('Dashboard.Orders._products', compact('order', 'products'));
    }
    public function destroy(Order $order)
    {

        foreach ($order->products as $product) {
            $product->update([
                'stock' => $product->stock + $product->pivot->quantity,
            ]);
        }
        $order->delete();
        session()->flash('success', _('site.deleted_success'));
        return redirect()->route('dashboard.orders.index');
    }
}
