<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::where("type", "product")->get();
        return view("dashboard.products.index", compact("products"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("dashboard.products.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'string|required',
            'description' => 'string|nullable',
            'photo' => 'required',
            'stock' => "required|numeric",
            'status' => 'required|in:active,inactive',
            'price' => 'required|numeric',
        ]);
        $newImageName = uniqid() . "-" . "product" . "." . $request->photo->extension();
        $request->photo->move(public_path("assets/images/Products"), $newImageName);
        $data = $request->all();

        $data['photo'] = $newImageName;
        $data['type'] = "product";

        $status = Product::create($data);
        if ($status) {
            request()->session()->flash('success', 'Product created successful');
        } else {
            request()->session()->flash('error', 'Try again !!');
        }
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $products = Product::findOrFail($id);
        return view("dashboard.products.edit")->with('product', $products);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);


        $this->validate($request, [
            'name' => 'string|required',
            'description' => 'string|nullable',
            'stock' => "required|numeric",
            'status' => 'required|in:active,inactive',
            'price' => 'required|numeric',
        ]);
        if ($request->has('photo')) {
            $newImageName = uniqid() . "-" . "product" . "." . $request->photo->extension();
        $request->photo->move(public_path("assets/images/Products"), $newImageName);
        $data = $request->all();
        $data['photo'] = $newImageName;


        $status = $product->fill($data)->save();
        }


        $data = $request->all();


        $status = $product->fill($data)->save();
        if ($status) {
            request()->session()->flash('success', 'Product Successfully updated');
        } else {
            request()->session()->flash('error', 'Please try again!!');
        }

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}
