<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\UploadProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UploadProductController extends Controller
{
    public function uploadProduct()
    {
        return view("upload-products");
    }
    public function storeUploadProduct(Request $request)
    {
        $auth = Auth::user()->id;

        $request->validate([

            'photo' => 'required|image|mimes:jpeg,png,jpg,gif',
            'product_file' => 'required|mimes:pdf,doc,docx',
        ]);

        if ($request->hasFile('photo')) {

            $image = $request->file('photo');
            $imageName = time() . "-" . "image" . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images/products-upload'), $imageName);
        }

        if ($request->hasFile('product_file')) {
            $productFile = $request->file('product_file');
            $productFileName = time() . "-" . "product-upload" . '.' . $productFile->getClientOriginalExtension();
            $productFile->move(public_path('assets/upload/product_files'), $productFileName);
        }
        $data = $request->all();

        $data['photo'] = $imageName;
        $data['product_file'] = $productFileName;
        $data['user_id'] = $auth;
        $data['type'] = "upload";
        $status = Product::create($data);
        if ($status) {
            request()->session()->flash('success', 'Product uploaded successful');
        } else {
            request()->session()->flash('error', 'Try again !!');
        }
        return redirect()->back();
    }
    public function updateUploadProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        // $data = $request->all();

        $data['name'] = $request->name;
        $data['stock'] = 1;
        $data['status'] = "active";
        $data['price'] = $request->price * $request->quantity;
        $status = $product->fill($data)->save();
        // Create an order related to this product
        $orderData = [
            'price' => $request->price  * $request->quantity,
            'quantity' => $request->quantity,
            'user_id' => $request->user_id,
            'product_id' => $product->id,
            'order_number' => 'ORD-' . uniqid(),
            'payment_status' => 'paid',
            'status' => 'pending',
        ];

        // Create an order associated with the updated product
        $status = Order::create($orderData);

        if ($status) {
            request()->session()->flash('success', 'updated successful');
        } else {
            request()->session()->flash('error', 'Try again !!');
        }
        return redirect()->back();
    }
}
