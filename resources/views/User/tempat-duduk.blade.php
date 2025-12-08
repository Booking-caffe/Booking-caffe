@extends('layouts.app')

@section('title', 'Tempat-duduk')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/tempat-duduk.css') }}">
@endpush

@push('styles-cdn')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
@endpush

@push('header-css')
    <style>
        .material-icons {
            font-size: inherit;
            vertical-align: middle;
        }

        body {
            --tw-bg-opacity: 1;
            background-color: rgb(245 243 240 / var(--tw-bg-opacity));
        }

        .dark body {
            --tw-bg-opacity: 1;
            background-color: rgb(44 37 34 / var(--tw-bg-opacity));
        }
    </style>
@endpush

@section('content')
    <main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-4xl font-bold text-center text-primary-dark dark:text-secondary mb-12">
            Detail Tempat Duduk
        </h1>

        <h2>Pilih Meja ({{ count($mejaDipilih ?? []) }} / {{ $jumlahMeja }})</h2>
        {{-- @php
            // dd($jumlahMeja, $mejaDipilih);
        @endphp --}}
        <p>Pilih meja sesuai jumlah yang Anda pesan.</p>

        <form action="{{ route('pilihTempatDuduk') }}" method="POST">
            @csrf
            <section
                class="bg-surface-light dark:bg-surface-dark rounded-lg shadow-soft-lg p-6 md:p-8 mb-12 transform hover:-translate-y-1 transition-transform duration-300">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                    <div class="flex items-center space-x-4">
                        <button type="button"
                            class="p-2 rounded-full bg-secondary/50 dark:bg-primary-dark hover:bg-primary hover:text-white transition-all duration-300">
                            <span class="material-icons text-3xl">chevron_left</span>
                        </button>
                        <div
                            class="aspect-square flex-grow bg-secondary/30 dark:bg-primary-dark rounded-lg overflow-hidden">
                            <img alt="Stylish indoor seating area of the cafe" class="w-full h-full object-cover"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuB9QDT7m2z8J4jkC8UrlZMThXGON7esBsHMt8N0PdI-4AovNfzbo46pY9U966c-lj9RDYx9ucHQrzk5N8XmC9s2OFIpxiNXbb8mfFnW3aDvA4dyJoVthIItzrC3Aa7MNWy9PKovMtmFF77_C0WBT17v3gZoV5l5GnNE_enXW2_VGFYyMlgR3xLAUjz_Y1c-gGBKxQ9b537KOLZb6AgcPqzJ1yl5Gj732_byo-5Fq5vJRe3SbMj3BQCOWt7S92FnYK1dicnXvqBgAY_7" />
                        </div>
                        <button type="button"
                            class="p-2 rounded-full bg-secondary/50 dark:bg-primary-dark hover:bg-primary hover:text-white transition-all duration-300">
                            <span class="material-icons text-3xl">chevron_right</span>
                        </button>
                    </div>


                    <div class="flex flex-col h-full">
                        <h2 class="text-2xl font-semibold mb-2 text-primary-dark dark:text-secondary">Indoor</h2>
                        <p class="font-medium mb-4 text-gray-600 dark:text-gray-300">Pilih Tempat Meja</p>
                        <div>
                            <!-- HIDDEN INPUT untuk menyimpan meja yang dipilih -->
                            <input type="hidden" name="meja" id="meja-terpilih">

                            <div class="grid grid-cols-4 gap-4 mb-6">
                                <button type="button"
                                    class="meja-btn aspect-square flex items-center justify-center border-2 border-secondary dark:border-primary-light rounded-lg text-sm font-semibold text-primary-dark dark:text-secondary hover:border-accent hover:bg-accent/10 dark:hover:border-accent transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2 dark:focus:ring-offset-surface-dark"
                                    data-value="indoor-M1">M1</button>

                                <button type="button"
                                    class="meja-btn aspect-square flex items-center justify-center border-2 border-secondary dark:border-primary-light rounded-lg text-sm font-semibold text-primary-dark dark:text-secondary hover:border-accent hover:bg-accent/10 dark:hover:border-accent transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2 dark:focus:ring-offset-surface-dark"
                                    data-value="indoor-M2">M2</button>

                                <button type="button"
                                    class="meja-btn aspect-square flex items-center justify-center border-2 border-secondary dark:border-primary-light rounded-lg text-sm font-semibold text-primary-dark dark:text-secondary hover:border-accent hover:bg-accent/10 dark:hover:border-accent transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2 dark:focus:ring-offset-surface-dark"
                                    data-value="indoor-M3">M3</button>

                                <button type="button"
                                    class="meja-btn aspect-square flex items-center justify-center border-2 border-secondary dark:border-primary-light rounded-lg text-sm font-semibold text-primary-dark dark:text-secondary hover:border-accent hover:bg-accent/10 dark:hover:border-accent transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2 dark:focus:ring-offset-surface-dark"
                                    data-value="indoor-M4">M4</button>
                                <button type="button"
                                    class="meja-btn aspect-square flex items-center justify-center border-2 border-secondary dark:border-primary-light rounded-lg text-sm font-semibold text-primary-dark dark:text-secondary hover:border-accent hover:bg-accent/10 dark:hover:border-accent transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2 dark:focus:ring-offset-surface-dark"
                                    data-value="indoor-M5">M5</button>
                                <button type="button"
                                    class="meja-btn aspect-square flex items-center justify-center border-2 border-secondary dark:border-primary-light rounded-lg text-sm font-semibold text-primary-dark dark:text-secondary hover:border-accent hover:bg-accent/10 dark:hover:border-accent transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2 dark:focus:ring-offset-surface-dark"
                                    data-value="indoor-M6">M6</button>
                                <button type="button"
                                    class="meja-btn aspect-square flex items-center justify-center border-2 border-secondary dark:border-primary-light rounded-lg text-sm font-semibold text-primary-dark dark:text-secondary hover:border-accent hover:bg-accent/10 dark:hover:border-accent transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2 dark:focus:ring-offset-surface-dark"
                                    data-value="indoor-M7">M7</button>
                                <button type="button"
                                    class="meja-btn aspect-square flex items-center justify-center border-2 border-secondary dark:border-primary-light rounded-lg text-sm font-semibold text-primary-dark dark:text-secondary hover:border-accent hover:bg-accent/10 dark:hover:border-accent transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2 dark:focus:ring-offset-surface-dark"
                                    data-value="indoor-M8">M8</button>
                            </div>

                            <div class="flex justify-end">
                                <button type="submit"
                                    class="bg-primary text-white font-semibold py-2 px-6 rounded-lg hover:bg-primary-dark transition-colors shadow-soft-md hover:shadow-soft-lg transform hover:-translate-y-0.5">
                                    Selanjutnya
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section
                class="bg-surface-light dark:bg-surface-dark rounded-lg shadow-soft-lg p-6 md:p-8 transform hover:-translate-y-1 transition-transform duration-300">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                    <div class="flex flex-col h-full lg:order-first">
                        <h2 class="text-2xl font-semibold mb-2 text-primary-dark dark:text-secondary">Outdoor</h2>
                        <p class="font-medium mb-4 text-gray-600 dark:text-gray-300">Pilih Tempat Meja</p>
                        <div>
                            <!-- HIDDEN INPUT untuk menyimpan meja yang dipilih -->
                            <div class="grid grid-cols-4 gap-4 mb-6">
                                <button type="button"
                                    class="meja-btn aspect-square flex items-center justify-center border-2 border-secondary dark:border-primary-light rounded-lg text-sm font-semibold text-primary-dark dark:text-secondary hover:border-accent hover:bg-accent/10 dark:hover:border-accent transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2 dark:focus:ring-offset-surface-dark"
                                    data-value="out-M1">M1</button>

                                <button type="button"
                                    class="meja-btn aspect-square flex items-center justify-center border-2 border-secondary dark:border-primary-light rounded-lg text-sm font-semibold text-primary-dark dark:text-secondary hover:border-accent hover:bg-accent/10 dark:hover:border-accent transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2 dark:focus:ring-offset-surface-dark"
                                    data-value="out-M2">M2</button>

                                <button type="button"
                                    class="meja-btn aspect-square flex items-center justify-center border-2 border-secondary dark:border-primary-light rounded-lg text-sm font-semibold text-primary-dark dark:text-secondary hover:border-accent hover:bg-accent/10 dark:hover:border-accent transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2 dark:focus:ring-offset-surface-dark"
                                    data-value="out-M3">M3</button>

                                <button type="button"
                                    class="meja-btn aspect-square flex items-center justify-center border-2 border-secondary dark:border-primary-light rounded-lg text-sm font-semibold text-primary-dark dark:text-secondary hover:border-accent hover:bg-accent/10 dark:hover:border-accent transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2 dark:focus:ring-offset-surface-dark"
                                    data-value="out-M4">M4</button>
                                <button type="button"
                                    class="meja-btn aspect-square flex items-center justify-center border-2 border-secondary dark:border-primary-light rounded-lg text-sm font-semibold text-primary-dark dark:text-secondary hover:border-accent hover:bg-accent/10 dark:hover:border-accent transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2 dark:focus:ring-offset-surface-dark"
                                    data-value="out-M5">M5</button>
                                <button type="button"
                                    class="meja-btn aspect-square flex items-center justify-center border-2 border-secondary dark:border-primary-light rounded-lg text-sm font-semibold text-primary-dark dark:text-secondary hover:border-accent hover:bg-accent/10 dark:hover:border-accent transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2 dark:focus:ring-offset-surface-dark"
                                    data-value="out-M6">M6</button>
                                <button type="button"
                                    class="meja-btn aspect-square flex items-center justify-center border-2 border-secondary dark:border-primary-light rounded-lg text-sm font-semibold text-primary-dark dark:text-secondary hover:border-accent hover:bg-accent/10 dark:hover:border-accent transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2 dark:focus:ring-offset-surface-dark"
                                    data-value="out-M7">M7</button>
                                <button type="button"
                                    class="meja-btn aspect-square flex items-center justify-center border-2 border-secondary dark:border-primary-light rounded-lg text-sm font-semibold text-primary-dark dark:text-secondary hover:border-accent hover:bg-accent/10 dark:hover:border-accent transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2 dark:focus:ring-offset-surface-dark"
                                    data-value="out-M8">M8</button>
                            </div>
                            <div class="mt-auto flex justify-start">
                                <button type="submit"
                                    class="bg-primary text-white font-semibold py-2 px-6 rounded-lg hover:bg-primary-dark transition-colors shadow-soft-md hover:shadow-soft-lg transform hover:-translate-y-0.5">
                                    Selanjutnya
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4 lg:order-last">
                        <button
                            class="p-2 rounded-full bg-secondary/50 dark:bg-primary-dark hover:bg-primary hover:text-white transition-all duration-300">
                            <span class="material-icons text-3xl">chevron_left</span>
                        </button>
                        <div
                            class="aspect-square flex-grow bg-secondary/30 dark:bg-primary-dark rounded-lg overflow-hidden">
                            <img alt="Sunny outdoor patio seating area of the cafe" class="w-full h-full object-cover"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuAEBiEIwC2UdUX2yOdZsQ5Tk2_JU89F8k2tKi2prnGGkNOK73Y1diSTZI6tvJOCfKJXJ6Gs8PzaIYCCWVVGhIa5a1WlwBpjZuliC51VMTWHbpBEsdYA0sHB_wa5oXtUN2FPP6NLUrJYikv1xhwwiSi1oZ7oOm4d0JKuWzXWpFyICxiSaSUZVKyD7mfPnvPB-m35-F_dY1_7GmOQaGaNZb_oNDn1PWTSbObJae8Rx4ZnkXXGCFs-3PKr7pDDaAa4MTiiGlGr8V3ELAwA" />
                        </div>
                        <button
                            class="p-2 rounded-full bg-secondary/50 dark:bg-primary-dark hover:bg-primary hover:text-white transition-all duration-300">
                            <span class="material-icons text-3xl">chevron_right</span>
                        </button>
                    </div>
                </div>
            </section>
        </form>

    </main>

@endsection

@push('extra-scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const mejaButtons = document.querySelectorAll(".meja-btn");
            const inputMeja = document.getElementById("meja-terpilih");
            const btnSubmit = document.getElementById("btn-submit");

            mejaButtons.forEach(btn => {
                btn.addEventListener("click", function() {

                    /// hapus selected di semua
                    mejaButtons.forEach(b => b.classList.remove("selected"));

                    // set selected ke tombol yang diklik
                    btn.classList.add("selected");

                    console.log(inputMeja);

                    // Isi hidden input
                    inputMeja.value = btn.getAttribute("data-value");

                    // Aktifkan tombol submit
                    btnSubmit.disabled = false;
                });
            });
        });
    </script>
@endpush
