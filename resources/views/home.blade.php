@extends('layouts.app')

@section('title', 'Home')
{{-- @section('Dashboard') --}}


@section('content')
    <main class="flex-grow">
        <section class="w-full h-[60vh] md:h-[80vh] relative overflow-hidden" id="hero-carousel">
            <div class="carousel-track flex h-full transition-transform duration-700 ease-in-out">
                @for ($i = 1; $i <= 5; $i++)
                    @php $slidePath = public_path('images/slide' . $i . '.jpg'); @endphp

                    <div class="carousel-slide w-full h-full flex-shrink-0 relative">
                        {{-- BLUR BACKGROUND --}}
                        <div class="absolute inset-0 z-0">
                            <img src="{{ file_exists($slidePath) ? asset('images/slide' . $i . '.jpg') : 'https://via.placeholder.com/1200x800' }}"
                                class="w-full h-full object-cover scale-110 blur-2xl" alt="Blur Slide {{ $i }}">
                        </div>

                        {{-- MAIN IMAGE --}}
                        <div class="absolute inset-0 z-10">
                            <img src="{{ file_exists($slidePath) ? asset('images/slide' . $i . '.jpg') : 'https://via.placeholder.com/1200x800' }}"
                                class="w-full h-full object-cover" alt="Slide {{ $i }}">
                        </div>
                    </div>
                @endfor
            </div>

            {{-- BUTTON --}}
            <button class="carousel-button left" onclick="moveSlide(-1)">
                <span class="material-symbols-outlined">chevron_left</span>
            </button>

            <button class="carousel-button right" onclick="moveSlide(1)">
                <span class="material-symbols-outlined">chevron_right</span>
            </button>
        </section>


        <section class="py-16 md:py-24">
            <div class="container mx-auto px-6">
                <h2 class="text-4xl md:text-5xl font-display font-bold text-primary text-center mb-12">Tentang Kami</h2>
                <div class="flex flex-col lg:flex-row items-center justify-center gap-12 lg:gap-16">
                    <div class="w-full lg:w-1/2 flex justify-center perspective-[800px]">
                        @php
                            $fotoTentang = public_path('images/foto_tentang.jpg');
                        @endphp
                        @if (file_exists($fotoTentang))
                            <img alt="Foto Tentang"
                                class="rounded-xl shadow-2xl w-full max-w-md h-auto object-cover transform transition-transform duration-500 ease-in-out hover:rotate-y-[-10deg] hover:rotate-x-[5deg] hover:scale-105"
                                src="{{ asset('images/foto_tentang.jpg') . '?v=' . time() }}" />
                        @else
                            <img alt="Foto Tentang Default"
                                class="rounded-xl shadow-2xl w-full max-w-md h-auto object-cover transform transition-transform duration-500 ease-in-out hover:rotate-y-[-10deg] hover:rotate-x-[5deg] hover:scale-105"
                                src="https://via.placeholder.com/400x400?text=Foto+Tentang+Kami" />
                        @endif
                    </div>

                    <div class="w-full lg:w-1/2 text-center lg:text-left">
                        <h3 class="text-3xl font-display text-primary mb-4">Tentang Cafe</h3>
                        <p class="text-text-muted-light dark:text-text-muted-dark leading-relaxed">
                            {{ file_exists(resource_path('tentang_kami.txt')) ? nl2br(e(file_get_contents(resource_path('tentang_kami.txt')))) : 'Belum ada deskripsi tentang cafe.' }}
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </main>


    {{-- Script yg berada di dalam content, tapi dipush ke bawah body --}}
    @push('extra-scripts')
        <script>
            let currentSlide = 0;
            const slides = document.querySelectorAll('.carousel-slide');
            const track = document.querySelector('.carousel-track');
            const totalSlides = slides.length;

            function updateCarousel() {
                track.style.transform = `translateX(-${currentSlide * 100}%)`;
            }

            function moveSlide(direction) {
                currentSlide = (currentSlide + direction + totalSlides) % totalSlides;
                updateCarousel();
            }
            setInterval(() => {
                moveSlide(1);
            }, 5000);
        </script>
    @endpush
    </body>
@endsection
