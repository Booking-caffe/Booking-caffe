@extends('layouts.app')

@section('title', 'Makanan')

@section('content')
<div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8 py-6 sm:py-10">

    <!-- Judul -->
    <h1 class="text-center text-xl sm:text-2xl md:text-3xl font-bold mb-5 sm:mb-8">
        Menu Minuman
    </h1>

    <!-- Grid Menu -->
    <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-5">
        @foreach ($menuMinuman as $menu)
            <a href="{{ route('detail-minuman', $menu->id_menu) }}"
               class="bg-white rounded-lg shadow-sm hover:shadow-md transition overflow-hidden group">

                <!-- Gambar -->
                <div class="aspect-square overflow-hidden">
                    <img
                        src="{{ asset('storage/' . $menu->gambar) }}"
                        alt="{{ $menu->nama_menu }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition"
                    >
                </div>

                <!-- Konten -->
                <div class="p-2 sm:p-4 text-center">
                    <h3 class="font-medium text-sm sm:text-base line-clamp-2">
                        {{ $menu->nama_menu }}
                    </h3>
                    <p class="text-green-600 font-semibold text-sm sm:text-base mt-1">
                        Rp {{ number_format($menu->harga, 0, ',', '.') }}
                    </p>
                </div>
            </a>
        @endforeach
    </div>

</div>
@endsection
