<?php

namespace Tests\Feature;

use App\Models\Coupon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CouponTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_all_coupons(): void
    {
        // Arrange: Create some coupons
        Coupon::create([
            'code' => 'TEST10',
            'type' => 'fixed',
            'value' => 10,
            'is_active' => true,
        ]);
        
        Coupon::create([
            'code' => 'SALE20',
            'type' => 'percentage',
            'value' => 20,
            'is_active' => false,
        ]);

        $response = $this->getJson('/api/coupons');

        $response->assertStatus(200)
            ->assertJsonCount(2)
            ->assertJsonStructure([
                '*' => ['id', 'code', 'type', 'value', 'is_active', 'created_at', 'updated_at']
            ]);
    }

    public function test_can_create_a_coupon(): void
    {
        $payload = [
            'code' => 'NEWYEAR2025',
            'type' => 'percentage',
            'value' => 15.50,
            'expires_at' => '2025-12-31 23:59:59',
            'max_uses' => 100,
            'is_active' => true,
        ];

        $response = $this->postJson('/api/coupons', $payload);

        $response->assertStatus(201)
            ->assertJsonFragment(['code' => 'NEWYEAR2025']);

        $this->assertDatabaseHas('coupons', [
            'code' => 'NEWYEAR2025',
            'type' => 'percentage',
        ]);
    }

    public function test_cannot_create_coupon_with_invalid_data(): void
    {
        $response = $this->postJson('/api/coupons', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['code', 'type', 'value']);
    }

    public function test_cannot_create_duplicate_coupon_code(): void
    {
        Coupon::create([
            'code' => 'UNIQUE123',
            'type' => 'fixed',
            'value' => 5,
        ]);

        $payload = [
            'code' => 'UNIQUE123',
            'type' => 'percentage',
            'value' => 10,
        ];

        $response = $this->postJson('/api/coupons', $payload);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['code']);
    }

    public function test_can_show_a_coupon(): void
    {
        $coupon = Coupon::create([
            'code' => 'SHOWME',
            'type' => 'fixed',
            'value' => 50,
        ]);

        $response = $this->getJson("/api/coupons/{$coupon->id}");

        $response->assertStatus(200)
            ->assertJson([
                'id' => $coupon->id,
                'code' => 'SHOWME',
            ]);
    }

    public function test_show_returns_404_for_invalid_id(): void
    {
        $response = $this->getJson('/api/coupons/99999');

        $response->assertStatus(404);
    }

    public function test_can_update_a_coupon(): void
    {
        $coupon = Coupon::create([
            'code' => 'OLDCODE',
            'type' => 'fixed',
            'value' => 10,
        ]);

        $payload = [
            'code' => 'NEWCODE',
            'value' => 25,
        ];

        $response = $this->putJson("/api/coupons/{$coupon->id}", $payload);

        $response->assertStatus(200)
            ->assertJsonFragment(['code' => 'NEWCODE']);

        $this->assertDatabaseHas('coupons', [
            'id' => $coupon->id,
            'code' => 'NEWCODE',
            'value' => 25,
        ]);
    }

    public function test_can_delete_a_coupon(): void
    {
        $coupon = Coupon::create([
            'code' => 'DELETE_ME',
            'type' => 'fixed',
            'value' => 5,
        ]);

        $response = $this->deleteJson("/api/coupons/{$coupon->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('coupons', ['id' => $coupon->id]);
    }
}