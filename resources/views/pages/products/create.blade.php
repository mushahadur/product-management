<!-- resources/views/home.blade.php -->
@extends('layouts.app')

@section('title')
    Create Products
@endsection

@section('content')
    <h1 class="text-3xl font-semibold text-gray-800 dark:text-gray-100 mb-8 text-center md:text-left">
        Create Products
    </h1>
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
    <div class="grid grid-cols" role="list" id="product-list">

        <form action="{{ route('products.store') }}" method="POST"
            class="col-span-1 sm:col-span-2 md:col-span-2 lg:col-span-2 bg-white dark:bg-gray-800 p-6 rounded-sm shadow-md"
            enctype="multipart/form-data">
            @csrf
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100 mb-4">Add New Product</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Product
                        Name</label>
                    <input type="text" name="name" id="name"
                        class="my-1 p-2 block w-full border-gray-300 dark:border-gray-600 rounded-sm shadow-sm focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 bg-gray-200 dark:text-white"
                        value="{{ old('name') }}">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4 row-span-2">
                    <label for="description"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                    <textarea name="description" id="description"
                        class="my-1 p-2 block w-full border-gray-300 dark:border-gray-600 rounded-sm shadow-sm focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 bg-gray-200 dark:text-white"
                        rows="4">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Price</label>
                    <input type="text" name="price" id="price" step="0.01"
                        class="my-1 p-2 block w-full border-gray-300 dark:border-gray-600 rounded-sm shadow-sm focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 bg-gray-200 dark:text-white"
                        value="{{ old('price') }}">
                    @error('price')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Image</label>
                    <input type="file" name="image" id="image"
                        class="my-1 p-2 block w-full border-gray-300 dark:border-gray-600 rounded-sm shadow-sm focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 bg-gray-200 dark:text-white">
                    @error('image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <div class="mb-4 md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Categories</label>
                        <div class="mt-2 space-y-2">
                            @foreach ($categories as $category)
                                <div>
                                    <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                        id="cat-{{ $category->id }}" class="mr-2 leading-tight"
                                        value="{{ $category->id }}"
                                        {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }}>
                                    <label for="cat-{{ $category->id }}"
                                        class="text-gray-700 dark:text-gray-300">{{ $category->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>

            </div>
            <button type="submit"
                class="bg-teal-600 text-white px-4 py-2 rounded-sm hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200">
                Save Product
            </button>
        </form>

    </div>
@endsection
