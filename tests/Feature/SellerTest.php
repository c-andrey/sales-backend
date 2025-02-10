<?php

namespace Tests\Feature;

use App\Models\Sale;
use App\Models\Seller;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SellerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_create_seller(): void
    {
        $response = $this->postJson('/api/sellers', [
            'name' => 'John Doe',
            'email' => 'johndoe@email.com',
        ]);

        $response->assertStatus(201);
        $response->assertJsonStructure([
            'id',
            'name',
            'email',
            'created_at',
            'updated_at',
        ]);
    }

    public function test_create_seller_with_invalid_data(): void
    {
        $response = $this->postJson('/api/sellers', [
            'name' => 'John Doe',
        ]);

        $response->assertStatus(422);
        $response->assertJsonStructure([
            'message',
            'errors',
        ]);
    }

    public function test_create_seller_with_invalid_email(): void
    {
        $response = $this->postJson('/api/sellers', [
            'name' => 'John Doe',
            'email' => 'invalid-email',
        ]);

        $response->assertStatus(422);
        $response->assertJsonStructure([
            'message',
            'errors',
        ]);
    }

    public function test_update_seller(): void
    {
        $seller = Seller::factory()->create();

        $response = $this->putJson("/api/sellers/{$seller->id}", [
            'name' => 'Jane Doe',
            'email' => 'doejohn@email.com'
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'name',
            'email',
            'created_at',
            'updated_at',
        ]);

        $this->assertDatabaseHas('sellers', [
            'id' => $seller->id,
            'name' => 'Jane Doe',
            'email' => 'doejohn@email.com',
        ]);
    }

    public function test_update_seller_with_invalid_data(): void
    {
        $seller = Seller::factory()->create();

        $response = $this->putJson("/api/sellers/{$seller->id}", [
            'name' => 'Jane Doe',
        ]);

        $response->assertStatus(422);
        $response->assertJsonStructure([
            'message',
            'errors',
        ]);
    }

    public function test_show_seller(): void
    {
        $seller = Seller::factory()->create();

        $response = $this->get("/api/sellers/{$seller->id}");

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'name',
            'email',
            'created_at',
            'updated_at',
        ]);
    }

    public function test_show_seller_not_found(): void
    {
        $response = $this->get("/api/sellers/1");

        $response->assertStatus(404);
        $response->assertJsonStructure([
            'message',
        ]);
    }

    public function test_list_all_sellers(): void
    {
        Seller::factory()->count(5)->create();

        $response = $this->get("/api/sellers");

        $response->assertStatus(200);
        $response->assertJsonCount(5);
    }

    public function test_list_all_sellers_empty(): void
    {
        $response = $this->get("/api/sellers");

        $response->assertStatus(200);
        $response->assertJsonCount(0);
    }

    public function test_delete_seller(): void
    {
        $seller = Seller::factory()->create();

        $response = $this->delete("/api/sellers/{$seller->id}");

        $response->assertStatus(204);
        $this->assertSoftDeleted('sellers', [
            'id' => $seller->id,
        ]);
    }

    public function test_delete_seller_not_found(): void
    {
        $response = $this->delete("/api/sellers/1");

        $response->assertStatus(404);
        $response->assertJsonStructure([
            'message',
        ]);
    }

    public function test_get_all_sellers_with_comission_combined(): void
    {
        $sellers = Seller::factory()->count(5)->create();

        $sellers->each(function ($seller) {
            Sale::factory()->count(5)->withSeller($seller->id)->create();
        });

        $response = $this->get("/api/sellers");

        $response->assertStatus(200);
        $response->assertJsonCount(30);
        $response->assertJsonStructure([
            '*' => [
                'id',
                'name',
                'email',
                'comission',
            ],
        ]);
    }

    public function test_list_all_sales_from_a_seller(): void
    {
        $seller = Seller::factory()->create();
        Sale::factory()->count(5)->withSeller($seller->id)->create();

        $response = $this->get("/api/sellers/{$seller->id}/sales");

        $response->assertStatus(200);
        $response->assertJsonCount(5);
        $response->assertJsonStructure([
            '*' => [
                'id',
                'value',
                'comission',
            ],
        ]);
    }
}
