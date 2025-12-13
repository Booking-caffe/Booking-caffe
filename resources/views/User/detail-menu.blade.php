@extends('layouts.app')

@section('title', 'Detail-Menu')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/detail-menu.css') }}">
@endpush

@section('content')

    <h1 class="title">Detail Menu</h1>
    @foreach ($chosedMenu as $menu)
        <div class="menu-detail" style="margin:40px auto; gap: 2rem; ">
            <div class="img-menu">
                <img src="{{ asset('storage/' . $menu->gambar) }}">
            </div>

            <div class="desk-menu">
                <h2 style="font-size: 1.5rem; font-weight: 600;">{{ $menu->nama_menu }}</h2>
                <p style="margin:5px 0;">{{ $menu->deskripsi }}</p>
                <p style="font-size: 1rem;">Harga: <strong>Rp {{ number_format($menu->harga) }}</strong></p>

                <div class="qty-menu" style="display: flex;">

                    <form action="{{ route('add-to-cart') }}" method="POST">
                        @csrf

                        <input type="hidden" name="id" value="{{ $menu->id_menu }}">
                        <input type="hidden" name="nama" value="{{ $menu->nama_menu }}">
                        <input type="hidden" name="harga" value="{{ $menu->harga }}">
                        {{-- <input type="hidden" name="gambar" value="{{ asset($menu->gambar) }}"> --}}

                        <input type="hidden" name="gambar" value="{{ $menu->gambar }}">

                        {{-- <label>Jumlah:</label>
                        <input type="number" name="qty" value="1" min="1" style="width: 50px; padding: 5px;" required> --}}

                        <button type="submit" class="btn">+ Keranjang</button>
                    </form>

                    <button class="btn">
                        <a href="#">Reservasi</a>
                    </button>
                </div>

            </div>
        </div>
    @endforeach
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
