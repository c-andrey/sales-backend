<?php

namespace Database\Factories;

use App\Models\Seller;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $seller = Seller::factory()->create();

        return [
            'seller_id' => $seller->id,
            'value' => 100,
            'comission' => 8.5
        ];
    }
}
