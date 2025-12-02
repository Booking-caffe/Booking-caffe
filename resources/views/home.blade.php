@extends('layouts.app')

@section('title', 'Home')
{{-- @section('Dashboard') --}}


@section('content')
<main class="flex-grow">
    <section class="w-full h-[60vh] md:h-[80vh] relative carousel-container" id="hero-carousel">
        <div class="carousel-track h-full">
            <div class="carousel-slide h-full">
                <img alt="Sunlight streaming into a modern, cozy coffee shop interior" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBCuc9jXGM6AmhQ648_DV92_A4WpWYu_sPlvTqXbWBN4Wxvx9ekgwwat19EfvwPgdSr1-e2yTTQSmQnvYdAdWaDvulAbpTLcLnTI3AT7j2TFf6oEcfkTwvkoHRLl-VH31P6cj_x1RDhYLRiIe21cTvdERdxTteVVMt7obHXUJiAX84keS_s9XeKsxGhlrOLQ-QRlNTxbwoU7VBA8iPRhaWgGPbKI37vHRq05oFeg8Iq4r-kmCzf8WDU2vzg1IAwDKec86V3q-iT4a1W"/>
            </div>
            <div class="carousel-slide h-full">
                <img alt="Close-up of a barista making latte art in a coffee cup" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB_rbkmgf2OxmEBESRjzbkSFbIA-rI0dPoOJbygxkAWjuSq-b9tZj8aLui-HbumN74rJOyfYYemoYy74f-nRuf5kY8uaYcGx5bhvPYIsBY4ksRpMbwYG5SFeVI3Dl2whaDgMFObHpcryRfzNrqowXzA3GaNQq5URRJOtdIsJlOVRt6VkjNR7vmq58JnW2u2vgPQyL2pZpO8PilTMWHn4dxU1tCseq6BWXuX8Dr312i1aPlToMixYbFEOtUvkudNvbFRClzWNr9dWtDa"/>
            </div>
            <div class="carousel-slide h-full">
                <img alt="A variety of coffee beans in rustic wooden bowls" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCC8BXbgKE7bTAmOEeBRI4zv9mKEf2D7XiaFugGgCb60r4yr3rqLkr_Y9oF_9jE1k7Hrhnru-Ukx0y2Avi47FTqHqrCCMi2HSHkWQqGvKZJirNrQik0S48ThtkdpJjTa633uoHqSGglsw3zrz4Mfz6w2tthhV0OZT4dh1YILQO3kYWcGJy0rA8WBftwPABHJJsOHcMyTkfOVUZT-jhMgyg2ub6NdQJZVdKuDtdcV2dhru3hx_Y7jrM5ECJYk0w5O0lH-TsH1_i8zIKt"/>
            </div>
        </div>

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
                    <img alt="Exterior view of a charming coffee shop with outdoor seating" class="rounded-xl shadow-2xl w-full max-w-md h-auto object-cover transform transition-transform duration-500 ease-in-out hover:rotate-y-[-10deg] hover:rotate-x-[5deg] hover:scale-105" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD_k9ld6C7m_GcClchJTfpvNloDzrZ7J7B2jS8ib3LNn6X6xV7s5ieXYzAK1Jf_QZel7vewAS1WAnSQ8z5FuFdvGcF2FzFiob7MPW8eTWflgschqShKL-vEgU-W2h-lV4Ep_A5VGYz4v_mBbilXSb26W-3tdyl27W4dbA-URoigujao-ipD46GDiSMExl_TGBnUw0knn3QJMt8qNpzlFJW-lqm_BZ3Vjfx1I_X55e5YYTts06f9ohmf2bHb8x8HAgNp5smxTNPGqBr-"/>
                </div>

                <div class="w-full lg:w-1/2 text-center lg:text-left">
                    <h3 class="text-3xl font-display text-primary mb-4">Tentang Cafe</h3>
                    <p class="text-text-muted-light dark:text-text-muted-dark leading-relaxed">
                    Selamat datang di Kopi Senja, di mana setiap cangkir menceritakan sebuah kisah. Didirikan pada tahun 2020, kami lebih dari sekadar tempat untuk menikmati kopi; kami adalah pusat komunitas, tempat di mana ide-ide muncul dan persahabatan terjalin. Kami dengan cermat memilih biji kopi terbaik dari seluruh dunia dan memanggangnya sendiri untuk memastikan rasa yang paling segar dan paling kaya. Bergabunglah bersama kami untuk merasakan kehangatan dan gairah dalam setiap tegukan.</p>
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
