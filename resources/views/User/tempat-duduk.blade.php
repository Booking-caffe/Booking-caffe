

@extends('layouts.app')

@section('title', 'Tempat-duduk')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/tempat-duduk.css') }}">
@endpush


@section('content')
<main class="py-10">
<h1 class="text-3xl md:text-4xl font-bold text-center mb-2 text-gray-900 dark:text-white">Detail Tempat Duduk</h1>
<p class="text-center text-gray-600 dark:text-gray-400 mb-12">Pilih meja yang tersedia untuk melanjutkan reservasi Anda.</p>
<section class="mb-16">
<div class="bg-white dark:bg-gray-800/50 p-6 md:p-8 rounded-lg shadow-md border border-gray-200 dark:border-gray-700">
<div class="flex flex-col md:flex-row gap-8">
<div class="md:w-1/2">
<h2 class="text-2xl font-semibold mb-2 text-gray-900 dark:text-white">Indoor</h2>
<p class="text-lg font-medium mb-4 text-gray-700 dark:text-gray-300">Pilih Meja dari Denah</p>
<div class="table-plan aspect-square w-full rounded-lg border border-gray-300 dark:border-gray-600 p-4">
<div class="relative w-full h-full">
<div class="absolute top-0 left-0 w-24 h-10 bg-gray-300 dark:bg-gray-600 rounded flex items-center justify-center text-sm font-medium">Masuk</div>
<div class="absolute">
<input class="absolute opacity-0 w-0 h-0 peer" id="table_m1" name="table_indoor" type="radio"/>
<label class="available-table cursor-pointer absolute top-[10%] left-[20%] w-16 h-16 flex items-center justify-center border-2 font-semibold rounded-full transition-all duration-200 hover:shadow-lg hover:-translate-y-1" for="table_m1">M1</label>
</div>
<div class="absolute">
<input class="absolute opacity-0 w-0 h-0 peer" id="table_m2" name="table_indoor" type="radio"/>
<label class="available-table cursor-pointer absolute top-[10%] left-[50%] w-16 h-16 flex items-center justify-center border-2 font-semibold rounded-full transition-all duration-200 hover:shadow-lg hover:-translate-y-1" for="table_m2">M2</label>
</div>
<div class="absolute">
<input class="absolute opacity-0 w-0 h-0 peer" disabled="" id="table_m3" name="table_indoor" type="radio"/>
<label class="cursor-not-allowed absolute top-[35%] left-[10%] w-12 h-24 flex items-center justify-center bg-white dark:bg-gray-700 border border-gray-400 dark:border-gray-500 rounded-lg transition-all duration-200" for="table_m3">M3</label>
</div>
<div class="absolute">
<input class="absolute opacity-0 w-0 h-0 peer" id="table_m4" name="table_indoor" type="radio"/>
<label class="available-table cursor-pointer absolute top-[35%] left-[80%] w-12 h-12 flex items-center justify-center border-2 font-semibold rounded-lg transition-all duration-200 hover:shadow-lg hover:-translate-y-1" for="table_m4">M4</label>
</div>
<div class="absolute">
<input class="absolute opacity-0 w-0 h-0 peer" disabled="" id="table_m5" name="table_indoor" type="radio"/>
<label class="cursor-not-allowed absolute top-[60%] left-[60%] w-24 h-12 flex items-center justify-center bg-white dark:bg-gray-700 border border-gray-400 dark:border-gray-500 rounded-lg transition-all duration-200" for="table_m5">M5</label>
</div>
<div class="absolute">
<input class="absolute opacity-0 w-0 h-0 peer" id="table_m6" name="table_indoor" type="radio"/>
<label class="available-table cursor-pointer absolute top-[80%] left-[15%] w-12 h-12 flex items-center justify-center border-2 font-semibold rounded-full transition-all duration-200 hover:shadow-lg hover:-translate-y-1" for="table_m6">M6</label>
</div>
<div class="absolute">
<input class="absolute opacity-0 w-0 h-0 peer" id="table_m7" name="table_indoor" type="radio"/>
<label class="available-table cursor-pointer absolute top-[80%] left-[40%] w-12 h-12 flex items-center justify-center border-2 font-semibold rounded-full transition-all duration-200 hover:shadow-lg hover:-translate-y-1" for="table_m7">M7</label>
</div>
<div class="absolute">
<input class="absolute opacity-0 w-0 h-0 peer" id="table_m8" name="table_indoor" type="radio"/>
<label class="available-table cursor-pointer absolute top-[80%] left-[65%] w-12 h-12 flex items-center justify-center border-2 font-semibold rounded-full transition-all duration-200 hover:shadow-lg hover:-translate-y-1" for="table_m8">M8</label>
</div>
<div class="absolute bottom-0 right-0 w-24 h-24 bg-gray-400/50 dark:bg-gray-600/50 rounded flex items-center justify-center text-sm font-medium">Bar</div>
</div>
</div>
</div>
<div class="flex-grow md:w-1/2 flex flex-col justify-between">
<div>
<h3 class="text-xl font-semibold mb-4 text-gray-800 dark:text-gray-100">Meja Terpilih:</h3>
<p class="text-gray-600 dark:text-gray-400 mb-6">Pilih meja dari denah di sebelah kiri untuk melanjutkan.</p>
<div class="p-4 bg-gray-100 dark:bg-gray-900/50 rounded-lg">
<div class="font-semibold text-lg" id="selected-table-indoor">--</div>
</div>
</div>
<div class="flex justify-end mt-6">
<button class="bg-primary text-white font-semibold py-3 px-8 rounded-lg shadow-md hover:bg-yellow-700 transition-all duration-300 transform hover:-translate-y-0.5 w-full md:w-auto">Selanjutnya</button>
</div>
</div>
</div>
</div>
</section>
<section class="mb-16">
<div class="bg-white dark:bg-gray-800/50 p-6 md:p-8 rounded-lg shadow-md border border-gray-200 dark:border-gray-700">
<div class="flex flex-col md:flex-row-reverse gap-8">
<div class="md:w-1/2">
<h2 class="text-2xl font-semibold mb-2 text-gray-900 dark:text-white">Outdoor</h2>
<p class="text-lg font-medium mb-4 text-gray-700 dark:text-gray-300">Pilih Meja dari Denah</p>
<div class="table-plan aspect-square w-full rounded-lg border border-gray-300 dark:border-gray-600 p-4">
<div class="relative w-full h-full">
<div class="absolute top-0 right-0 w-24 h-10 bg-gray-300 dark:bg-gray-600 rounded flex items-center justify-center text-sm font-medium">Dari Dalam</div>
<div class="absolute">
<input class="absolute opacity-0 w-0 h-0 peer" id="table_o1" name="table_outdoor" type="radio"/>
<label class="available-table cursor-pointer absolute top-[15%] left-[10%] w-20 h-10 flex items-center justify-center border-2 font-semibold rounded-lg transition-all duration-200 hover:shadow-lg hover:-translate-y-1" for="table_o1">M1</label>
</div>
<div class="absolute">
<input class="absolute opacity-0 w-0 h-0 peer" disabled="" id="table_o2" name="table_outdoor" type="radio"/>
<label class="cursor-not-allowed absolute top-[15%] left-[40%] w-20 h-10 flex items-center justify-center bg-white dark:bg-gray-700 border border-gray-400 dark:border-gray-500 rounded-lg transition-all duration-200" for="table_o2">M2</label>
</div>
<div class="absolute">
<input class="absolute opacity-0 w-0 h-0 peer" id="table_o3" name="table_outdoor" type="radio"/>
<label class="available-table cursor-pointer absolute top-[15%] left-[70%] w-20 h-10 flex items-center justify-center border-2 font-semibold rounded-lg transition-all duration-200 hover:shadow-lg hover:-translate-y-1" for="table_o3">M3</label>
</div>
<div class="absolute">
<input class="absolute opacity-0 w-0 h-0 peer" id="table_o4" name="table_outdoor" type="radio"/>
<label class="available-table cursor-pointer absolute top-[45%] left-[25%] w-14 h-14 flex items-center justify-center border-2 font-semibold rounded-full transition-all duration-200 hover:shadow-lg hover:-translate-y-1" for="table_o4">M4</label>
</div>
<div class="absolute">
<input class="absolute opacity-0 w-0 h-0 peer" disabled="" id="table_o5" name="table_outdoor" type="radio"/>
<label class="cursor-not-allowed absolute top-[45%] left-[60%] w-14 h-14 flex items-center justify-center bg-white dark:bg-gray-700 border border-gray-400 dark:border-gray-500 rounded-full transition-all duration-200" for="table_o5">M5</label>
</div>
<div class="absolute">
<input class="absolute opacity-0 w-0 h-0 peer" id="table_o6" name="table_outdoor" type="radio"/>
<label class="available-table cursor-pointer absolute top-[75%] left-[10%] w-20 h-10 flex items-center justify-center border-2 font-semibold rounded-lg transition-all duration-200 hover:shadow-lg hover:-translate-y-1" for="table_o6">M6</label>
</div>
<div class="absolute">
<input class="absolute opacity-0 w-0 h-0 peer" disabled="" id="table_o7" name="table_outdoor" type="radio"/>
<label class="cursor-not-allowed absolute top-[75%] left-[40%] w-20 h-10 flex items-center justify-center bg-white dark:bg-gray-700 border border-gray-400 dark:border-gray-500 rounded-lg transition-all duration-200" for="table_o7">M7</label>
</div>
<div class="absolute">
<input class="absolute opacity-0 w-0 h-0 peer" id="table_o8" name="table_outdoor" type="radio"/>
<label class="available-table cursor-pointer absolute top-[75%] left-[70%] w-20 h-10 flex items-center justify-center border-2 font-semibold rounded-lg transition-all duration-200 hover:shadow-lg hover:-translate-y-1" for="table_o8">M8</label>
</div>
</div>
</div>
</div>
<div class="flex-grow md:w-1/2 flex flex-col justify-between">
<div>
<h3 class="text-xl font-semibold mb-4 text-gray-800 dark:text-gray-100">Meja Terpilih:</h3>
<p class="text-gray-600 dark:text-gray-400 mb-6">Pilih meja dari denah di sebelah kanan untuk melanjutkan.</p>
<div class="p-4 bg-gray-100 dark:bg-gray-900/50 rounded-lg">
<div class="font-semibold text-lg" id="selected-table-outdoor">--</div>
</div>
</div>
<div class="flex justify-end mt-6">
<button class="bg-primary text-white font-semibold py-3 px-8 rounded-lg shadow-md hover:bg-yellow-700 transition-all duration-300 transform hover:-translate-y-0.5 w-full md:w-auto">Selanjutnya</button>
</div>
</div>
</div>
</div>
</section>
</main>
@endsection


