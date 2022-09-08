<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    public function index(){
        $products = Product::all();

        return view('product.index', ['products' => $products]);
    }

    public function create(){
        return view('product.create');
    }

    public function store(){
        $data = request()->validate([
            'name' => ['required', 'max:255', 'string', 'unique:products'],
            'description' => ['required', 'string'],
        ]);

        Product::create($data);

        return redirect()->route('product.index')->with('message', 'Product added successfuly');
    }

    public function edit(Product $product){
        return view('product.edit', ['product' => $product]);
    }

    public function update(Product $product){
        $data = request()->validate([
            'name' => ['required', 'max:255', 'string', 'unique:products'],
            'description' => ['required', 'string'],
        ]);

        $product->name = $data['name'];
        $product->description = $data['description'];

        $product->save();
        return redirect()->route('product.index')->with('message', 'Product edited successfuly');
    }

    public function destroy(Product $product){
        $product->delete();
        return redirect()->route('product.index')->with('message', 'Product deleted successfuly');
    }
}
