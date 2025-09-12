@extends('layouts.app')

@section('title')
    Products
@endsection
@section('content')
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 px-4 md:px-6">
        <h1 class="text-3xl font-semibold text-gray-800 dark:text-gray-100 text-center md:text-left mb-4 md:mb-0">
            All Products
        </h1>
        <a href="{{ route('products.create') }}"
            class="bg-teal-600 text-white px-4 py-2 rounded-md hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200 w-full md:w-auto text-center">
            Add Products
        </a>
    </div>
    <div class="grid grid-cols-1 gap-6 px-4 md:px-6">
        <!-- Success Message -->
        @if (session('success'))
            <div class="bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-600 text-green-700 dark:text-green-200 px-4 py-3 rounded-sm mb-6"
                role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif
        <div class="bg-white dark:bg-gray-800 p-6 rounded-sm shadow-md">
            {{-- <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">Product List</h2> --}}
            <div class="flex flex-col md:flex-row justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4 md:mb-0">
                    Product List
                </h2>
                <!-- Search Form -->
                <form method="GET" action="{{ route('products.index') }}"
                    class="flex flex-col md:flex-row items-center space-y-2 md:space-y-0 md:space-x-2 w-full md:w-auto">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search products..." class="border rounded-sm px-3 py-1 w-full md:w-64">
                    <button type="submit"
                        class="bg-cyan-600 text-white px-4 py-1 rounded-sm hover:bg-cyan-700 w-full md:w-auto mt-2 md:mt-0">
                        Search
                    </button>
                    @if (request('search'))
                        <a href="{{ route('products.index') }}"
                            class="text-red-500 ml-0 md:ml-2 mt-2 md:mt-0 w-full md:w-auto text-center">
                            Clear
                        </a>
                    @endif
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200 dark:border-gray-700 w-full">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th
                                class="px-4 py-2 text-left border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 whitespace-nowrap">
                                SL</th>
                            <th
                                class="px-4 py-2 text-left border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 whitespace-nowrap">
                                Name</th>
                            <th
                                class="px-4 py-2 text-left border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 whitespace-nowrap">
                                Categores</th>
                            <th
                                class="px-4 py-2 text-left border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 whitespace-nowrap">
                                Price</th>
                            <th
                                class="px-4 py-2 text-left border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 whitespace-nowrap">
                                Description</th>
                            <th
                                class="px-4 py-2 text-left border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 whitespace-nowrap">
                                Image</th>
                            <th
                                class="px-4 py-2 text-left border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 whitespace-nowrap">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                                <td
                                    class="px-4 py-2 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-gray-100 whitespace-nowrap">
                                    {{ $loop->iteration }}</td>
                                <td
                                    class="px-4 py-2 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-gray-100 whitespace-nowrap">
                                    {{ $product->name }}</td>
                                    <td class="px-4 py-2 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-gray-100 whitespace-nowrap">
                                        @if($product->categories->isNotEmpty())
                                            @foreach($product->categories as $category)
                                                <span class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold px-2 py-1 rounded mr-1">
                                                    {{ $category->name }}
                                                </span>
                                            @endforeach
                                        @else
                                            <span class="text-gray-500">No Category</span>
                                        @endif
                                    </td>
                                    
                                <td
                                    class="px-4 py-2 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-gray-100 whitespace-nowrap">
                                    ${{ number_format($product->price, 2) }}</td>
                                <td
                                    class="px-4 py-2 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-gray-100 whitespace-nowrap">
                                    {{ $product->description }}</td>
                                <td
                                    class="px-4 py-2 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-gray-100 whitespace-nowrap">
                                    
                                        <img src="{{ asset( $product->image) }}" alt="{{ $product->name }}"
                                            height="40" width="50" class="rounded">
                                   
                                </td>
                                <td class="px-4 py-2 border border-gray-200 dark:border-gray-600">
                                    <div class="flex flex-col md:flex-row items-center justify-center gap-3">

                                        <!-- Edit Button -->
                                        <button onclick="openEditModal({{ $product->id }})"
                                            class="text-blue-600 dark:text-blue-400 hover:underline flex items-center gap-1">
                                            <i class="fas fa-edit"></i>
                                            <span>Edit</span>
                                        </button>

                                        <!-- Delete Button -->
                                        <form class="mt-3" action="{{ route('products.destroy', $product->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this product?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 dark:text-red-400 hover:underline flex items-center gap-1">
                                                <i class="fas fa-trash"></i>
                                                <span>Delete</span>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-gray-500 dark:text-gray-400">No products
                                    found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $products->links() }}
            </div>
        </div>
    </div>

    <!-- Modal -->
<!-- Edit Modal -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white dark:bg-gray-800 p-4 sm:p-6 rounded-sm shadow-md w-full max-w-lg relative transform transition-all duration-300 ease-in-out">
        <button onclick="closeEditModal()" class="absolute top-2 right-2 text-gray-500 text-2xl hover:text-gray-700 dark:text-gray-300 dark:hover:text-gray-100">&times;</button>

        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100 mb-4 text-center sm:text-left">Edit Product</h2>

        <form id="editProductForm" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')
            <input type="hidden" name="product_id" id="edit_product_id">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Product Name -->
                <div class="mb-4">
                    <label for="edit_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Product Name</label>
                    <input type="text" name="name" id="edit_name" placeholder="Enter name" required
                        class="w-full p-2 border rounded-md focus:ring-teal-500 focus:border-teal-500 bg-gray-200 dark:bg-gray-700 dark:text-white">
                </div>
                 <!-- Price -->
                 <div class="mb-4">
                    <label for="edit_price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Price</label>
                    <input type="number" name="price" id="edit_price" step="0.01" placeholder="Enter price" required
                        class="w-full p-2 border rounded-md focus:ring-teal-500 focus:border-teal-500 bg-gray-200 dark:bg-gray-700 dark:text-white">
                </div>

                <!-- Description -->
                <div class="mb-4 md:col-span-2">
                    <label for="edit_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                    <textarea name="description" id="edit_description" placeholder="Enter description" rows="4"
                        class="w-full p-2 border rounded-md focus:ring-teal-500 focus:border-teal-500 bg-gray-200 dark:bg-gray-700 dark:text-white"></textarea>
                </div>

               

                <!-- Image -->
                <div class="mb-4">
                    <label for="edit_image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Image</label>
                    <input type="file" name="image" id="edit_image"
                        class="w-full p-2 border rounded-md focus:ring-teal-500 focus:border-teal-500 bg-gray-200 dark:bg-gray-700 dark:text-white">
                    <img id="edit_image_preview" src="" class="mt-2 w-24 h-24 object-cover hidden">
                </div>

                <!-- Categories -->
                <div class="mb-4 md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Categories</label>
                    <div class="mt-2 space-y-2" id="edit_categories_list">
                        @foreach ($categories as $category)
                            <div>
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                    id="edit_cat-{{ $category->id }}" class="mr-2">
                                <label for="edit_cat-{{ $category->id }}"
                                    class="text-gray-700 dark:text-gray-300">{{ $category->name }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <button type="submit"
                class="w-full sm:w-auto bg-teal-600 text-white px-4 py-2 rounded-md hover:bg-teal-700 mt-4">
                Update Product
            </button>
        </form>
    </div>
</div>


@endsection


@section('scripts')
<script>
    function openEditModal(productId) {
        const modal = document.getElementById('editModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    
        // Fetch product data
        fetch(`/products/${productId}/edit`)
        .then(res => res.json())
        .then(data => {
            document.getElementById('edit_product_id').value = data.id;
            document.getElementById('edit_name').value = data.name;
            document.getElementById('edit_description').value = data.description ?? '';
            document.getElementById('edit_price').value = data.price;
    
            // Categories
            const categories = data.categories; // array of category ids
            Array.from(document.querySelectorAll('#edit_categories_list input[type=checkbox]')).forEach(cb => {
                cb.checked = categories.includes(parseInt(cb.value));
            });
    
            // Image preview
            const preview = document.getElementById('edit_image_preview');
            if(data.image){
                preview.src = '/' + data.image;
                preview.classList.remove('hidden');
            }
        })
        .catch(err => console.error(err));
    }
    
    function closeEditModal() {
        const modal = document.getElementById('editModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
    
    // Show preview for new image
    document.getElementById('edit_image').addEventListener('change', function(e){
        const preview = document.getElementById('edit_image_preview');
        preview.src = URL.createObjectURL(e.target.files[0]);
        preview.classList.remove('hidden');
    });
    
    // Submit form via AJAX
    document.getElementById('editProductForm').addEventListener('submit', function(e){
        e.preventDefault();
    
        const productId = document.getElementById('edit_product_id').value;
        const formData = new FormData(this);
    
        fetch(`/products/${productId}`, {
            method: 'POST',
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if(data.success){
                alert('Product updated successfully!');
                location.reload(); // reload page to see updated data
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(err => console.error(err));
    });
    </script>
    
    

    @endsection