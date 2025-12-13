<!DOCTYPE html>
<html>
<head>
    <title>Admin - @yield('title')</title>

    <link rel="stylesheet" href="{{ asset ('css/style.css') }}">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&amp;family=Playfair+Display:wght@700 amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    @stack('styles')
    @stack('styles-cdn')
    <script src="{{ asset('js/user_home.js') }}"></script>

     <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: 
                            "#513B2E", // A rich, dark coffee brown
                            "background-light": "#F5F0E8", // A creamy off-white, like latte foam
                            "background-dark": "#1F1A17", // A very dark brown, like dark roast beans
                            "card-light": "#FFFFFF",
                            "card-dark": "#2C2521",
                            "text-light": "#513B2E",
                            "text-dark": "#DCD0C0",
                            "text-muted-light": "#755F4D",
                            "text-muted-dark": "#A08C78",
                            secondary: "#e0c9a6", // A creamy beige
                            accent: "#4caf50", // A soft green for accents/selection
                            "background-light": "#f5f3f0", // Light cream background
                            "background-dark": "#2c2522", // Dark coffee bean background
                            "surface-light": "#ffffff",
                            "surface-dark": "#3e3532", // A slightly lighter brown for dark mode surfaces
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
                    boxShadow: {
                    'soft-lg': '0 10px 15px -3px rgba(51, 38, 35, 0.1), 0 4px 6px -2px rgba(51, 38, 35, 0.05)',
                    'soft-md': '0 4px 6px -1px rgba(51, 38, 35, 0.1), 0 2px 4px -1px rgba(51, 38, 35, 0.06)',
                    },
                },
            },
        };

    </script>
</head>

<body>
<div class="container">
    <!-- SIDEBAR -->
        <aside class="sidebar">
            <div class="logo"></div>

            <ul class="menu">
                
                <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li><a href="{{ route('showMakanan') }}">Makanan</a></li>
                <li><a href="{{ route('showMinuman') }}">Minuman</a></li>
                <li><a href="{{ route('admin.datauser') }}">Data User</a></li>
                <li><a href="{{ route('admin.riwayat') }}">Riwayat</a></li>

                <li><a href="#">Setting</a></li>
            </ul>

            <a href="{{ route('logout-admin') }}" class="logout">Keluar</a>
        </aside>

    {{-- Load Content --}}
    <div class="content">
        @yield('content')
    </div>
</div>

   @stack('extra-script')
</body>
</html>