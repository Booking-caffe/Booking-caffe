<!DOCTYPE html>
<html>
<head>
    <title>Admin - @yield('title')</title>

    <link rel="stylesheet" href="{{ asset ('css/style.css') }}">
    <script src="{{ asset('js/user_home.js') }}"></script>
</head>

<body>
<div class="container">
    <!-- SIDEBAR -->
        <aside class="sidebar">
            <div class="logo"></div>

            <ul class="menu">
                
                <li><a href="dashboard.html">Home</a></li>
                <li><a href="makanan.html" class="active">Makanan</a></li>
                <li><a href="minuman.html">Minuman</a></li>
                <li><a href="datauser.html">Data User</a></li>
                <li><a href="riwayat.html">Riwayat</a></li>
                <li><a href="#">Setting</a></li>
            </ul>

            <a href="{{ route('logout-admin') }}" class="logout">Keluar</a>
        </aside>

    {{-- Load Content --}}
    <div class="content">
        @yield('content')
    </div>
</div>
</body>
</html>