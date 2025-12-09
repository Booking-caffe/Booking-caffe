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
                
                <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li><a href="{{ route('admin.makanan') }}">Makanan</a></li>
                <li><a href="{{ route('admin.minuman') }}">Minuman</a></li>
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
</body>
</html>