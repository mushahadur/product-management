<!-- Header -->
<header class="bg-white dark:bg-gray-800 shadow-md transition-colors duration-500">
    <div class="container mx-auto px-4 py-4 flex items-center justify-between">
        <a class="text-2xl font-semibold text-indigo-600 dark:text-indigo-400" href="#">
            LOGO
        </a>
        <nav class="hidden md:flex space-x-8 text-gray-700 dark:text-gray-300 font-medium">
            <a class="hover:text-indigo-600 dark:hover:text-indigo-400 transition" href="{{route('home')}}">
                Home
            </a>
            <a class="hover:text-indigo-600 dark:hover:text-indigo-400 transition" href="{{route('products.index')}}">
                Products
            </a>
            <a class="hover:text-indigo-600 dark:hover:text-indigo-400 transition" href="{{route('categories.index')}}">
                Category
            </a>
        </nav>
        <div class="flex items-center space-x-4">
            <button aria-label="Toggle dark mode"
                class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 transition text-lg focus:outline-none"
                id="theme-toggle">
                <i class="fas fa-moon" id="theme-icon"></i>
            </button>
            <a class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 transition text-lg"
                href="#">
                <i class="fas fa-user-circle"></i>
            </a>
            <button aria-label="Toggle menu"
                class="md:hidden text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-600"
                id="mobile-menu-button">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>
    </div>
    <!-- Mobile menu -->
    <nav class="hidden md:hidden bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700"
        id="mobile-menu">
        <a class="block px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-indigo-50 dark:hover:bg-indigo-900 hover:text-indigo-600 dark:hover:text-indigo-400 font-medium"
            href="#">
            Home
        </a>
        <a class="block px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-indigo-50 dark:hover:bg-indigo-900 hover:text-indigo-600 dark:hover:text-indigo-400 font-medium"
            href="#">
            Products
        </a>
        <a class="block px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-indigo-50 dark:hover:bg-indigo-900 hover:text-indigo-600 dark:hover:text-indigo-400 font-medium"
            href="#">
            User
        </a>
    </nav>
</header>