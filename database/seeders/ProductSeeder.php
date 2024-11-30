<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $elektronik = Category::where('name', 'Elektronik')->first();
        $fashion = Category::where('name', 'Fashion')->first();

        Product::create([
            'name' => 'Smartphone Samsung Galaxy',
            'description' => 'Smartphone canggih dengan layar AMOLED.',
            'price' => 5000000,
            'stock' => 100,
            'image_url' => 'https://via.placeholder.com/200',
            'category_id' => $elektronik->id,
        ]);

        Product::create([
            'name' => 'T-shirt Casual',
            'description' => 'T-shirt kasual dengan desain modern.',
            'price' => 150000,
            'stock' => 200,
            'image_url' => 'https://via.placeholder.com/200',
            'category_id' => $fashion->id,
        ]);
    }
}
