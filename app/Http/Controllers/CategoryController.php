<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Category::query();
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%");
        }
    
        $categories = $query->latest()->paginate(5);

        // $categories = Category::latest()->paginate(5);
        return view('pages.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        // Create a new category with the validated data
        Category::create([
            'name' => $request->name,
        ]);

        // Redirect with a success message
        return redirect()->route('categories.index')->with('success', 'Category created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return response()->json($category); // modal এ data পাঠানোর জন্য
    }
    
    public function update(CategoryRequest $request, Category $category)
    {
    
        $category->update([
            'name' => $request->name,
        ]);
    
        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
{
    try {
        // Check if category has products
        $productsCount = $category->products()->count();

        if ($productsCount > 0) {
            return redirect()->back()->with('error', "Cannot delete category. It has {$productsCount} associated products. Please remove all products first.");
        }

        // Delete the category
        $category->delete();

        return redirect()->back()->with('success', 'Category deleted successfully');

    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Error deleting category: ' . $e->getMessage());
    }
}

}
