@extends('layouts.user')

@section('title', 'Dashboard')

@section('user-home')

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
                        Selamat datang di Kopi Senja, di mana setiap cangkir menceritakan sebuah kisah. Didirikan pada tahun 2020, kami lebih dari sekadar tempat untuk menikmati kopi; kami adalah pusat komunitas, tempat di mana ide-ide muncul dan persahabatan terjalin. Kami dengan cermat memilih biji kopi terbaik dari seluruh dunia dan memanggangnya sendiri untuk memastikan rasa yang paling segar dan paling kaya. Bergabunglah bersama kami untuk merasakan kehangatan dan gairah dalam setiap tegukan.
                    </p>
            </div>
        </div>
    </div>
</section>
</main>

<footer class="bg-card-light dark:bg-card-dark pt-12 pb-6">
<div class="container mx-auto px-6">
<div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
<div class="md:col-span-1">
<h4 class="font-display text-xl font-bold text-primary mb-4">Kopi Senja</h4>
<p class="text-text-muted-light dark:text-text-muted-dark text-sm mb-4">
                            Cafe adalah tempat bersantai untuk semua kalangan dari anak muda sampai di kalangan orang tua juga.
                        </p>
<div class="flex space-x-4">
<a aria-label="Facebook" class="text-text-light dark:text-text-dark hover:text-primary dark:hover:text-white transition-colors duration-300" href="#"><svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"></path></svg></a>
<a aria-label="Instagram" class="text-text-light dark:text-text-dark hover:text-primary dark:hover:text-white transition-colors duration-300" href="#"><svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.85s-.011 3.584-.069 4.85c-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07s-3.584-.012-4.85-.07c-3.252-.148-4.771-1.691-4.919-4.919-.058-1.265-.069-1.645-.069-4.85s.011-3.584.069-4.85c.149-3.225 1.664-4.771 4.919-4.919 1.266-.057 1.644-.069 4.85-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948s.014 3.667.072 4.947c.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072s3.667-.014 4.947-.072c4.358-.2 6.78-2.618 6.98-6.98.059-1.281.073-1.689.073-4.948s-.014-3.667-.072-4.947c-.2-4.358-2.618-6.78-6.98-6.98C15.667.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.88 1.44 1.44 0 000-2.88z"></path></svg></a>
</div>
</div>
<div>
<h4 class="font-display text-xl font-bold text-primary mb-4">Hubungi Kami</h4>
<ul class="space-y-3 text-sm">
<li class="flex items-center">
<span class="material-symbols-outlined text-primary mr-3">call</span>
<span class="text-text-muted-light dark:text-text-muted-dark">+62-812-1234-1234</span>
</li>
<li class="flex items-center">
<span class="material-symbols-outlined text-primary mr-3">call</span>
<span class="text-text-muted-light dark:text-text-muted-dark">+62-812-1234-1234</span>
</li>
<li class="flex items-start">
<span class="material-symbols-outlined text-primary mr-3 mt-1">location_on</span>
<span class="text-text-muted-light dark:text-text-muted-dark">Jl. Nasional 1 Patrol, Kec. Patrol, Kab. Indramayu, Jawa Barat 45257</span>
</li>
</ul>
</div>
<div>
<h4 class="font-display text-xl font-bold text-primary mb-4">Lokasi</h4>
<div class="rounded-lg overflow-hidden shadow-lg aspect-video">
<iframe allowfullscreen="" height="100%" loading="lazy" referrerpolicy="no-referrer-when-downgrade" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.8398418536863!2d107.96222481477006!3d-6.414444995358054!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6eb5c1979b90c3%3A0x6b4c6e917d057a6e!2sPatrol%2C%20Indramayu%20Regency%2C%20West%20Java!5e0!3m2!1sen!2sid!4v1620896081465!5m2!1sen!2sid" style="border:0;" width="100%"></iframe>
</div>
</div>
</div>
<div class="border-t border-gray-200 dark:border-gray-700 pt-6 text-center text-sm text-text-muted-light dark:text-text-muted-dark">
<p>Hak Cipta © Copyright 2025. Kopi Senja.</p>
</div>
</div>
</footer>
</div>

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
