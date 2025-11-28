<!DOCTYPE html>
<html>
<head>
    <title>User - @yield('title')</title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&amp;family=Playfair+Display:wght@700&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>

    <link rel="stylesheet" href="{{ asset ('css/user_home.css') }}">

    @yield('user-home')
    <script src="{{ asset('js/user_home.js') }}"></script>
</head>

<body>
    <body class="bg-background-light dark:bg-background-dark font-sans text-text-light dark:text-text-dark transition-colors duration-300">
        <div class="flex flex-col min-h-screen" id="root">
        <header class="bg-card-light/80 dark:bg-card-dark/80 backdrop-blur-sm sticky top-0 z-50 shadow-md">
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
                <a class="font-display text-2xl font-bold text-primary" href="#">Kopi Senja</a>
                <div class="hidden md:flex items-center space-x-8">
                <a class="text-text-light dark:text-text-dark hover:text-primary dark:hover:text-white transition-colors duration-300 font-medium" href="{{ route('dashboard') }}">Home</a>
                <a class="text-text-light dark:text-text-dark hover:text-primary dark:hover:text-white transition-colors duration-300 font-medium" href="{{ route('data-menu') }}">Menu</a>
            </div>
            <div class="flex items-center space-x-4">
                <button aria-label="shopping cart" class="text-text-light dark:text-text-dark hover:text-primary dark:hover:text-white transition-colors duration-300">
                    <span class="material-symbols-outlined">shopping_cart</span>
                </button>
                <button aria-label="mobile menu" class="md:hidden text-text-light dark:text-text-dark">
                    <span class="material-symbols-outlined">menu</span>
                </button>
            </div>
        </nav>
    </header>

    {{-- Load Content --}}
    <div class="content">
        @yield('content')
    </div>

    {{-- Tempat semua script dikumpulkan --}}
    @stack('scripts')
</div>
</body>
</html>