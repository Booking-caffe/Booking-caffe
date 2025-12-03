@extends('layouts.app')

@section('title', 'Tempat-duduk')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/tempat-duduk.css') }}">
@endpush

@push('tailwind')
    <script src="https://cdn.tailwindcss.com"></script>
@endpush

@section('content')
<h1 class="text-center text-3xl font-semibold mt-9">Detail Tempat Duduk</h1>
<section class="main">
    <main class="flex-1 container mx-auto p-4" >
        <div class="grid md:grid-cols-3 gap-6 items-start">


            <!-- Image Section -->
            <div class="flex flex-col items-center relative">

                <p class="font-semibold mb-2">Indoor</p>

                <div class="relative">
                    <!-- Kotak gambar -->
                    <div class="border-2 border-gray-400 w-64 h-64 flex items-center justify-center text-gray-500">
                        Gambar
                    </div>

                    <!-- Tombol panah kiri -->
                    <button class="absolute left-[-30px] top-1/2 -translate-y-1/2 text-2xl">
                        «
                    </button>

                    <!-- Tombol panah kanan -->
                    <button class="absolute right-[-30px] top-1/2 -translate-y-1/2 text-2xl">
                        »
                    </button>
                </div>

            </div>



            <!-- Table Selection -->
            <div class="md:col-span-2">
                <h2 class="title text-center font-semibold mb-6">Pilih Tempat Meja</h2>
                <div class="grid grid-cols-4 gap-4">
                    <!-- Meja Buttons -->
                    <button class=" meja-btn border border-black p-4 rounded-lg hover:bg-blue-500 hover:text-white transition">M1</button>
                    <button class="meja-btn border border-black p-4 rounded-lg hover:bg-blue-500 hover:text-white transition">M2</button>
                    <button class="meja-btn border border-black p-4 rounded-lg hover:bg-blue-500 hover:text-white transition">M3</button>
                    <button class="meja-btn border border-black p-4 rounded-lg hover:bg-blue-500 hover:text-white transition">M4</button>
                    <button class="meja-btn border border-black p-4 rounded-lg hover:bg-blue-500 hover:text-white transition">M5</button>
                    <button class="meja-btn border border-black p-4 rounded-lg hover:bg-blue-500 hover:text-white transition">M6</button>
                    <button class="meja-btn border border-black p-4 rounded-lg hover:bg-blue-500 hover:text-white transition">M7</button>
                    <button class="meja-btn border border-black p-4 rounded-lg hover:bg-blue-500 hover:text-white transition">M8</button>
                </div>


                <!-- Next Button -->
                <div class="flex justify-end mt-9">
                    <button class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700"><a href="{{ route ('detail-pesanan')  }}">Selanjutnya</a></button>
                </div>
            </div>
        </div>
    </main>
</section>

<section class="main" style="margin: 20px;">
    <main class="flex-1 container mx-auto p-4">

        <div class="grid md:grid-cols-3 gap-6 items-start">

            <!-- Table Selection (Kiri) -->
            <div class="md:col-span-2">
               
                <h2 class="title text-center font-semibold mb-6">Pilih Tempat Meja</h2>

                <div class="grid grid-cols-4 gap-4">
                    <button class="meja-btn border border-black p-4 rounded-lg hover:bg-blue-500 hover:text-white transition">M1</button>
                    <button class="meja-btn border border-black p-4 rounded-lg hover:bg-blue-500 hover:text-white transition">M2</button>
                    <button class="meja-btn border border-black p-4 rounded-lg hover:bg-blue-500 hover:text-white transition">M3</button>
                    <button class="meja-btn border border-black p-4 rounded-lg hover:bg-blue-500 hover:text-white transition">M4</button>
                    <button class="meja-btn border border-black p-4 rounded-lg hover:bg-blue-500 hover:text-white transition">M5</button>
                    <button class="meja-btn border border-black p-4 rounded-lg hover:bg-blue-500 hover:text-white transition">M6</button>
                    <button class="meja-btn border border-black p-4 rounded-lg hover:bg-blue-500 hover:text-white transition">M7</button>
                    <button class="meja-btn border border-black p-4 rounded-lg hover:bg-blue-500 hover:text-white transition">M8</button>
                </div>

                <!-- Next Button -->
                <div class="mt-9">
                    <button class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700"><a href="{{ route ('detail-pesanan') }}">Selanjutnya</a></button>
                </div>
            </div>

            <!-- Image Section (Kanan) -->
            <div class="flex flex-col items-center relative">

                <p class="font-semibold mb-2">Outdoor</p>

                <div class="relative">

                    <!-- Kotak Gambar -->
                    <div class="border-2 border-gray-400 w-64 h-64 flex items-center justify-center text-gray-500">
                        Gambar
                    </div>

                    <!-- Panah kiri -->
                    <button class="absolute left-[-35px] top-1/2 -translate-y-1/2 text-2xl">
                        «
                    </button>

                    <!-- Panah kanan -->
                    <button class="absolute right-[-35px] top-1/2 -translate-y-1/2 text-2xl">
                        »
                    </button>

                </div>

            </div>

        </div>

    </main>
</section>
@endsection

@push('extra-scripts')
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const mejaButtons = document.querySelectorAll(".meja-btn");

        mejaButtons.forEach(btn => {
            btn.addEventListener("click", function () {

                // Jika sudah aktif → matikan
                if (btn.classList.contains("selected")) {
                    btn.classList.remove("selected");
                } else {
                    // Matikan semua meja lain (jika ingin hanya memilih 1 meja)
                    // mejaButtons.forEach(b => b.classList.remove("selected"));

                    // Aktifkan tombol ini
                    btn.classList.add("selected");
                }
            });
        });
    });
</script>
@endpush