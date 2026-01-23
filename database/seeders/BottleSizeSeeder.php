<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BottleSize;

class BottleSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sizes = [
            ['size_ml' => 10, 'base_price' => 150000],
            ['size_ml' => 30, 'base_price' => 350000],
            ['size_ml' => 50, 'base_price' => 550000],
            ['size_ml' => 100, 'base_price' => 950000],
        ];

        foreach ($sizes as $size) {
            BottleSize::create($size);
        }
    }
}
