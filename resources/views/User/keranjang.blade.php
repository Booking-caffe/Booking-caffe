@extends('layouts.app')

@section('title', 'Keranjang')

@section('content')
<div class="container mx-auto px-4 py-10">

    <!-- TITLE -->
    <h1 class="text-center text-2xl md:text-3xl font-bold mb-10">
        Keranjang
    </h1>

    @if(count($keranjang) == 0)
        <div class="text-center text-gray-500">
            Keranjang kosong.
        </div>
    @else

        <!-- GRID ITEM -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            @foreach($keranjang as $index => $item)
            <div class="bg-white dark:bg-card-dark rounded-xl shadow-md p-4 flex gap-4">

                <!-- IMAGE -->
                <img src="{{ asset('storage/' . $item['gambar']) }}"
                     alt="{{ $item['nama'] }}"
                     class="w-24 h-24 rounded-lg object-cover flex-shrink-0">

                <!-- INFO -->
                <div class="flex-1 flex flex-col justify-between">

                    <div>
                        <h3 class="font-semibold text-lg">
                            {{ $item['nama'] }}
                        </h3>
                        <p class="text-sm text-gray-500">
                            Rp {{ number_format($item['harga']) }}
                        </p>
                    </div>

                    <!-- ACTION -->
                    <div class="flex items-center justify-between mt-4">

                        <!-- QTY -->
                        <input type="number"
                               min="1"
                               value="{{ $item['qty'] }}"
                               data-index="{{ $index }}"
                               class="qty-input w-16 rounded-md border-gray-300 text-center text-sm">

                        <!-- DELETE -->
                        <form action="{{ route('remove-item', $index) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="text-red-500 hover:text-red-700 text-xl">
                                🗑
                            </button>
                        </form>

                        <!-- CHECKBOX -->
                        <input type="checkbox"
                               class="item-check w-4 h-4 accent-primary">
                    </div>
                </div>
            </div>
            @endforeach

        </div>

        <!-- BOTTOM BAR -->
        <div class="mt-10 flex flex-col md:flex-row items-center justify-between gap-4
                    bg-white dark:bg-card-dark rounded-xl shadow-md p-5">

            <label class="flex items-center gap-2 text-sm font-medium">
                <input type="checkbox" class="accent-primary">
                Pilih Semua
            </label>

            <a href="{{ route('reservasi') }}"
               class="inline-block bg-primary text-white px-6 py-3 rounded-lg
                      hover:bg-primary/90 transition">
                Reservasi
            </a>
        </div>

    @endif

</div>
@endsection
