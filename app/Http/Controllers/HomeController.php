<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::where("type", 'product')->get();
        return view("index", compact("products"));
    }
    public function productView($id)
    {
        $products = Product::findOrFail($id);
        return view("product-view")->with("products", $products);
    }
    public function storeProductOrder(Request $request)
    {
        // $product = Product::findOrFail($id);
        $data = $request->all();
        $data['order_number'] = 'ORD-' . uniqid();
        $data['payment_status'] = 'paid';
        $data['status'] = 'pending';
        $data['price'] = $request->price * $request->quantity;
        $status = Order::create($data);
        if ($status) {
            request()->session()->flash('success', 'Order created successful');
        } else {
            request()->session()->flash('error', 'Try again !!');
        }
        return redirect()->back();
    }

    public function logout()
    {
        //logout user
        auth()->logout();
        // redirect to homepage
        return redirect('/');
    }
}
