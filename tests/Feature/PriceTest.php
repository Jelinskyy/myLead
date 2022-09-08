<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Price;
use App\Models\Product;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PriceTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_view_responding()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $product = Product::factory()->create();

        $response = $this->get(route('price.create', ['product' => $product]));

        $response->assertStatus(200);
        $response->assertViewIs('price.create');
    }

    public function test_price_can_be_created()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $product = Product::factory()->create();
        $price = Price::factory()->make();

        $request = $this->post(route('price.create', ['product' => $product]), [
            'value' => $price->value,
        ]);

        $request->assertRedirect(route('product.index'));
    }

    public function test_edit_view_responding()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $product = Product::factory()->create();
        $price = Price::factory()->create([
            'product_id' => $product->id,
        ]);

        $response = $this->get(route('price.edit', ['price' => $price]));

        $response->assertStatus(200);
        $response->assertViewIs('price.edit');
    }

    public function test_price_can_be_updated()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $product = Product::factory()->create();
        $price = Price::factory()->create([
            'product_id' => $product->id,
        ]);

        $request = $this->put(route('price.update', ['price' => $price]), [
            'value' => $price->value,
        ]);

        $request->assertRedirect(route('product.index'));
    }

    public function test_price_can_be_deleted()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $product = Product::factory()->create();
        $price = Price::factory()->create([
            'product_id' => $product->id,
        ]);

        $request = $this->delete(route('price.destroy', ['price' => $price]));

        $request->assertRedirect(route('product.index'));
    }

    public function test_guest_cant_add_price()
    {
        $product = Product::factory()->create();
        $price = Price::factory()->make();

        $request = $this->post(route('price.create', ['product' => $product]), [
            'value' => $price->value,
        ]);

        $request->assertStatus(302);
    }

    public function test_guest_cant_update_price()
    {
        $product = Product::factory()->create();
        $price = Price::factory()->create([
            'product_id' => $product->id,
        ]);

        $request = $this->put(route('price.update', ['price' => $price]), [
            'value' => $price->value,
        ]);

        $request->assertStatus(302);
    }

    public function test_guest_cant_delete_price()
    {
        $product = Product::factory()->create();
        $price = Price::factory()->create([
            'product_id' => $product->id,
        ]);

        $request = $this->delete(route('price.destroy', ['price' => $price]));

        $request->assertstatus(302);
    }
}
