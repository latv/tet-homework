<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;

class ProductCrudTest extends TestCase
{

    use RefreshDatabase;


    public function test_can_list_products()
    {
        $product1 = Product::create(['name' => 'A', 'price' => 10, 'stock' => 5, 'description' => 'desc']);
        $product2 = Product::create(['name' => 'B', 'price' => 20, 'stock' => 2, 'description' => 'desc']);
        $product3 = Product::create(['name' => 'C', 'price' => 30, 'stock' => 1, 'description' => 'desc']);

        $response = $this->getJson('/api/products');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    public function test_can_create_product()
    {
        $payload = [
            'name' => 'Gaming Mouse',
            'description' => 'High precision mouse',
            'price' => 50.00,
            'stock' => 100,
            'is_active' => true
        ];

        $response = $this->postJson('/api/products', $payload);

        $response->assertStatus(201)
                 ->assertJsonFragment(['name' => 'Gaming Mouse']);

        $this->assertDatabaseHas('products', [
            'name' => 'Gaming Mouse',
            'price' => 50.00
        ]);
    }


    public function test_can_show_product_with_total_amount()
    {

        $product = Product::create([
            'name' => 'Test Item', 
            'price' => 10, 
            'stock' => 5,
            'description' => 'test'
        ]);

        $response = $this->getJson("/api/products/{$product->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     'id' => $product->id,
                     'totalAmount' => 50 // This proves Common::productTotalAmount return correct value
                 ]);
    }


    public function test_can_update_product()
    {
        $product = Product::create([
            'name' => 'Old Name', 
            'price' => 20, 
            'stock' => 10,
            'description' => 'old desc'
        ]);

        $updatePayload = [
            'name' => 'New Name',
            'price' => 25,
            'stock' => 10,
            'description' => 'new desc'
        ];

        $response = $this->putJson("/api/products/{$product->id}", $updatePayload);

        $response->assertStatus(200);

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'New Name',
            'price' => 25
        ]);
        
        $this->assertDatabaseMissing('products', [
            'name' => 'Old Name'
        ]);
    }


    public function test_can_delete_product()
    {
        $product = Product::create([
            'name' => 'To Delete', 
            'price' => 5, 
            'stock' => 1,
            'description' => 'bye'
        ]);

        $response = $this->deleteJson("/api/products/{$product->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('products', [
            'id' => $product->id
        ]);
    }
}