<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\UploadProduct;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::all()->count();
        $products =  Product::all()->count();
        $orders = Order::all()->count();
        $orderPending = Order::where("status", "pending")->count();
        return view("dashboard.index",  compact("users", 'products', 'orders', "orderPending"));
    }
    public function users()
    {
        $users = User::all();
        return view("dashboard.users.index", compact("users"));
    }
    public function userDelete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users')->with('success', 'User deleted successfully');
    }
    public function productUploaded()
    {
        $products = Product::where("type", "upload")->get();
        return view("dashboard.product-upload.index", compact("products"));
    }
}
