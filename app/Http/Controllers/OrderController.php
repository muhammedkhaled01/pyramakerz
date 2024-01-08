<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view("dashboard.orders.index", compact("orders"));
    }
    public function update(Order $order, Request $request)
    {
        $order->update(['status' => $request->status]);
        return redirect()->back()->with("success", "The {$order->product->name} changed to {$request->status}");
    }
    public function pending()
    {
        $orders = Order::where("status", 'pending')->get();
        return view("dashboard.orders.pending", compact("orders"));
    }
    public function processing()
    {
        $orders = Order::where("status", 'processing')->get();
        return view("dashboard.orders.processing", compact("orders"));
    }
    public function completed()
    {
        $orders = Order::where("status", 'completed')->get();
        return view("dashboard.orders.completed", compact("orders"));
    }
    public function cancelled()
    {
        $orders = Order::where("status", 'cancelled')->get();
        return view("dashboard.orders.cancelled", compact("orders"));
    }
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('order')->with('success', 'Order deleted successfully');
    }
}
