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
                'quantity' => 5,
                'category_id' => 1, 
                'user_id' => 1,
            ],
            [
                'name' => 'Jeans',
                'price' => 49.99,
                'description' => 'Classic blue denim jeans.',
                'quantity' => 3,
                'category_id' => 5, 
                'user_id' => 1,
            ],
            [
                'name' => 'Hoodie',
                'price' => 39.99,
                'description' => 'A warm and cozy hoodie.',
                'quantity' => 2,
                'category_id' => 2, 
                'user_id' => 1,
            ],
            [
                'name' => 'Sneakers',
                'price' => 59.99,
                'description' => 'Comfortable running sneakers.',
                'quantity' => 4,
                'category_id' => 7, 
                'user_id' => 1,
            ],
            [
                'name' => 'Jacket',
                'price' => 99.99,
                'description' => 'A waterproof winter jacket.',
                'quantity' => 1,
                'category_id' => 4, 
                'user_id' => 1,
            ],
        ];

        // Insert the clothing items into the database
        foreach ($clothingItems as $item) {
            Clothing::create($item);
        }
    }
}