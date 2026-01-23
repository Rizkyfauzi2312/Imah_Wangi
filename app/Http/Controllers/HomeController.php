<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the home page with featured products.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $featuredProducts = \App\Models\Product::latest()->take(6)->get();
        $banners = \App\Models\Banner::active()->ordered()->get();
        return view('home', compact('featuredProducts', 'banners'));
    }
}
