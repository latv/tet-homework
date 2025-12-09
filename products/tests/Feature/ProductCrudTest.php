<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;

class ProductCrudTest extends TestCase
{
    // This trait automatically migrates the DB before each test 
    // and rolls it back after, ensuring a clean slate.
    use RefreshDatabase;

    /**
     * Test getting a list of all products.
     */
    public function test_can_list_products()
    {
        // 1. Arrange: Create 3 dummy products
        // Note: If you have a ProductFactory, use Product::factory()->count(3)->create();
        // Since I didn't see one in your files, I'll create them manually.
        $product1 = Product::create(['name' => 'A', 'price' => 10, 'stock' => 5, 'description' => 'desc']);
        $product2 = Product::create(['name' => 'B', 'price' => 20, 'stock' => 2, 'description' => 'desc']);
        $product3 = Product::create(['name' => 'C', 'price' => 30, 'stock' => 1, 'description' => 'desc']);

        // 2. Act: Hit the API endpoint
        $response = $this->getJson('/api/products');

        // 3. Assert: Check status and count
        $response->assertStatus(200)
                 ->assertJsonCount(3); // Expecting 3 items in the array
    }

    /**
     * Test creating a new product.
     */
    public function test_can_create_product()
    {
        // 1. Arrange: Define the product data
        $payload = [
            'name' => 'Gaming Mouse',
            'description' => 'High precision mouse',
            'price' => 50.00,
            'stock' => 100,
            'is_active' => true
        ];

        // 2. Act: Send POST request
        $response = $this->postJson('/api/products', $payload);

        // 3. Assert: Check status and DB
        $response->assertStatus(201) // Created
                 ->assertJsonFragment(['name' => 'Gaming Mouse']);

        $this->assertDatabaseHas('products', [
            'name' => 'Gaming Mouse',
            'price' => 50.00
        ]);
    }

    /**
     * Test showing a single product and verifying the calculated field.
     */
    public function test_can_show_product_with_total_amount()
    {
        // 1. Arrange: Create a specific product
        // Price 10 * Stock 5 = Total 50
        $product = Product::create([
            'name' => 'Test Item', 
            'price' => 10, 
            'stock' => 5,
            'description' => 'test'
        ]);

        // 2. Act: Get the product details
        $response = $this->getJson("/api/products/{$product->id}");

        // 3. Assert: Verify the 'totalAmount' calculation from your Controller
        $response->assertStatus(200)
                 ->assertJson([
                     'id' => $product->id,
                     'totalAmount' => 50 // This proves Common::productTotalAmount ran
                 ]);
    }

    /**
     * Test updating an existing product.
     */
    public function test_can_update_product()
    {
        // 1. Arrange: Create a product
        $product = Product::create([
            'name' => 'Old Name', 
            'price' => 20, 
            'stock' => 10,
            'description' => 'old desc'
        ]);

        $updatePayload = [
            'name' => 'New Name',
            'price' => 25,
            'stock' => 10, // Must include required fields based on validation
            'description' => 'new desc'
        ];

        // 2. Act: Send PUT request
        $response = $this->putJson("/api/products/{$product->id}", $updatePayload);

        // 3. Assert: Verify name changed in DB
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

    /**
     * Test deleting a product.
     */
    public function test_can_delete_product()
    {
        // 1. Arrange: Create a product
        $product = Product::create([
            'name' => 'To Delete', 
            'price' => 5, 
            'stock' => 1,
            'description' => 'bye'
        ]);

        // 2. Act: Send DELETE request
        $response = $this->deleteJson("/api/products/{$product->id}");

        // 3. Assert: Status 204 (No Content) and DB is empty
        $response->assertStatus(204);

        $this->assertDatabaseMissing('products', [
            'id' => $product->id
        ]);
    }
}