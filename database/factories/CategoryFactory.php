<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CatrgoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_name'=>fake()->randomElement(['kids','men','women']),
            'description'=>fake()->text(),
            'published'=>fake()->boolean(),
            'image'=>basename(fake()->image(public_path('assets/images/categories'))),
        ];
    }
}
