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
        // Generate multiple image URLs (e.g., 3 images)
        $imageUrls = [];
        for ($i = 0; $i < 3; $i++) {
            $imageUrls[] = $this->faker->imageUrl(640, 480, 'products', true);
        }

        // Convert the array of image URLs into a comma-separated string
        $imageString = implode(',', $imageUrls);

        return [
            'category_id' => \App\Models\Category::factory(), // Assuming you have a Category model and factory
            'name' => $this->faker->word,
            'size' => $this->faker->randomElement(['S', 'M', 'L', 'XL']),
            'description' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'image' => $imageString, // Store the comma-separated image URLs
        ];
    }
}