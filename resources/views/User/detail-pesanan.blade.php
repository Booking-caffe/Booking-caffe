@extends('layouts.app')

@section('title', 'Detail-Pesanan')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/detail-transaksi.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
@endpush

@push('header-script')
    <script>
         tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                colors: {
                    primary: "#A16207",
                    "background-light": "#FDFBF7",
                    "background-dark": "#1A120B",
                    "card-light": "#FFFFFF",
                    "card-dark": "#2C2319",
                    "text-light": "#333333",
                    "text-dark": "#E5E5E5",
                    "muted-light": "#6B7280",
                    "muted-dark": "#9CA3AF",
                    "border-light": "#E5E7EB",
                    "border-dark": "#4B5563"
                },
                fontFamily: {
                    display: ["Poppins", "sans-serif"],
                },
                borderRadius: {
                    DEFAULT: "0.5rem",
                },
                },
            },
            };
    </script>
@endpush

@section('content')
    <main class="flex-grow py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto">
            <div class="bg-card-light dark:bg-card-dark rounded-lg shadow-lg p-6 sm:p-8 transform transition-transform duration-300 ">
                <h1 class="text-center mb-6 text-2xl font-bold text-primary">Detail Pesanan</h1>
                <div class="flex justify-between items-start mb-6 border-b border-border-light dark:border-border-dark pb-4">
                    <div>
                        
                        <p class="text-muted-light dark:text-muted-dark mt-1">Meja: Indoor - M1</p>
                    </div>
                    <span class="text-lg font-semibold text-muted-light dark:text-muted-dark">#001</span>
                </div>
                <div class="space-y-4 mb-6">
                    <div class="flex justify-between font-semibold text-muted-light dark:text-muted-dark">
                        <span>Pesanan</span>
                        <span>Harga</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span>2x Mie</span>
                        <span>Rp. 30,000</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span>4x Es Teh</span>
                        <span>Rp. 20,000</span>
                    </div>
                </div>
                <div class="space-y-3 pt-4 border-t border-border-light dark:border-border-dark">
                    <div class="flex justify-between items-center text-muted-light dark:text-muted-dark">
                        <span>Total Belanja</span>
                        <span>Rp. 50,000</span>
                    </div>
                    <div class="flex justify-between items-center text-muted-light dark:text-muted-dark">
                        <span>Pajak</span>
                        <span>Rp. 5,000</span>
                    </div>
                    <div
                        class="flex justify-between items-center font-bold text-lg pt-2 text-text-light dark:text-text-dark">
                        <span>Total</span>
                        <span>Rp. 55,000</span>
                    </div>
                </div>
                <div class="mt-8">
                    <h3 class="font-semibold text-muted-light dark:text-muted-dark mb-2">Pembayaran</h3>
                    <div
                        class="flex items-center space-x-2 border border-border-light dark:border-border-dark rounded-md px-3 py-2 w-fit">
                        <span class="icon text-primary">qr_code_2</span>
                        <span class="font-medium">QRIS</span>
                    </div>
                </div>
                <div class="mt-8 flex flex-col items-center space-y-6">
                    <div
                        class="w-48 h-48 sm:w-56 sm:h-56 bg-gray-200 dark:bg-gray-700 rounded-lg flex items-center justify-center">
                        <img alt="QR code for payment" class="rounded-lg"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuDN9LNR4Xk74VGVHIPX3zzfhjDInU4t0XSMJ0BmQzxXsn0Tupmez6cXpG9F03vjHbkIOqDXycVGsDmsTrWIaLcfpw7ZwSep17IW29T7YVtGu6JQjerkDHjNjklE_K4Bbr8xT3ggoU_Ni6Cwquw5NfNZB0wIMeTgpuCNiM8co-CHR78hyyW9wf08hEzZGravqWBE9rWPy28OCh0W9l5u3hhT3vSpTgM1dns9mRnhlvrxkNWWq47SAIG1E6fZ8oXzC5-mDjZ1QbWdND-_" />
                    </div>
                    <button class="w-full bg-primary text-white py-3 px-6 rounded-md font-semibold hover:bg-yellow-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary dark:focus:ring-offset-background-dark transition-all duration-300 transform hover:scale-105"><a href="{{ route ('detail-transaksi') }}">Selesaikan Pesanan</a></button>
                </div>
            </div>
        </div>
    </main>
@endsection
