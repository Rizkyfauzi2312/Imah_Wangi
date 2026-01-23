<?php

namespace App\Http\Controllers;

use App\Models\Aroma;
use App\Models\BottleSize;
use Illuminate\Http\Request;

class CustomPerfumeController extends Controller
{
    public function index()
    {
        $aromas = Aroma::all()->groupBy('category');
        $bottleSizes = BottleSize::orderBy('size_ml')->get();
        
        return view('custom.index', compact('aromas', 'bottleSizes'));
    }

    public function calculatePrice(Request $request)
    {
        $bottleSize = BottleSize::find($request->bottle_size_id);
        
        if (!$bottleSize) {
            return response()->json(['error' => 'Invalid bottle size'], 400);
        }

        // Base price from bottle size
        $price = $bottleSize->base_price;
        
        // Additional cost for custom notes (optional: add complexity pricing)
        $totalNotes = count($request->top_notes ?? []) + 
                     count($request->middle_notes ?? []) + 
                     count($request->base_notes ?? []);
        
        // Add 10k per note selected
        $price += ($totalNotes * 10000);
        
        return response()->json([
            'price' => $price,
            'formatted_price' => 'Rp ' . number_format($price, 0, ',', '.')
        ]);
    }
}
