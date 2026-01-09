<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>@yield('title')</title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&amp;family=Playfair+Display:wght@700&amp;display=swap" rel="stylesheet" />

    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('css/user_home.css') }}">
    
    @stack('styles')
    @stack('styles-cdn')

    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#513B2E", // A rich, dark coffee brown
                        "background-light": "#F5F0E8", // A creamy off-white, like latte foam
                        "background-dark": "#1F1A17", // A very dark brown, like dark roast beans
                        "card-light": "#FFFFFF",
                        "card-dark": "#2C2521",
                        "text-light": "#513B2E",
                        "text-dark": "#DCD0C0",
                        "text-muted-light": "#755F4D",
                        "text-muted-dark": "#A08C78"
                    },
                    fontFamily: {
                        display: ["Playfair Display", "serif"],
                        sans: ["Poppins", "sans-serif"],
                    },
                    borderRadius: {
                        DEFAULT: "0.5rem", // 8px
                        lg: "1rem", // 16px
                        xl: "1.5rem" // 24px
                    },
                },
            },
        };
    </script>
</head>

<body
    class="bg-background-light dark:bg-background-dark font-sans text-text-light dark:text-text-dark transition-colors duration-300">
    <div class="flex flex-col min-h-screen" id="root">
        <header class="bg-card-light/80 dark:bg-card-dark/80 backdrop-blur-sm sticky top-0 z-50 shadow-md">
            
            <nav class="container mx-auto px-6 py-4 grid grid-cols-3 items-center">

            <!-- KIRI : LOGO -->
            <div class="flex justify-start">
                <a href="{{ route('home') }}"
                class="font-display text-2xl font-bold text-primary">
                    Kopi Senja
                </a>
            </div>

            <!-- TENGAH : MENU -->
            <div class="hidden md:flex justify-center items-center space-x-8">
                <a href="{{ route('home') }}" class="font-medium hover:text-primary">
                    Home
                </a>

                <div class="relative">
                    <button id="desktopMenuBtn"
                        class="flex items-center gap-1 font-medium hover:text-primary">
                        Menu
                        <span class="material-symbols-outlined text-sm transition-transform"
                            id="desktopMenuIcon">
                            expand_more
                        </span>
                    </button>

                    <div id="desktopDropdown"
                        class="absolute left-1/2 -translate-x-1/2 mt-2 w-40
                            bg-white dark:bg-card-dark shadow-lg rounded-md
                            hidden">
                        <a href="{{ route('menu-makanan') }}"
                        class="block px-4 py-2 hover:bg-gray-100">
                            Makanan
                        </a>
                        <a href="{{ route('menu-minuman') }}"
                        class="block px-4 py-2 hover:bg-gray-100">
                            Minuman
                        </a>
                    </div>
                </div>

            </div>

            <!-- KANAN : AUTH + CART -->
            <div class="hidden md:flex justify-end items-center gap-3">
                @if (session('id_pelanggan'))
                    <span class="text-sm">Hallo, {{ session('nama_pelanggan') }}</span>
                    <form action="{{ route('logout-pelanggan') }}" method="POST">
                        @csrf
                        <button class="text-sm hover:text-red-500">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-sm hover:text-primary">Login</a>
                    <a href="{{ route('register') }}" class="text-sm hover:text-primary">Sign Up</a>
                @endif

                <a href="{{ route('keranjang') }}" class="hover:text-primary">
                    <span class="material-symbols-outlined">shopping_cart</span>
                </a>
            </div>

            <div></div>
            <!-- HAMBURGER (MOBILE) -->
            <div class="flex justify-end md:hidden">
                <button id="hamburgerBtn" class="text-text-light dark:text-text-dark">
                    <span class="material-symbols-outlined">menu</span>
                </button>
            </div>

        </nav>




            <!-- Mobile Menu -->
            <div id="mobileMenu"
                class="hidden md:hidden bg-card-light dark:bg-card-dark shadow-lg border-t border-gray-200 dark:border-gray-700">

                <div class="px-6 py-5 space-y-6">

                    <!-- NAV -->
                    <nav class="space-y-3">

                        <a href="{{ route('home') }}"
                        class="block rounded-lg px-3 py-2 text-base font-medium
                                transition-all duration-200
                                hover:bg-primary/10 hover:text-primary">
                            Home
                        </a>

                        <!-- Dropdown Menu -->
                        <div class="space-y-2">
                            <button id="menuToggle"
                                    class="flex w-full items-center justify-between
                                        rounded-lg px-3 py-2 text-base font-medium
                                        transition-all duration-200
                                        hover:bg-primary/10 hover:text-primary">
                                Menu
                                <span class="material-symbols-outlined text-sm transition-transform duration-200">
                                    expand_more
                                </span>
                            </button>

                            <div id="submenu" class="hidden pl-4 space-y-1">
                                <a href="{{ route('menu-makanan') }}"
                                class="block rounded-md px-3 py-1.5 text-sm
                                        transition-all duration-200
                                        hover:bg-primary/10 hover:text-primary">
                                    Makanan
                                </a>
                                <a href="{{ route('menu-minuman') }}"
                                class="block rounded-md px-3 py-1.5 text-sm
                                        transition-all duration-200
                                        hover:bg-primary/10 hover:text-primary">
                                    Minuman
                                </a>
                            </div>
                        </div>

                    </nav>

                    <!-- DIVIDER -->
                    <hr class="border-gray-200 dark:border-gray-700">

                    <!-- AUTH -->
                    <div class="space-y-2">
                        @if (session('id_pelanggan'))
                            <p class="px-3 text-sm text-text-muted-light dark:text-text-muted-dark">
                                Hallo, {{ session('nama_pelanggan') }}
                            </p>

                            <form action="{{ route('logout-pelanggan') }}" method="POST">
                                @csrf
                                <button type="submit"
                                        class="w-full rounded-lg px-3 py-2 text-left text-sm font-medium
                                            transition-all duration-200
                                            hover:bg-red-500/10 hover:text-red-500">
                                    Logout
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}"
                            class="block rounded-lg px-3 py-2 text-sm font-medium
                                    transition-all duration-200
                                    hover:bg-primary/10 hover:text-primary">
                                Login
                            </a>
                            <a href="{{ route('register') }}"
                            class="block rounded-lg px-3 py-2 text-sm font-medium
                                    transition-all duration-200
                                    hover:bg-primary/10 hover:text-primary">
                                Sign Up
                            </a>
                        @endif
                    </div>

                    <!-- DIVIDER -->
                    <hr class="border-gray-200 dark:border-gray-700">

                    <!-- CART -->
                    <a href="{{ route('keranjang') }}"
                    class="flex items-center gap-3 rounded-lg px-3 py-2 text-base font-medium
                            transition-all duration-200
                            hover:bg-primary/10 hover:text-primary">
                        <span class="material-symbols-outlined">shopping_cart</span>
                        Keranjang
                    </a>

                </div>
            </div>

        </header>

        {{-- Content --}}
        <main class="flex-grow">
            @yield('content')
        </main>

        
        <footer class="bg-card-light dark:bg-card-dark pt-12 pb-6">
            <div class="container mx-auto px-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                    <div class="md:col-span-1">
                        <h4 class="font-display text-xl font-bold text-primary mb-4">Kopi Senja</h4>
                        <p class="text-text-muted-light dark:text-text-muted-dark text-sm mb-4">
                            {{ file_exists(resource_path('kopi_senja.txt')) ? file_get_contents(resource_path('kopi_senja.txt')) : 'Cafe adalah tempat bersantai untuk semua kalangan dari anak muda sampai di kalangan orang tua juga.' }}
                        </p>
                        <div class="flex space-x-4">
                            <a aria-label="Facebook"
                                class="text-text-light dark:text-text-dark hover:text-primary dark:hover:text-white transition-colors duration-300"
                                href="#"><svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z">
                                    </path>
                                </svg></a>
                            <a aria-label="Instagram"
                                class="text-text-light dark:text-text-dark hover:text-primary dark:hover:text-white transition-colors duration-300"
                                href="#"><svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.85s-.011 3.584-.069 4.85c-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07s-3.584-.012-4.85-.07c-3.252-.148-4.771-1.691-4.919-4.919-.058-1.265-.069-1.645-.069-4.85s.011-3.584.069-4.85c.149-3.225 1.664-4.771 4.919-4.919 1.266-.057 1.644-.069 4.85-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948s.014 3.667.072 4.947c.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072s3.667-.014 4.947-.072c4.358-.2 6.78-2.618 6.98-6.98.059-1.281.073-1.689.073-4.948s-.014-3.667-.072-4.947c-.2-4.358-2.618-6.78-6.98-6.98C15.667.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.88 1.44 1.44 0 000-2.88z">
                                    </path>
                                </svg></a>
                        </div>
                    </div>
                    <div>
                        <h4 class="font-display text-xl font-bold text-primary mb-4">Hubungi Kami</h4>

                        @php
                            $hubungi = [
                                'telepon1' => '+62-812-1234-1234',
                                'telepon2' => '+62-812-1234-1234',
                                'alamat' => 'Jl. Nasional 1 Patrol, Kec. Patrol, Kab. Indramayu, Jawa Barat 45257'
                            ];
                            if (file_exists(resource_path('hubungi_kami.json'))) {
                                $json = file_get_contents(resource_path('hubungi_kami.json'));
                                $data = json_decode($json, true);
                                if (is_array($data)) {
                                    $hubungi = array_merge($hubungi, $data);
                                }
                            }
                        @endphp

                        <ul class="space-y-3 text-sm">
                            <li class="flex items-center">
                                <span class="material-symbols-outlined text-primary mr-3">call</span>
                                <span class="text-text-muted-light dark:text-text-muted-dark">{{ $hubungi['telepon1'] }}</span>
                            </li>
                            <li class="flex items-center">
                                <span class="material-symbols-outlined text-primary mr-3">call</span>
                                <span class="text-text-muted-light dark:text-text-muted-dark">{{ $hubungi['telepon2'] }}</span>
                            </li>
                            <li class="flex items-start">
                                <span class="material-symbols-outlined text-primary mr-3 mt-1">location_on</span>
                                <span class="text-text-muted-light dark:text-text-muted-dark">J{{ $hubungi['alamat'] }}</span>
                            </li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="font-display text-xl font-bold text-primary mb-4">Lokasi</h4>

                        @php
                            $lokasi = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.8398418536863!2d107.96222481477006!3d-6.414444995358054!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6eb5c1979b90c3%3A0x6b4c6e917d057a6e!2sPatrol%2C%20Indramayu%20Regency%2C%20West%20Java!5e0!3m2!1sen!2sid!4v1620896081465!5m2!1sen!2sid';
                            if (file_exists(resource_path('lokasi.txt'))){
                                $lokasiRaw = trim(file_get_contents(resource_path('lokasi.txt')));
                                // Jika input berupa tag iframe, ambil hanya src
                                if (preg_match('/<iframe[^>]*src=["\']([^"\']+)["\']/i', $lokasiRaw, $matches)) {
                                    $lokasi = $matches[1];
                                } else if (!empty($lokasiRaw)) {
                                    $lokasi = $lokasiRaw;
                                }
                            }
                        @endphp


                        <div class="rounded-lg overflow-hidden shadow-lg aspect-video">
                            <iframe allowfullscreen="" height="100%" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"
                                src="{{ $lokasi }}"
                                style="border:0;" width="100%"></iframe>
                        </div>
                    </div>
                </div>
                <div
                    class="border-t border-gray-200 dark:border-gray-700 pt-6 text-center text-sm text-text-muted-light dark:text-text-muted-dark">
                    <p>Hak Cipta © Copyright 2025. Kopi Senja.</p>
                </div>
            </div>
        </footer>
    </div>
    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.carousel-slide');
        const track = document.querySelector('.carousel-track');
        const totalSlides = slides.length;

        function updateCarousel() {
            track.style.transform = `translateX(-${currentSlide * 100}%)`;
        }

        function moveSlide(direction) {
            currentSlide = (currentSlide + direction + totalSlides) % totalSlides;
            updateCarousel();
        }
        setInterval(() => {
            moveSlide(1);
        }, 5000);


    document.addEventListener('DOMContentLoaded', function () {
        const hamburger = document.getElementById('hamburgerBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        const menuToggle = document.getElementById('menuToggle');
        const submenu = document.getElementById('submenu');

        hamburger.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        menuToggle.addEventListener('click', () => {
            submenu.classList.toggle('hidden');
        });

        // Tutup menu saat klik di luar
        document.addEventListener('click', (e) => {
            if (!mobileMenu.contains(e.target) && !hamburger.contains(e.target)) {
                mobileMenu.classList.add('hidden');
            }
        });
    });

    document.addEventListener('DOMContentLoaded', () => {
        const btn = document.getElementById('desktopMenuBtn');
        const dropdown = document.getElementById('desktopDropdown');
        const icon = document.getElementById('desktopMenuIcon');

        btn.addEventListener('click', (e) => {
            e.stopPropagation();
            dropdown.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');
        });

        // Tutup jika klik di luar
        document.addEventListener('click', () => {
            dropdown.classList.add('hidden');
            icon.classList.remove('rotate-180');
        });
    });

    </script>
    @stack('extra-scripts')

</body>

</html>
