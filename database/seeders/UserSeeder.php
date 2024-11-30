<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@ecommerce.com',
            'password' => Hash::make('admin123'),
            'phone' => '081234567890',
            'address' => 'Jl. Contoh, Kota Contoh',
            'is_admin' => true
        ]);

        User::create([
            'name' => 'Customer User',
            'email' => 'customer@ecommerce.com',
            'phone' => '081234567891',
            'address' => 'Jl. Contoh, Kota Contoh',
            'password' => Hash::make('customer123'),
        ]);
    }
}
