<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Midnight Elegance',
                'description' => 'A sophisticated blend of sandalwood, vanilla, and musk. Perfect for evening occasions.',
                'price' => 450000,
                'stock' => 25,
            ],
            [
                'name' => 'Citrus Breeze',
                'description' => 'Fresh and invigorating with bergamot, lemon, and mint. Ideal for daily wear.',
                'price' => 380000,
                'stock' => 30,
            ],
            [
                'name' => 'Rose Garden',
                'description' => 'Romantic floral composition featuring rose, jasmine, and ylang ylang.',
                'price' => 420000,
                'stock' => 20,
            ],
            [
                'name' => 'Spice Route',
                'description' => 'Warm and exotic with cinnamon, amber, and patchouli notes.',
                'price' => 480000,
                'stock' => 15,
            ],
            [
                'name' => 'Ocean Mist',
                'description' => 'Clean and refreshing aquatic scent with lavender and mint undertones.',
                'price' => 390000,
                'stock' => 28,
            ],
            [
                'name' => 'Golden Sunset',
                'description' => 'Luxurious blend of amber, vanilla, and sandalwood. A timeless classic.',
                'price' => 520000,
                'stock' => 18,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
