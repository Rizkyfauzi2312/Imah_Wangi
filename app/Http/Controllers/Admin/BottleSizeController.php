<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BottleSize;
use Illuminate\Http\Request;

class BottleSizeController extends Controller
{
    public function index()
    {
        $bottleSizes = BottleSize::orderBy('size_ml')->paginate(20);
        return view('admin.bottle-sizes.index', compact('bottleSizes'));
    }

    public function create()
    {
        return view('admin.bottle-sizes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'size_ml' => 'required|integer|min:1',
            'base_price' => 'required|numeric|min:0',
        ]);

        BottleSize::create($request->all());

        return redirect()->route('admin.bottle-sizes.index')->with('success', 'Bottle size created successfully!');
    }

    public function show(BottleSize $bottleSize)
    {
        return view('admin.bottle-sizes.show', compact('bottleSize'));
    }

    public function edit(BottleSize $bottleSize)
    {
        return view('admin.bottle-sizes.edit', compact('bottleSize'));
    }

    public function update(Request $request, BottleSize $bottleSize)
    {
        $request->validate([
            'size_ml' => 'required|integer|min:1',
            'base_price' => 'required|numeric|min:0',
        ]);

        $bottleSize->update($request->all());

        return redirect()->route('admin.bottle-sizes.index')->with('success', 'Bottle size updated successfully!');
    }

    public function destroy(BottleSize $bottleSize)
    {
        $bottleSize->delete();
        return redirect()->route('admin.bottle-sizes.index')->with('success', 'Bottle size deleted successfully!');
    }
}
