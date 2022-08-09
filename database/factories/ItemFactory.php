<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'brand' => $this->faker->name,
            'name' => $this->faker->name(),
            'cost_price' => $this->faker->randomDigit,
            'selling_price' => $this->faker->randomDigit,
            'size' => $this->faker->randomDigit,
            'storage' => $this->faker->randomElement([1,2,3,4,5]),
            'quantity' => $this->faker->randomDigit,
            'details' => $this->faker->paragraph,
        ];
    }
}
