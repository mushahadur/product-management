<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\Category;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class ProductRepository implements ProductRepositoryInterface
{
    protected Product $productsModel;

    public function __construct(Product $productsModel)
    {
        $this->productsModel = $productsModel;
    }

    public function getCategories()
    {
        $categories = Category::where('is_active', true)
            ->orderBy('name')
            ->get(['id', 'name']);

        return compact('categories');
    }

    public function all(): Collection
    {
        return $this->productsModel->with('categories')->get();
    }

    public function getAllWithFilters($request)
    {
        $query = Product::with('categories');

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('description', 'LIKE', "%{$searchTerm}%");
            });
        }

        if ($request->filled('category')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('categories.id', $request->category);
            });
        }

        if ($request->filled('status')) {
            $query->where('is_active', (bool) $request->status);
        }

        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');

        $allowedSorts = ['name', 'price', 'created_at'];
        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortOrder);
        }

        $products = $query->paginate(5)->withQueryString();

        $categories = Category::where('is_active', true)
            ->orderBy('name')
            ->get();

        return compact('products', 'categories');
    }


    private function saveImage($request)
    {
        $image = $request->file('image');
        $extension = $image->getClientOriginalExtension();
        $imageName = time() . '.' . $extension;
        $directory = 'product-images/';
        $image->move(public_path($directory), $imageName);

        return $directory . $imageName;
    }

    public function store($request)
    {
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
        return $product->load('categories');
    }

    public function find(int $id): ?Product
    {
        return $this->productsModel->with('categories')->findOrFail($id);
    }

    public function update($request, $product)
    {
        // Step 1: Handle image update
        if ($request->hasFile('image')) {
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }
            $product->image = $this->saveImage($request);
        }

        // Step 2: Update product fields
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        // Step 3: Update categories
        if (!empty($request->categories)) {
            $product->categories()->sync($request->categories);
        }

        return $product->load('categories');
    }
    public function deleteProduct($product)
{
    // Step 1: Delete product image if exists
    if ($product->image && file_exists(public_path($product->image))) {
        unlink(public_path($product->image));
    }

    // Step 2: Detach categories
    $product->categories()->detach();

    // Step 3: Delete product
    $product->delete();

    return true;
}

}