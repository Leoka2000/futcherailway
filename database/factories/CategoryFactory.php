<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Category::class;

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
            'nordestinos',

        ];

        return [
            'name' => $this->faker->randomElement($categories), // Ensuring only predefined values are used
        ];
    }
}
