<!DOCTYPE html>
<html>
<head>
    <title>User Panel - @yield('title')</title>
</head>
<body>
    <nav>
        <a href="/user/dashboard">Dashboard</a>
        <a href="/user/profil">Profil</a>
        <a href="/logout">Logout</a>
    </nav>

    <div class="content">
        @yield('content')
    </div>
</body>
</html>
