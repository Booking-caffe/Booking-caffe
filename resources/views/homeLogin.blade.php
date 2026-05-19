@extends('layouts.app')

@section('title', 'HomePelanggan')

@section('content')
    @php
        $hubungi = [
            'telepon1' => '+62-812-1234-1234',
            'telepon2' => '+62-812-1234-1234',
            'alamat' => 'Jl. Nasional 1 Patrol, Kec. Patrol, Kab. Indramayu, Jawa Barat 45257',
        ];
        $contactPhone = '6287815349226';
        $kopiSenjaText = file_exists(resource_path('kopi_senja.txt'))
            ? file_get_contents(resource_path('kopi_senja.txt'))
            : 'Cafe adalah tempat bersantai untuk semua kalangan dari anak muda sampai di kalangan orang tua juga.';
        $lokasi =
            'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.8398418536863!2d107.96222481477006!3d-6.414444995358054!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6eb5c1979b90c3%3A0x6b4c6e917d057a6e!2sPatrol%2C%20Indramayu%20Regency%2C%20West%20Java!5e0!3m2!1sen!2sid!4v1620896081465!5m2!1sen!2sid';
        if (file_exists(resource_path('hubungi_kami.json'))) {
            $json = file_get_contents(resource_path('hubungi_kami.json'));
            $data = json_decode($json, true);
            if (is_array($data)) {
                $hubungi = array_merge($hubungi, $data);
            }
        }
        if (file_exists(resource_path('lokasi.txt'))) {
            $lokasiRaw = trim(file_get_contents(resource_path('lokasi.txt')));
            if (preg_match('/<iframe[^>]*src=["\']([^"\']+)["\']/i', $lokasiRaw, $matches)) {
                $lokasi = $matches[1];
            } elseif (!empty($lokasiRaw)) {
                $lokasi = $lokasiRaw;
            }
        }
    @endphp

    <main class="flex-grow">
        <section class="relative h-[calc(100vh-64px)] w-full overflow-hidden" id="hero-carousel" data-home-section="hero">
            <div class="relative h-full w-full">
                @php
                    $imageUrl = asset('images/imgCoffe.jpeg');
                @endphp

                <div class="absolute inset-0">
                    <img src="{{ $imageUrl }}" class="h-full w-full object-cover" alt="Foto Home Pelanggan">
                </div>

                <div class="absolute inset-0 z-[15] bg-black/40"></div>

                <div class="absolute inset-0 z-20 flex flex-col items-center justify-center px-4 text-center">
                    <h1 class="mb-4 text-4xl font-bold text-white drop-shadow-lg md:text-6xl">
                        The Perfect Roast
                    </h1>
                    <p class="mb-8 max-w-2xl text-lg text-gray-200 drop-shadow-md md:text-xl">
                        Nikmati aroma kopi autentik dan suasana nyaman hanya di kedai kami.
                        Tempat terbaik untuk cerita dan inspirasi.
                    </p>

                    <a href="{{ route('menu-makanan') }}"
                        class="inline-block rounded-full bg-blue-600 px-12 py-4 font-semibold text-white shadow-2xl transition duration-300 ease-in-out hover:scale-105 hover:bg-blue-700">
                        Pesan Sekarang
                    </a>
                </div>
            </div>
        </section>

        <section id="saran-kritik" class="bg-background-light py-16" data-home-section="saran-kritik">
            <div class="container mx-auto px-6">
                <div class="mx-auto max-w-4xl rounded-3xl bg-white p-8 shadow-md">
                    <div class="mb-6 text-center">
                        <h2 class="font-display text-4xl font-bold text-primary">Saran & Kritik</h2>
                        <p class="mt-3 text-text-muted-light">
                            Bantu kami meningkatkan pelayanan dengan masukan, saran, atau kritik Anda.
                        </p>
                    </div>

                    <div class="grid gap-6 md:grid-cols-2">
                        <div class="rounded-2xl bg-background-light p-5">
                            <h3 class="text-lg font-semibold text-primary">Yang Bisa Disampaikan</h3>
                            <ul class="mt-3 space-y-2 text-sm text-text-muted-light">
                                <li>Kualitas rasa makanan dan minuman.</li>
                                <li>Kenyamanan tempat dan pelayanan staf.</li>
                                <li>Saran fitur pemesanan dan reservasi.</li>
                            </ul>
                        </div>

                        <div class="rounded-2xl bg-background-light p-5">
                            <h3 class="text-lg font-semibold text-primary">Kirim Masukan</h3>
                            <p class="mt-3 text-sm text-text-muted-light">
                                Jika ingin langsung menyampaikan masukan, Anda bisa menghubungi kami lewat WhatsApp.
                            </p>
                            <a href="https://wa.me/{{ $contactPhone }}?text=Saya%20ingin%20memberikan%20saran%20dan%20kritik"
                                class="mt-5 inline-flex rounded-full bg-primary px-5 py-3 text-sm font-semibold text-white transition hover:opacity-90">
                                Kirim via WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="kontak" class="bg-white py-16" data-home-section="kontak">
            <div class="container mx-auto px-6">
                <div class="mx-auto max-w-5xl">
                    <div class="mb-8 text-center">
                        <h2 class="font-display text-4xl font-bold text-primary">Kontak</h2>
                        <p class="mt-3 text-text-muted-light">
                            Hubungi kami untuk reservasi, pertanyaan menu, atau informasi lainnya.
                        </p>
                    </div>

                    <div class="grid gap-6 md:grid-cols-3">
                        <div class="rounded-2xl bg-background-light p-6 shadow-sm">
                            <h3 class="text-lg font-semibold text-primary">Telepon 1</h3>
                            <p class="mt-3 text-sm text-text-muted-light">{{ $hubungi['telepon1'] }}</p>
                        </div>
                        <div class="rounded-2xl bg-background-light p-6 shadow-sm">
                            <h3 class="text-lg font-semibold text-primary">Telepon 2</h3>
                            <p class="mt-3 text-sm text-text-muted-light">{{ $hubungi['telepon2'] }}</p>
                        </div>
                        <div class="rounded-2xl bg-background-light p-6 shadow-sm">
                            <h3 class="text-lg font-semibold text-primary">Alamat</h3>
                            <p class="mt-3 text-sm text-text-muted-light">{{ $hubungi['alamat'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <footer class="bg-card-light pt-12 pb-6" data-home-footer>
            <div class="container mx-auto px-6">
                <div class="mb-8 grid grid-cols-1 gap-8 md:grid-cols-3">
                    <div class="md:col-span-1">
                        <h4 class="mb-4 font-display text-xl font-bold text-primary">Kopi Senja</h4>
                        <p class="mb-4 text-sm text-text-muted-light">
                            {{ $kopiSenjaText }}
                        </p>
                        <div class="flex space-x-4">
                            <a aria-label="Facebook" class="text-text-light transition-colors duration-300 hover:text-primary"
                                href="#">
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z">
                                    </path>
                                </svg>
                            </a>
                            <a aria-label="Instagram" class="text-text-light transition-colors duration-300 hover:text-primary"
                                href="#">
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.85s-.011 3.584-.069 4.85c-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07s-3.584-.012-4.85-.07c-3.252-.148-4.771-1.691-4.919-4.919-.058-1.265-.069-1.645-.069-4.85s.011-3.584.069-4.85c.149-3.225 1.664-4.771 4.919-4.919 1.266-.057 1.644-.069 4.85-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948s.014 3.667.072 4.947c.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072s3.667-.014 4.947-.072c4.358-.2 6.78-2.618 6.98-6.98.059-1.281.073-1.689.073-4.948s-.014-3.667-.072-4.947c-.2-4.358-2.618-6.78-6.98-6.98C15.667.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.88 1.44 1.44 0 000-2.88z">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div>
                        <h4 class="mb-4 font-display text-xl font-bold text-primary">Hubungi Kami</h4>
                        <ul class="space-y-3 text-sm">
                            <li class="flex items-center">
                                <span class="material-symbols-outlined mr-3 text-primary">call</span>
                                <span class="text-text-muted-light">{{ $hubungi['telepon1'] }}</span>
                            </li>
                            <li class="flex items-center">
                                <span class="material-symbols-outlined mr-3 text-primary">call</span>
                                <span class="text-text-muted-light">{{ $hubungi['telepon2'] }}</span>
                            </li>
                            <li class="flex items-start">
                                <span class="material-symbols-outlined mr-3 mt-1 text-primary">location_on</span>
                                <span class="text-text-muted-light">{{ $hubungi['alamat'] }}</span>
                            </li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="mb-4 font-display text-xl font-bold text-primary">Lokasi</h4>
                        <div class="aspect-video overflow-hidden rounded-lg shadow-lg">
                            <iframe allowfullscreen="" height="100%" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade" src="{{ $lokasi }}"
                                style="border:0;" width="100%"></iframe>
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-200 pt-6 text-center">
                    <p class="text-sm text-text-muted-light">
                        Hak Cipta © Copyright 2025. Kopi Senja.
                    </p>
                </div>
            </div>
        </footer>
    </main>
@endsection

@push('extra-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sections = document.querySelectorAll('[data-home-section]');
            const siteFooter = document.getElementById('site-footer');
            const pageFooter = document.querySelector('[data-home-footer]');
            const validSections = ['hero', 'saran-kritik', 'kontak'];

            function applySectionVisibility() {
                const hash = window.location.hash.replace('#', '');
                const activeSectionName = validSections.includes(hash) ? hash : 'hero';

                sections.forEach(section => {
                    section.classList.toggle('hidden', section.dataset.homeSection !== activeSectionName);
                });

                if (siteFooter) {
                    siteFooter.classList.add('hidden');
                }
                if (pageFooter) {
                    pageFooter.classList.remove('hidden');
                }

                const activeSection = activeSectionName === 'hero'
                    ? document.getElementById('hero-carousel')
                    : document.getElementById(activeSectionName);

                if (activeSection) {
                    activeSection.scrollIntoView({
                        behavior: 'instant',
                        block: 'start'
                    });
                }
            }

            applySectionVisibility();
            window.addEventListener('hashchange', applySectionVisibility);
        });
    </script>
@endpush
