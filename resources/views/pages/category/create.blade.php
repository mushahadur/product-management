<!-- resources/views/home.blade.php -->
@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-semibold text-gray-800 dark:text-gray-100 mb-8 text-center md:text-left">
        Create Category
    </h1>
    <div class="grid grid-cols" role="list" id="product-list">
        <div class="">
            <form action="{{ route('categories.store') }}" method="POST"
            class="col-span-1 sm:col-span-2 md:col-span-2 lg:col-span-2 bg-white dark:bg-gray-800 p-6 rounded-sm shadow-md lg:flex lg:justify-between items-center"
            enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Product Name</label>
                <input type="text" name="name" id="name"
                    class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-sm shadow-sm focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 bg-gray-200 dark:text-white"
                    required>
            </div>
            <button type="submit"
                class="bg-teal-600 text-white px-4 py-2 rounded-sm hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200">
                Save Category
            </button>
        </form>
        </div>
    </div>
@endsection
