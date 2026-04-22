<?php

namespace Database\Factories;

use App\Constants\Constants;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'sku' => $this->faker->randomElement(Constants::SKU_VARIANTS),
            'price' => $this->faker->randomFloat(2, 10, 100) ,
            'stock_quantity' => $this->faker->randomNumber(),
            'category' =>  $this->faker->randomElement(Constants::CATEGORIES),
        ];
    }
}
