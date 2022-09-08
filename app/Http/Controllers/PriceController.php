<?php

namespace App\Http\Controllers;

use App\Models\Price;
use App\Models\Product;

class PriceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Product $product){
        return view('price.create', ['product' => $product]);
    }

    public function store(Product $product){
        $data = request()->validate([
            'value' => ['required', 'numeric', 'multiple_of:0.01'],
        ]);
        
        Price::create([
            'value' => $data['value'],
            'product_id' => $product->id,
        ]);

        return redirect()->route('product.index')->with('message', 'Price added successfuly');
    }

    public function edit(Price $price){
        return view('price.edit', ['price' => $price]);
    }

    public function update(Price $price){
        $data = request()->validate([
            'value' => ['required', 'numeric', 'multiple_of:0.01'],
        ]);

        $price->value = $data['value'];
        $price->save();

        return redirect()->route('product.index')->with('message', 'Price updated successfuly');
    }

    public function destroy(Price $price){
        $price->delete();
        return redirect()->route('product.index')->with('message', 'Price deleted successfuly');
    }
}
