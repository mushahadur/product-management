@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-semibold text-gray-800 dark:text-gray-100 mb-8 text-center md:text-left">
        Category
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
    {{-- Form and Table Sections in Grid Layout --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6" role="list" id="category-list">
        {{-- Form Section --}}
        <div class="lg:col-span-3">
            <form action="{{ route('categories.store') }}" method="POST"
                class="bg-white dark:bg-gray-800 p-6 rounded-sm shadow-md" enctype="multipart/form-data">
                @csrf
                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4">Add Category</h3>
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category
                        Name</label>
                    <input type="text" name="name" id="name" placeholder="Enter Category Name"
                        class="my-1 p-2 block w-full border-gray-300 dark:border-gray-600 rounded-sm shadow-sm focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 bg-gray-200 dark:text-white">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit"
                    class="w-full bg-teal-600 text-white px-4 py-2 rounded-sm hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200">
                    Save Category
                </button>
            </form>
        </div>

        {{-- Table Section --}}
        <div class="lg:col-span-9">
            <div class="bg-white dark:bg-gray-800 p-4 rounded-sm shadow-md">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4 md:mb-0">
                        Category List
                    </h2>
                    <!-- Search Form -->
                    <form method="GET" action="{{ route('categories.index') }}"
                        class="flex flex-col md:flex-row items-center space-y-2 md:space-y-0 md:space-x-2 w-full md:w-auto">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Search categories..." class="border rounded-sm px-3 py-1 w-full md:w-64">
                        <button type="submit"
                            class="bg-cyan-600 text-white px-4 py-1 rounded-sm hover:bg-cyan-700 w-full md:w-auto mt-2 md:mt-0">
                            Search
                        </button>
                        @if (request('search'))
                            <a href="{{ route('categories.index') }}"
                                class="text-red-500 ml-0 md:ml-2 mt-2 md:mt-0 w-full md:w-auto text-center">
                                Clear
                            </a>
                        @endif
                    </form>
                </div>
            </div>

            <table class="min-w-full border border-gray-200 dark:border-gray-700">
                <thead class="bg-gray-100 dark:bg-gray-700">
                    <tr>
                        <th
                            class="px-4 py-2 text-left border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300">
                            SL</th>
                        <th
                            class="px-4 py-2 text-left border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300">
                            Name</th>
                        <th
                            class="px-4 py-2 text-left border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300">
                            Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                            <td
                                class="px-4 py-2 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-gray-100">
                                {{ $loop->iteration }}</td>
                            <td
                                class="px-4 py-2 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-gray-100">
                                {{ $category->name }}</td>
                            <td class="px-4 py-2 border border-gray-200 dark:border-gray-600">
                                <div class="flex flex-col md:flex-row items-center justify-center gap-3">

                                    <!-- Edit Button -->
                                    <button onclick="openEditModal({{ $category->id }})"
                                        class="text-blue-600 dark:text-blue-400 hover:underline flex items-center gap-1">
                                        <i class="fas fa-edit"></i>
                                        <span>Edit</span>
                                    </button>

                                    <!-- Delete Button -->
                                    <form class="mt-3" action="{{ route('categories.destroy', $category->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this category?');">
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
                            <td colspan="5" class="text-center py-4 text-gray-500 dark:text-gray-400">No categorys
                                found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="mt-4">
                {{-- {{ $categories->links() }} --}}
                {{ $categories->appends(request()->query())->links() }}
            </div>
        </div>
    </div>

    <!-- Edit Category Modal -->
    <div id="editCategoryModal" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-96 p-6">
            <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-gray-100">Edit Category</h2>

            <form id="editCategoryForm" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="edit_name" class="block text-gray-700 dark:text-gray-300">Category Name</label>
                    <input type="text" name="name" id="edit_name"
                        class="w-full border rounded-sm px-3 py-2 dark:bg-gray-700 dark:text-gray-100" required>
                </div>

                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeEditModal()"
                        class="px-4 py-1 bg-gray-500 text-white rounded-sm hover:bg-gray-600">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-1 bg-teal-600 text-white rounded hover:bg-teal-700">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    function openEditModal(id) {
        fetch(`/categories/${id}/edit`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('edit_name').value = data.name;
                document.getElementById('editCategoryForm').action = `/categories/${id}`;
                document.getElementById('editCategoryModal').classList.remove('hidden');
            })
            .catch(error => console.error("Error loading category:", error));
    }

    function closeEditModal() {
        document.getElementById('editCategoryModal').classList.add('hidden');
    }
</script>
@endsection

