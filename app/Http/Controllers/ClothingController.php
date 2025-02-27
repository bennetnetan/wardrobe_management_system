<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Clothing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

use function Pest\Laravel\call;

class ClothingController extends Controller
{
    // List all clothing items
    public function index()
    {
        $clothing = Clothing::where('user_id', Auth::id())->get();
        // dd($clothing);
        return Inertia::render('clothing/Index', [
            'clothing' => $clothing,
            'categories' => Category::all()
        ]);
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

        // Add the user ID to the request
        $request->merge(['user_id' => Auth::user()->id]);

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
            'category_id' => 'required|exists:categories,id',
        ]);

        // Add the user ID to the request
        $request->merge(['user_id' => Auth::user()->id]);

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
        $userId = Auth::id();

        // Get user's clothing with category relationships
        $clothing = Clothing::with('category')
            ->where('user_id', $userId)
            ->get();

        // Calculate totals directly from collection
        $total = $clothing->sum('price');
        $quantity = $clothing->sum('quantity');

        // Get unique categories actually used in clothing
        $categories = $clothing->map(fn($item) => $item->category)
            ->filter()
            ->unique('id')
            ->values();

        // Group clothing by category for efficient calculations
        $groupedByCategory = $clothing->groupBy('category_id');

        // Calculate category totals using grouped collection
        $categoryTotal = [];
        $categoryQuantity = [];
        
        foreach ($groupedByCategory as $categoryId => $items) {
            $category = $categories->firstWhere('id', $categoryId);
            if ($category) {
                $categoryTotal[$category->name] = $items->sum(fn($item) => $item->price * $item->quantity);
                $categoryQuantity[$category->name] = $items->sum('quantity');
            }
        }

        return Inertia::render('Dashboard', [
            'total' => $total,
            'quantity' => $quantity,
            'categories_count' => $categories->count(),  // Only categories with clothing
            'categories' => $categories->pluck('name'), // Only used categories
            'categoryTotal' => $categoryTotal,
            'categoryQuantity' => $categoryQuantity
        ]);
    }
}