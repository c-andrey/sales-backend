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
        ]);

        $response->assertStatus(201);
    }

    public function test_create_sale_with_comission(): void
    {
        $seller = Seller::factory()->create();

        $response = $this->post('/api/sales', [
            'seller_id' => $seller->id,
            'value' => 100
        ]);

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
        ], [
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(422);
    }

    public function test_get_sales(): void
    {
        Sale::factory(5)->create();
        $response = $this->get('/api/sales');

        $response->assertStatus(200);
        $response->assertJsonCount(5);
    }

    public function test_get_sale(): void
    {
        $sale = Sale::factory()->create();
        $response = $this->get("/api/sales/{$sale->id}");

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'id' => $sale->id
        ]);
    }
}
