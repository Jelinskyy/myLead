<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_view_responding()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertViewIs('product.index');
    }

    public function test_view_listing_every_product_and_price()
    {
        $products = Product::all();
        $arr = [];

        foreach($products as $product){
            array_push($product->name);
            array_push($product->descrption);

            foreach($product->prices as $price){
                array_push($price->value);
            }
        }
        
        $response = $this->get('/');

        $response->assertSeeTextInOrder($arr);
    }
}
