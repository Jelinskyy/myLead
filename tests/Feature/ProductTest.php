<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_index_view_responding()
    {
        $response = $this->get(route('product.index'));

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
        
        $response = $this->get(route('product.index'));

        $response->assertSeeTextInOrder($arr);
    }

    public function test_create_view_responding()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get(route('product.create'));

        $response->assertStatus(200);
        $response->assertViewIs('product.create');
    }

    public function test_product_can_be_created()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $product = Product::factory()->make();

        $request = $this->post(route('product.create'), [
            'name' => $product->name,
            'description' => $product->description
        ]);

        $request->assertRedirect(route('product.index'));
    }

    public function test_edit_view_responding()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $product = Product::factory()->create();
        $response = $this->get(route('product.edit', ['product' => $product]));

        $response->assertStatus(200);
        $response->assertViewIs('product.edit');
    }

    public function test_product_can_be_updated()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $product = Product::factory()->create();

        $request = $this->put(route('product.update', ['product' => $product]), [
            'name' => $product->name,
            'description' => $product->description
        ]);

        $request->assertRedirect(route('product.index'));
    }

    public function test_product_can_be_deleted()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $product = Product::factory()->create();

        $request = $this->delete(route('product.destroy', ['product' => $product]));

        $request->assertRedirect(route('product.index'));
    }

    public function test_guest_cant_add_product()
    {
        $product = Product::factory()->make();

        $request = $this->post(route('product.create'), [
            'name' => $product->name,
            'description' => $product->description
        ]);

        $request->assertStatus(302);
    }

    public function test_guest_cant_update_product()
    {
        $product = Product::factory()->create();

        $request = $this->put(route('product.update', ['product' => $product]), [
            'name' => $product->name,
            'description' => $product->description
        ]);

        $request->assertStatus(302);
    }

    public function test_guest_cant_delete_product()
    {
        $product = Product::factory()->create();

        $request = $this->delete(route('product.destroy', ['product' => $product]));

        $request->assertstatus(302);
    }
}
