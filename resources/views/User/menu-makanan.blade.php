@extends('layouts.user')

@section('title', 'Makanan')

@push('styles')
    <link rel="stylesheet" href="{{ asset ('css/user-menu.css') }}">
@endpush

@section('content')

<h1 style="text-align:center; margin-bottom:30px; font-size: 2rem;">Menu Makanan</h1>

    <div class="menu-container">
            
        <!-- 12 ITEM MAKANAN -->
        <!-- Anda bisa mengganti gambar dan nama makanan sesuka hati -->

        <a href="detail_minuman.html?menu=1" class="menu-card">
            <img src="https://via.placeholder.com/180">
            <h3>Jus jeruk</h3>
            <p>Rp. 100,-</p>
        </a>

        <a href="detail_minuman.html?menu=2" class="menu-card">
            <img src="https://via.placeholder.com/180">
            <h3>Jus Frifayer</h3>
            <p>Rp. 100,-</p>
        </a>

        <a href="detail_makanan.html?menu=3" class="menu-card">
            <img src="https://via.placeholder.com/180">
            <h3>Jus darah</h3>
            <p>Rp. 100,-</p>
        </a>

        <a href="detail_makanan.html?menu=4" class="menu-card">
            <img src="https://via.placeholder.com/180">
            <h3>Nasi Goreng</h3>
            <p>Rp. 100,-</p>
        </a>

        <a href="detail_makanan.html?menu=5" class="menu-card">
            <img src="https://via.placeholder.com/180">
            <h3>Nasi Goreng</h3>
            <p>Rp. 100,-</p>
        </a>

        <a href="detail_makanan.html?menu=6" class="menu-card">
            <img src="https://via.placeholder.com/180">
            <h3>Nasi Goreng</h3>
            <p>Rp. 100,-</p>
        </a>

        <a href="detail_makanan.html?menu=7" class="menu-card">
            <img src="https://via.placeholder.com/180">
            <h3>Nasi Goreng</h3>
            <p>Rp. 100,-</p>
        </a>

        <a href="detail_makanan.html?menu=8" class="menu-card">
            <img src="https://via.placeholder.com/180">
            <h3>Nasi Goreng</h3>
            <p>Rp. 100,-</p>
        </a>

        <a href="detail_makanan.html?menu=9" class="menu-card">
            <img src="https://via.placeholder.com/180">
            <h3>Nasi Goreng</h3>
            <p>Rp. 100,-</p>
        </a>

        <a href="detail_makanan.html?menu=10" class="menu-card">
            <img src="https://via.placeholder.com/180">
            <h3>Nasi Goreng</h3>
            <p>Rp. 100,-</p>
        </a>

    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const ctx = document.getElementById("myChart").getContext("2d");

        new Chart(ctx, {
            type: "line",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "Mei"],
                datasets: [{
                    label: "Pelanggan",
                    data: [5, 9, 7, 12, 10],
                    borderWidth: 2,
                    borderColor: "blue"
                }]
            }
        });
    });
</script>
@endpush
