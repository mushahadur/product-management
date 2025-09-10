<!-- resources/views/home.blade.php -->
@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-semibold text-gray-800 dark:text-gray-100 mb-8 text-center md:text-left">
        All Products
    </h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6" role="list" id="product-list">

        @if ($products->count() > 0)
            @foreach ($products as $product)
                <article
                    class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden flex flex-col transition-colors duration-500"
                    role="listitem">
                    <img alt="{{ $product->name }}" class="w-full h-48 object-cover" height="300"
                        src="{{ asset($product->image) }}" width="400" />
                    <div class="p-4 flex flex-col flex-grow">
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-2">
                            {{ $product->name }}
                        </h2>

                        <div class="flex flex-wrap gap-2 mb-2">
                            @foreach ($product->categories as $category)
                                <span
                                    class="inline-block bg-green-100 dark:bg-green-700 text-green-800 dark:text-green-200 text-xs font-semibold px-2 py-1 rounded-full">
                                    {{ $category->name }}
                                </span>
                            @endforeach

                        </div>
                        <p class="text-gray-600 dark:text-gray-300 flex-grow">
                            {{ $product->description }}
                        </p>
                        <div class="mt-4 font-bold text-indigo-600 dark:text-indigo-400 text-xl">
                            ${{ $product->price }}
                        </div>
                    </div>
                </article>
            @endforeach
        @else
            <article
                class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden flex flex-col transition-colors duration-500"
                role="listitem">
                <img alt="Smart watch with black strap and digital display showing time and health stats on a white background"
                    class="w-full h-48 object-cover" height="300"
                    src="https://storage.googleapis.com/a1aa/image/a2ae4b65-55a9-4b06-54e9-63a016488c43.jpg"
                    width="400" />
                <div class="p-4 flex flex-col flex-grow">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-2">
                        Smart Watch
                    </h2>
                    <div class="flex flex-wrap gap-2 mb-2">
                        <span
                            class="inline-block bg-indigo-100 dark:bg-indigo-700 text-indigo-800 dark:text-indigo-200 text-xs font-semibold px-2 py-1 rounded-full">
                            Wearable
                        </span>
                        <span
                            class="inline-block bg-red-100 dark:bg-red-700 text-red-800 dark:text-red-200 text-xs font-semibold px-2 py-1 rounded-full">
                            Health
                        </span>
                        <span
                            class="inline-block bg-yellow-100 dark:bg-yellow-700 text-yellow-800 dark:text-yellow-200 text-xs font-semibold px-2 py-1 rounded-full">
                            GPS
                        </span>
                    </div>
                    <p class="text-gray-600 dark:text-gray-300 flex-grow">
                        Stylish smart watch with heart rate monitor, GPS, and customizable watch faces.
                    </p>
                    <div class="mt-4 font-bold text-indigo-600 dark:text-indigo-400 text-xl">
                        $149.99
                    </div>
                </div>
            </article>
        @endif

    </div>
@endsection
