<?php

namespace App\Http\Controllers;

use App\Models\Clothing;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClothingController extends Controller
{
    // List all clothing items
    public function index()
    {
        $clothing = Clothing::all();
        // $clothing = Clothing::paginate(10);
        return Inertia::render('clothing/Index', ['clothing' => $clothing]);
    }

    // Show the form for creating a new clothing item
    public function create()
    {
        return Inertia::render('clothing/Create');
    }

    // Store a new clothing item
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
        ]);

        Clothing::create($request->all());

        return redirect()->route('clothing.index');
    }

    // Show the form for editing a clothing item
    public function edit(Clothing $clothing)
    {
        return Inertia::render('clothing/Edit', ['clothing' => $clothing]);
    }

    // Update a clothing item
    public function update(Request $request, Clothing $clothing)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
        ]);

        $clothing->update($request->all());

        return redirect()->route('clothing.index');
    }

    // Delete a clothing item
    public function destroy(Clothing $clothing)
    {
        $clothing->delete();
        return redirect()->route('clothing.index');
    }
}