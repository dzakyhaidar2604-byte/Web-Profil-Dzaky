<!DOCTYPE html>
<!-- Alpine.js untuk handle Dark Mode State -->
<html lang="en" x-data="{ darkMode: localStorage.getItem('theme') === 'dark' }" x-init="$watch('darkMode', val => localStorage.setItem('theme', val ? 'dark' : 'light'))" :class="{ 'dark': darkMode }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Portofolio Maszeh | Fullstack Developer</title>
    
    <!-- Fonts & Scripts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; scroll-behavior: smooth; }
        /* Glassmorphism Classes */
        .glass { background: rgba(255, 255, 255, 0.4); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2); }
        .glass-dark { background: rgba(17, 24, 39, 0.6); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.05); }
    </style>
</head>
<body class="bg-gradient-to-br from-indigo-50 via-white to-pink-50 dark:from-gray-900 dark:via-gray-800 dark:to-black text-gray-800 dark:text-gray-100 transition-colors duration-500">

    <!-- Navbar Minimalis dengan Toggle Dark Mode -->
    <nav class="fixed w-full z-40 glass dark:glass-dark transition-all">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="font-bold text-xl tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-indigo-500 to-pink-500">Maszeh.</h1>
            <div class="flex gap-6 items-center">
                <a href="#about" class="hover:text-indigo-500 dark:hover:text-indigo-400 font-medium">About</a>
                <a href="#portfolio" class="hover:text-indigo-500 dark:hover:text-indigo-400 font-medium">Portfolio</a>
                <button @click="darkMode = !darkMode" class="p-2 rounded-full bg-gray-200 dark:bg-gray-700 hover:scale-110 transition-transform">
                    <!-- Icon Light/Dark (Gunakan SVG icon di sini, disingkat untuk keterbacaan) -->
                    <span x-show="!darkMode">🌙</span>
                    <span x-show="darkMode">☀️</span>
                </button>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <!-- Chatbot Component -->
    @include('components.chatbot')

</body>
</html>