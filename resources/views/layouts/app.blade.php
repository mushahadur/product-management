<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>
        @yield('title')  | Product Management System
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Enable dark mode class strategy
        tailwind.config = {
            darkMode: 'class',
        }
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&amp;display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>

</head>

<body class="flex flex-col min-h-screen bg-gray-100 dark:bg-gray-900 transition-colors duration-500">
    <!-- Header -->
    @include('layouts.includes.header')
    <!-- Main content -->
    <main class="flex-grow container mx-auto px-4 py-8">
        @yield('content')
    </main>


    <!-- Footer -->
    @include('layouts.includes.footer')
    @yield('scripts')
</body>

</html>
