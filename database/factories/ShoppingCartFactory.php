<?php

namespace Database\Factories;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ShoppingCart>
 */
class ShoppingCartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = \App\Models\ShoppingCart::class;


    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,  // Random user
            'product_id' => Product::inRandomOrder()->first()->id,  // Random product
            'quantity' => $this->faker->numberBetween(1, 5),  // Random quantity between 1 and 5
        ];
    }
}
