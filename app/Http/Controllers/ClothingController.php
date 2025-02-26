<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Clothing;
use Illuminate\Http\Request;
use Inertia\Inertia;

use function Pest\Laravel\call;

class ClothingController extends Controller
{
    // List all clothing items
    public function index()
    {
        $clothing = Clothing::all();
        return Inertia::render('clothing/Index', ['clothing' => $clothing]);
    }

    // Show the form for creating a new clothing item
    public function create()
    {
        return Inertia::render('clothing/Create',[
            'categories' => Category::all()
        ]);
    }

    // Store a new clothing item
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
        ]);

        Clothing::create($request->all());

        return redirect()->route('clothing.index');
    }

    // Show the form for editing a clothing item
    public function edit(Clothing $clothing)
    {
        return Inertia::render('clothing/Edit', [
            'clothing' => $clothing,
            'categories' => Category::all()
        ]);
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
        $categories_count = Category::count();
        
        // Get all categories
        $categories = Category::all();
        
        // Get total price and quantity for each category
        $categoryTotal = [];
        $categoryQuantity = [];
        
        foreach ($categories as $category) {
            $categoryTotal[$category->name] = $clothing->where('category_id', $category->id)->sum('price');
            $categoryQuantity[$category->name] = $clothing->where('category_id', $category->id)->sum('quantity');
        }
        
        return Inertia::render('Dashboard', [
            'total' => $total, 
            'quantity' => $quantity, 
            'categories_count' => $categories_count, 
            'categories' => $categories->pluck('name'), 
            'categoryTotal' => $categoryTotal, 
            'categoryQuantity' => $categoryQuantity
        ]);
    }
}