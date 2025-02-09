<?php

namespace Tests\Feature;

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
}
