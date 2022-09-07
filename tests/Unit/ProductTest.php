<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Price;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_relation_works()
    {
        $product = Product::factory()
            ->has(Price::factory()->count(3))    
            ->create();

        $this->assertCount(3, $product->prices);
    }

    public function test_price_mutator_and_accesor_works()
    {
        $product = Product::factory()->hasPrices(1, [
            'value' => $value = 10.50,
        ])->create();

        $price = DB::table('prices')
            ->select('value')
            ->where('product_id', "=", $product->id)
            ->get()
            ->toArray()[0];

        $this->assertTrue($price->value == $value*100);
    }
}
