<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
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

        foreach ($categories as $category) {
            Product::factory()->create([
                'category' => $category
            ]);
        }
    }
}
