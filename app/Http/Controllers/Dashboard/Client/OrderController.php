<?php

namespace App\Http\Controllers\Dashboard\Client;

use App\Models\Order;
use App\Models\Client;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{

    public function index()
    {

        return view('Dashboard.Clients.Orders.index');
    }


    public function create(client $client)
    {
        $categories = Category::with('products')->get();
        $orders = $client->orders()->with('products')->get();
        return view('Dashboard.Clients.Orders.create', compact('categories', 'orders', 'client'));
    }

    public function store(Request $request, Client $client)
    {
        // return $request->all();
        //return $client;
        $request->validate([
            'products' => 'required|array',
        ]);
        $this->attach_order($request, $client);
        session()->flash('success', __('site.created_success'));

        return redirect()->route('dashboard.orders.index');
    }


    public function edit(Client $client, Order $order)
    {
        $categories = Category::with('products')->get();
        //return $order;
        return view('Dashboard.Clients.Orders.edit', compact('order', 'client', 'categories'));
    }

    public function update(Request $request,  Client $client, Order $order)
    {
        DB::transaction(function () {


            $request->validate([
                'products' => 'required|array',
            ]);
            $this->detach_order($order);
            $this->attach_order($request, $client);

            session()->flash('success', __('site.updated_success'));

            return redirect()->route('dashboard.orders.index');
        });
    }


    private function attach_order($request, $client)
    {
        $order = $client->orders()->create([]);
        $order->products()->attach($request->products);
        $total_price = 0;
        foreach ($request->products as $id => $quantity) {
            $product = Product::findOrFail($id);
            $total_price += $product->sale_price * $quantity['quantity'];
            $product->update([
                'stock' => $product->stock - $quantity['quantity'],
            ]);
        }
        $order->update([
            'total_price' => $total_price,
        ]);
    }
    private function detach_order($order)
    {

        foreach ($order->products as $product) {
            $product->update([
                'stock' => $product->stock + $product->pivot->quantity,
            ]);
        }
        $order->delete();
    }
}
