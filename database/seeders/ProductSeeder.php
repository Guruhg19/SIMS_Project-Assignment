<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();

        // Cek apakah ada kategori tersedia
        if ($categories->isEmpty()) {
            $this->command->error('No categories found. Please seed categories first.');
            return;
        }

        // Tambahkan produk untuk setiap kategori
        foreach ($categories as $category) {
            Product::create([
                'category_id' => $category->id, // Relasi yang valid
                'name' => 'Produk ' . $category->name,
                'purchase_price' => 50000,
                'sale_price' => 65000,
                'stock' => 100,
                'image' => null, // Gambar belum diunggah
            ]);
        }
    }
}
