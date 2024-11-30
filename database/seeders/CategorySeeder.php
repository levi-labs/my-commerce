<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Category::create(['name' => 'Elektronik', 'description' => 'Produk elektronik seperti handphone, laptop, dan peralatan lainnya']);
        Category::create(['name' => 'Fashion', 'description' => 'Pakaian, aksesoris, dan fashion lainnya']);
        Category::create(['name' => 'Peralatan Rumah Tangga', 'description' => 'Peralatan yang digunakan untuk keperluan rumah tangga']);
    }
}
