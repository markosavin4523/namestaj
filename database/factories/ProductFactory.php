<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Str;

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
        $name = $this->faker->words(3, true);

        return [
            'name' => ucfirst($name),
            'description' => $this->faker->paragraph(4),
            'quantity' => $this->faker->numberBetween(0, 100),
            'slug' => Str::slug($name),
            'price' => $this->faker->numberBetween(1000, 10000),
            'category_id' => Category::whereNotNull('parent_id')
                ->where('active', true)
                ->inRandomOrder()
                ->value('id'),
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
