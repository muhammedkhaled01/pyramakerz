<?php

namespace App\Http\Controllers\dashboard_user;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {

        return view("user.dashboard.index");
    }
    public function myProducts()
    {
        $auth = Auth()->user()->id;
        // dd($auth);
        $products = Product::where("user_id", $auth)->get();
        return view("user.dashboard.my-products", compact("products"));
    }
    public function myOrders()
    {
        $auth = Auth()->user()->id;
        // dd($auth);
        $orders = Order::where("user_id", $auth)->get();
        return view("user.dashboard.orders.index", compact("orders"));
    }
}
