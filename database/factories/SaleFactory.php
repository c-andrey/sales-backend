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
        $value = fake()->randomFloat(2, 100, 1000);
        $seller = Seller::factory()->create();

        return [
            'seller_id' => $seller->id,
            'value' => $value,
            'comission' => $value * 0.085
        ];
    }

    /**
     * Indicate that the sale has no comission.
     *
     * @return \Database\Factories\SaleFactory
     */
    public function withoutComission(): SaleFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'comission' => 0
            ];
        });
    }

    //seller_id as param
    public function withSeller(int $sellerId): SaleFactory
    {
        return $this->state(function (array $attributes) use ($sellerId) {
            return [
                'seller_id' => $sellerId
            ];
        });
    }
}
