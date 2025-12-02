@extends('layouts.app')

@section('title', 'Minuman')

@push('styles')
    <link rel="stylesheet" href="{{ asset ('css/menu.css') }}">
@endpush

@section('content')

<h1 style="text-align:center; margin-bottom:30px; font-size: 2rem;">Menu Minuman</h1>

    <div class="menu-container">
        @foreach ($menus as $id => $menu)
            <a href="{{ route('detail-menu', $id) }}" class="menu-card">
                <img src="{{ asset($menu['gambar']) }}" alt="{{ $menu['nama'] }}">
                <h3>{{ $menu['nama'] }}</h3>
                <p>{{ $menu['harga'] }}</p>
            </a>
        @endforeach
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
