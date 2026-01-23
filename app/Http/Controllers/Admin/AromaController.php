<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aroma;
use Illuminate\Http\Request;

class AromaController extends Controller
{
    public function index()
    {
        $aromas = Aroma::orderBy('category')->orderBy('name')->paginate(20);
        return view('admin.aromas.index', compact('aromas'));
    }

    public function create()
    {
        return view('admin.aromas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:top,middle,base',
            'description' => 'nullable|string',
        ]);

        Aroma::create($request->all());

        return redirect()->route('admin.aromas.index')->with('success', 'Aroma created successfully!');
    }

    public function show(Aroma $aroma)
    {
        return view('admin.aromas.show', compact('aroma'));
    }

    public function edit(Aroma $aroma)
    {
        return view('admin.aromas.edit', compact('aroma'));
    }

    public function update(Request $request, Aroma $aroma)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:top,middle,base',
            'description' => 'nullable|string',
        ]);

        $aroma->update($request->all());

        return redirect()->route('admin.aromas.index')->with('success', 'Aroma updated successfully!');
    }

    public function destroy(Aroma $aroma)
    {
        $aroma->delete();
        return redirect()->route('admin.aromas.index')->with('success', 'Aroma deleted successfully!');
    }
}
