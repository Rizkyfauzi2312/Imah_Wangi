<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Aroma;

class AromaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $aromas = [
            // Top Notes
            ['name' => 'Bergamot', 'category' => 'top', 'description' => 'Fresh citrus scent with a slightly spicy edge'],
            ['name' => 'Lemon', 'category' => 'top', 'description' => 'Bright, clean, and energizing citrus aroma'],
            ['name' => 'Lavender', 'category' => 'top', 'description' => 'Calming floral with herbaceous undertones'],
            ['name' => 'Mint', 'category' => 'top', 'description' => 'Cool, refreshing, and invigorating'],
            ['name' => 'Orange', 'category' => 'top', 'description' => 'Sweet, fruity, and uplifting citrus'],
            
            // Middle Notes
            ['name' => 'Rose', 'category' => 'middle', 'description' => 'Classic floral, romantic and elegant'],
            ['name' => 'Jasmine', 'category' => 'middle', 'description' => 'Rich, sweet, and exotic floral'],
            ['name' => 'Ylang Ylang', 'category' => 'middle', 'description' => 'Sweet, floral with fruity nuances'],
            ['name' => 'Geranium', 'category' => 'middle', 'description' => 'Floral with a hint of mint and rose'],
            ['name' => 'Cinnamon', 'category' => 'middle', 'description' => 'Warm, spicy, and comforting'],
            
            // Base Notes
            ['name' => 'Sandalwood', 'category' => 'base', 'description' => 'Warm, woody, and creamy'],
            ['name' => 'Vanilla', 'category' => 'base', 'description' => 'Sweet, comforting, and sensual'],
            ['name' => 'Musk', 'category' => 'base', 'description' => 'Earthy, warm, and long-lasting'],
            ['name' => 'Patchouli', 'category' => 'base', 'description' => 'Earthy, woody, and slightly sweet'],
            ['name' => 'Amber', 'category' => 'base', 'description' => 'Warm, resinous, and powdery'],
        ];

        foreach ($aromas as $aroma) {
            Aroma::create($aroma);
        }
    }
}
