<?php

namespace Database\Seeders;

use App\Models\Clothing;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClothingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define an array of clothing items
        $clothingItems = [
            [
                'name' => 'T-Shirt',
                'price' => 19.99,
                'description' => 'A comfortable cotton T-shirt.',
                'quantity' => 50,
            ],
            [
                'name' => 'Jeans',
                'price' => 49.99,
                'description' => 'Classic blue denim jeans.',
                'quantity' => 30,
            ],
            [
                'name' => 'Hoodie',
                'price' => 39.99,
                'description' => 'A warm and cozy hoodie.',
                'quantity' => 20,
            ],
            [
                'name' => 'Sneakers',
                'price' => 89.99,
                'description' => 'Stylish and comfortable sneakers.',
                'quantity' => 40,
            ],
            [
                'name' => 'Jacket',
                'price' => 99.99,
                'description' => 'A waterproof winter jacket.',
                'quantity' => 15,
            ],
        ];

        // Insert the clothing items into the database
        foreach ($clothingItems as $item) {
            Clothing::create($item);
        }
    }
}