<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        return view('index')->with('products', Product::orderByDesc('created_at')->get());
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->save();
        return redirect()->route('index')->with('success', 'New product added');
    }

    public function show(Request $request)
    {
        $product = Product::findOrFail($request->id);
        return view('show')->with('product', $product);
    }

    public function edit(Request $request)
    {
        $product = Product::findOrFail($request->id);
        return view('edit')->with('product', $product);
    }

    public function update(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->save();
        return redirect()->route('index')->with('success', 'Product ' . $request->id . ' has been updated');
    }

    public function destroy(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->delete();
        return redirect()->route('index')->with('success-delete', 'Product ' . $request->id . ' has been deleted');
    }
}
