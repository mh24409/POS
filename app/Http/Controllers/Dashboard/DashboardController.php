<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Order;
use App\Models\Client;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $categories = Category::count();
        $clients = Client::count();
        $users = User::whereRoleIs('admin')->count();
        $products = Product::count();
         $sales_data = Order::select(
            DB::raw('year(created_at) as year'),
            DB::raw('month(created_at) as month'),
            DB::raw('sum(total_price) as sum'),
        )->groupBy('month')->get();
        return view('Dashboard.index', compact('categories', 'clients', 'users', 'products','sales_data'));
    }
}
