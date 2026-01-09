@extends('layouts.app')

@section('title', 'Detail-Menu')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/detail-menu.css') }}">
@endpush

@section('content')

<div class="max-w-6xl mx-auto px-4 py-6">
    <h1 class="text-2xl md:text-3xl font-bold mb-6 text-center md:text-center">
        Detail Menu
    </h1>

    @foreach ($chosedMenu as $menu)
        <div class="flex flex-col md:flex-row gap-6 md:gap-10 bg-white shadow-md rounded-xl p-4 md:p-6 mb-8">

            <!-- Gambar Menu -->
            <div class="w-full md:w-1/2">
                <img 
                    src="{{ asset('storage/' . $menu->gambar) }}" 
                    alt="{{ $menu->nama_menu }}"
                    class="w-full h-64 md:h-full object-cover rounded-lg"
                >
            </div>

            <!-- Deskripsi Menu -->
            <div class="w-full md:w-1/2 flex flex-col justify-between">
                <div>
                    <h2 class="text-xl md:text-2xl font-semibold mb-2">
                        {{ $menu->nama_menu }}
                    </h2>

                    <p class="text-gray-600 mb-3 leading-relaxed">
                        {{ $menu->deskripsi }}
                    </p>

                    <p class="text-base md:text-lg">
                        Harga:
                        <span class="font-bold text-green-600">
                            Rp {{ number_format($menu->harga) }}
                        </span>
                    </p>
                </div>

                <!-- Action Button -->
                <div class="mt-6 flex flex-col sm:flex-row gap-3">
                    <form action="{{ route('add-to-cart') }}" method="POST" class="w-full sm:w-auto">
                        @csrf

                        <input type="hidden" name="id" value="{{ $menu->id_menu }}">
                        <input type="hidden" name="nama" value="{{ $menu->nama_menu }}">
                        <input type="hidden" name="harga" value="{{ $menu->harga }}">
                        <input type="hidden" name="gambar" value="{{ $menu->gambar }}">

                        <button 
                            type="submit"
                            class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition duration-200"
                        >
                            + Keranjang
                        </button>
                    </form>

                    <div class="reservasi w-full sm:w-auto" style="display: flex; align-items: center;">
                        <button class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white  px-6 py-2 rounded-lg transition duration-200">
                            <a href="{{ route('reservasi') }}">
                                Reservasi
                            </a>
                        </button>
                    </div>
                </div>
            </div>

        </div>
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
