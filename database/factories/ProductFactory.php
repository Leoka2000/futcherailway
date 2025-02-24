<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            'america',
            'europa',
            'asia',
            'africa',
            'liga_alema',
            'liga_espanhola',
            'liga_francesa',
            'liga_inglesa',
            'liga_italiana',
            'outra_liga',
            'paulistas',
            'pulistas',
            'mineiros',
            'nordestinos'
        ];

        return [
            'category' => $this->faker->randomElement($categories),
            'name' => $this->faker->word,
            'size' => $this->faker->randomElement(['S', 'M', 'L', 'XL']),
            'description' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'image' => json_encode([
                "products/Image 08-02-2025 at 03.45.jpg",
                "products/" . $this->faker->uuid . ".jpg"
            ], JSON_UNESCAPED_SLASHES),
        ];
    }
}
