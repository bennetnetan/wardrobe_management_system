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

    // Get clothing data for Dashboard
    public function dashboard()
    {
        $clothing = Clothing::all();
        $total = $clothing->sum('price');
        $quantity = $clothing->sum('quantity');
        // Get unique categories count
        $categories_count = $clothing->unique('category')->count();
        // Get unique categories
        $categories = $clothing->unique('category')->pluck('category');
        // Get total price for each category
        $categoryTotal = [];
        foreach ($categories as $category) {
            $categoryTotal[$category] = $clothing->where('category', $category)->sum('price');
        }
        // Get total quantity for each category
        $categoryQuantity = [];
        foreach ($categories as $category) {
            $categoryQuantity[$category] = $clothing->where('category', $category)->sum('quantity');
        }
        // dd($categoryQuantity, $categoryTotal, $categories, $quantity, $total);
        return Inertia::render('Dashboard', [
            'total' => $total, 
            'quantity' => $quantity, 
            'categories_count' => $categories_count, 
            'categories' => $categories, 
            'categoryTotal' => $categoryTotal, 
            'categoryQuantity' => $categoryQuantity
        ]);
    }
}