@extends('layouts.app')

@section('title', 'Tempat-duduk')

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

    @if (session('gagal'))
        <div class="mb-4 flex items-center bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-md animate-bounce"
            role="alert">
            <span class="material-icons mr-2">error_outline</span>
            <p class="font-medium">{{ session('gagal') }}</p>
        </div>
    @endif
    <main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="content-main" style="padding: 30px; background: rgb(255, 252, 252); padding-bottom: 50px;">
            <h1 class="text-4xl font-bold text-center text-primary-dark dark:text-secondary mb-12"
                style="padding-top: 20px;">
                Detail Tempat Duduk
            </h1>
            <div class="meja rounded-lg mb-5" style="border: 1px solid rgb(204, 204, 204);">
                <div class="head-title"
                    style="background-color: rgb(245 243 240 / var(--tw-bg-opacity)); text-align: center; padding: 10px 0;">
                    <h1 class="font-semibold text-primary-dark dark:text-secondary">Silahkan pilih meja yang ingin
                        direservasi</h1>
                </div>
                <div class="title-meja" style="display: flex; justify-content: space-between; padding: 10px 25px;">
                    <p class="font-medium  text-gray-600 font-semibold dark:text-gray-300">Meja yang dipesan :
                        {{ $jumlahMeja }}</p>
                    <p class="font-medium  font-semibold text-gray-600 dark:text-gray-300">Meja terpilih :
                        {{ count($mejaDipilih ?? []) }} / {{ $jumlahMeja }}</p>
                </div>
            </div>

            <form action="{{ route('pilihTempatDuduk') }}" method="POST">
                @csrf
                <section
                    class="bg-surface-light dark:bg-surface-dark rounded-lg shadow-soft-lg p-6 md:p-8 mb-12 transform hover:-translate-y-1 transition-transform duration-300"
                    style="border: 1px solid rgb(204, 204, 204);">
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
                                {{-- <input type="hidden" name="meja" id="meja-terpilih"> --}}
                                <input type="hidden" name="ruangan" id="ruangan">
                                <input type="hidden" name="kode_meja" id="kode_meja">

                                <div class="grid grid-cols-4 gap-4 mb-6">
                                    @foreach ($mejaIndoor as $meja)
                                        @if ($meja->status === 'KOSONG')
                                            <div>
                                                <input type="checkbox" name="id_meja[]" value="{{ $meja->kode_meja }}"
                                                    id="meja_{{ $meja->kode_meja }}" class="hidden peer">

                                                <label for="meja_{{ $meja->kode_meja }}"
                                                    class="aspect-square flex items-center justify-center border-2 border-secondary dark:border-primary-light rounded-lg text-sm font-semibold text-primary-dark dark:text-secondary cursor-pointer transition-all duration-200 
                                    peer-checked:bg-primary peer-checked:text-white peer-checked:border-primary
                                    hover:border-accent hover:bg-accent/10">
                                                    {{ $meja->kode_meja }}
                                                </label>
                                            </div>
                                        @else
                                            <div class="aspect-square flex items-center justify-center border-2 border-gray-300 dark:border-gray-600 rounded-lg text-sm font-semibold text-gray-400 dark:text-gray-500 bg-gray-100 dark:bg-gray-800 cursor-not-allowed"
                                                title="Meja sudah terbooking">
                                                {{ $meja->kode_meja }}
                                            </div>
                                        @endif
                                    @endforeach
                                </div>

                                <div class="flex justify-end">
                                    <button id="btn-submit" type="submit"
                                        class="bg-primary text-white font-semibold py-2 px-6 rounded-lg hover:bg-primary-dark transition-colors shadow-soft-md hover:shadow-soft-lg transform hover:-translate-y-0.5">
                                        Selanjutnya
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
                <section
                    class="bg-surface-light dark:bg-surface-dark rounded-lg shadow-soft-lg p-6 md:p-8 transform hover:-translate-y-1 transition-transform duration-300"
                    style="border: 1px solid rgb(204, 204, 204);">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                        <div class="flex flex-col h-full lg:order-first">
                            <h2 class="text-2xl font-semibold mb-2 text-primary-dark dark:text-secondary">Outdoor</h2>
                            <p class="font-medium mb-4 text-gray-600 dark:text-gray-300">Pilih Tempat Meja (Bisa pilih
                                banyak)</p>

                            <div>
                                <div class="grid grid-cols-4 gap-4 mb-6">
                                    @foreach ($mejaOutdoor as $meja)
                                        @if ($meja->status === 'KOSONG')
                                            <div>
                                                <input type="checkbox" name="id_meja[]" value="{{ $meja->kode_meja }}"
                                                    id="meja_{{ $meja->kode_meja }}" class="hidden peer">

                                                <label for="meja_{{ $meja->kode_meja }}"
                                                    class="aspect-square flex items-center justify-center border-2 border-secondary dark:border-primary-light rounded-lg text-sm font-semibold text-primary-dark dark:text-secondary cursor-pointer transition-all duration-200 
                                    peer-checked:bg-primary peer-checked:text-white peer-checked:border-primary
                                    hover:border-accent hover:bg-accent/10">
                                                    {{ $meja->kode_meja }}
                                                </label>
                                            </div>
                                        @else
                                            <div class="aspect-square flex items-center justify-center border-2 border-gray-300 dark:border-gray-600 rounded-lg text-sm font-semibold text-gray-400 dark:text-gray-500 bg-gray-100 dark:bg-gray-800 cursor-not-allowed"
                                                title="Meja sudah terbooking">
                                                {{ $meja->kode_meja }}
                                            </div>
                                        @endif
                                    @endforeach
                                </div>

                                <div class="mt-auto flex justify-start">
                                    <button id="btn-submit" type="submit"
                                        class="bg-primary text-white font-semibold py-2 px-6 rounded-lg hover:bg-primary-dark transition-colors shadow-soft-md hover:shadow-soft-lg transform hover:-translate-y-0.5">
                                        Selanjutnya
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4 lg:order-last">
                            <button type="button"
                                class="p-2 rounded-full bg-secondary/50 dark:bg-primary-dark hover:bg-primary hover:text-white transition-all duration-300">
                                <span class="material-icons text-3xl">chevron_left</span>
                            </button>
                            <div
                                class="aspect-square flex-grow bg-secondary/30 dark:bg-primary-dark rounded-lg overflow-hidden">
                                <img alt="Sunny outdoor patio seating area of the cafe" class="w-full h-full object-cover"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuAEBiEIwC2UdUX2yOdZsQ5Tk2_JU89F8k2tKi2prnGGkNOK73Y1diSTZI6tvJOCfKJXJ6Gs8PzaIYCCWVVGhIa5a1WlwBpjZuliC51VMTWHbpBEsdYA0sHB_wa5oXtUN2FPP6NLUrJYikv1xhwwiSi1oZ7oOm4d0JKuWzXWpFyICxiSaSUZVKyD7mfPnvPB-m35-F_dY1_7GmOQaGaNZb_oNDn1PWTSbObJae8Rx4ZnkXXGCFs-3PKr7pDDaAa4MTiiGlGr8V3ELAwA" />
                            </div>
                            <button type="button"
                                class="p-2 rounded-full bg-secondary/50 dark:bg-primary-dark hover:bg-primary hover:text-white transition-all duration-300">
                                <span class="material-icons text-3xl">chevron_right</span>
                            </button>
                        </div>
                    </div>
                </section>
            </form>
        </div>


    </main>

@endsection

@push('extra-scripts')
    <script>
        // document.addEventListener("DOMContentLoaded", function() {
        //     const mejaButtons = document.querySelectorAll(".meja-btn");
        //     const inputRuangan = document.getElementById("ruangan");
        //     const inputMeja = document.getElementById("kode_meja");
        //     const btnSubmit = document.getElementById("btn-submit");

        //     mejaButtons.forEach(btn => {
        //         btn.addEventListener("click", function() {

        //             /// hapus selected di semua
        //             mejaButtons.forEach(b => b.classList.remove("selected"));

        //             // set selected ke tombol yang diklik
        //             btn.classList.add("selected");

        //             console.log(inputMeja);

        //             // Isi hidden input
        //             // inputMeja.value = btn.getAttribute("data-value");

        //             // ambil data terpisah
        //             inputRuangan.value = btn.dataset.ruangan;
        //             inputMeja.value = btn.dataset.meja;

        //             // Aktifkan tombol submit
        //             btnSubmit.disabled = false;
        //         });
        //     });
        // });

        const checkboxes = document.querySelectorAll('input[name="id_meja[]"]');
        const limit = 4; // Contoh limit

        checkboxes.forEach(cb => {
            cb.addEventListener('change', () => {
                const checkedCount = document.querySelectorAll('input[name="id_meja[]"]:checked').length;
                if (checkedCount > limit) {
                    cb.checked = false;
                    alert("Maksimal pilih " + limit + " meja.");
                }
            });
        });
    </script>
@endpush
