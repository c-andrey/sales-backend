<?php

namespace Tests\Feature;

use App\Models\Sale;
use App\Models\Seller;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SaleTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    use RefreshDatabase;

    private const HEADERS = [
        'Accept' => 'application/json'
    ];

    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_create_sale(): void
    {
        $seller = Seller::factory()->create();

        $response = $this->post('/api/sales', [
            'seller_id' => $seller->id,
            'value' => 100
        ], self::HEADERS);

        $response->assertStatus(201);
    }

    public function test_create_sale_with_comission(): void
    {
        $seller = Seller::factory()->create();

        $response = $this->post('/api/sales', [
            'seller_id' => $seller->id,
            'value' => 100
        ], self::HEADERS);

        $response->assertStatus(201);

        $response->assertJsonFragment([
            'comission' => 8.5
        ]);
    }

    public function test_create_sale_with_invalid_data(): void
    {
        $seller = Seller::factory()->create();

        $response = $this->post('/api/sales', [
            'seller_id' => $seller->id,
            'value' => 'invalid'
        ], self::HEADERS);

        $response->assertStatus(422);
    }

    public function test_get_sales(): void
    {
        Sale::factory(5)->create();
        $response = $this->get('/api/sales', self::HEADERS);

        $response->assertStatus(200);
        $response->assertJsonCount(5);
    }

    public function test_get_sale(): void
    {
        $sale = Sale::factory()->create();
        $response = $this->get("/api/sales/{$sale->id}", self::HEADERS);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'id' => $sale->id
        ]);
    }

    public function test_update_sale(): void
    {
        $sale = Sale::factory()->create();
        $response = $this->put("/api/sales/{$sale->id}", [
            'value' => 200
        ], self::HEADERS);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'value' => 200,
            'comission' => 17
        ]);
    }

    public function test_update_sale_not_found(): void
    {
        $response = $this->put("/api/sales/1", [
            'value' => 200
        ], self::HEADERS);

        $response->assertStatus(404);
    }

    public function test_delete_sale(): void
    {
        $sale = Sale::factory()->create();
        $response = $this->delete("/api/sales/{$sale->id}", [], self::HEADERS);

        $response->assertStatus(204);
    }

    public function test_delete_sale_not_found(): void
    {
        $response = $this->delete("/api/sales/1", [], self::HEADERS);

        $response->assertStatus(404);
    }
}
