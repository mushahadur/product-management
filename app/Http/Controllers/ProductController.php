<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::with('categories');

        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('description', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('categories.id', $request->category);
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('is_active', (bool) $request->status);
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');

        $allowedSorts = ['name', 'price', 'created_at'];
        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortOrder);
        }

        // Pagination
        $products = $query->paginate(5)->withQueryString();

        // Get categories for filter dropdown
        $categories = Category::where('is_active', true)->orderBy('name')->get();

        return view('pages.products.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $categories = Category::where('is_active', true)
                ->orderBy('name')
                ->get(['id', 'name']);

            return view('pages.products.create', compact('categories'));

        } catch (\Exception $e) {
            // error handle
            return redirect()->back()->with('error', 'Error retrieving form data: ' . $e->getMessage());
        }
    }


    /**
     * Store a newly created resource in storage.
     */

    private function saveImage(Request $request)
    {
        $image = $request->file('image');
        $extension = $image->getClientOriginalExtension();
        $imageName = time() . '.' . $extension;
        $directory = 'product-images/';
        $image->move(public_path($directory), $imageName);

        return $directory . $imageName;
    }

    public function store(ProductRequest $request)
    {
        try {
            // Step 1: Handle image upload
            $imagePath = $this->saveImage($request);

            // Step 2: Create product
            $product = new Product();
            $product->name = $request->name;
            $product->price = $request->price;
            $product->description = $request->description;
            $product->image = $imagePath;
            $product->save();

            // Step 3: Attach categories
            if (!empty($request->categories)) {
                $product->categories()->sync($request->categories);
            }

            // Step 4: Load relationships
            $product->load('categories');

            return redirect()->route('products.index')
                ->with('success', 'Product created successfully!');
        } catch (\Exception $e) {
            return back()->withErrors('Error: ' . $e->getMessage())->withInput();
        }
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
    public function edit(Product $product)
    {
        $product->load('categories');

        return response()->json([
            'id' => $product->id,
            'name' => $product->name,
            'description' => $product->description,
            'price' => $product->price,
            'image' => $product->image,
            'categories' => $product->categories->pluck('id')->toArray(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        // Handle image upload
        if ($request->hasFile('image')) {
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $directory = 'product-images/';
            $image->move(public_path($directory), $imageName);
            $product->image = $directory . $imageName;
        }

        // Update product
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        // Update categories
        $product->categories()->sync($request->categories);

        // return redirect()->route('products.index')
        //                  ->with('success', 'Product updated successfully.');
        return response()->json([
            'success' => true,
            'message' => 'Product updated successfully'
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $product = Product::findOrFail($id);

            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }

            $product->categories()->detach();

            $product->delete();

            return redirect()->route('products.index')
                ->with('success', 'Product deleted successfully!');
        } catch (\Exception $e) {
            return back()->withErrors('Error: ' . $e->getMessage());
        }
    }

}