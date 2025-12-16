<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
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
        'name'=>fake()->word(),
        'image'=>basename(fake()->image(public_path('assets/images/products'))),
        'price'=>fake()->randomFloat(1,3),
        'published'=>fake()->boolean(),
        'rate'=>fake()->randomFloat(1,4),
        'category_id'=>fake()->numberBetween(1,3),
        ];
    }
}
