@extends('layouts.app')

@section('title', 'Reservasi')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/reservasi.css') }}">
@endpush


@section('content')
<main class="flex-grow">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-20">
        <div class="max-w-2xl mx-auto bg-white  dark:bg-surface-dark rounded-lg shadow-lg p-6 sm:p-8 md:p-12">
            <h1 class="text-3xl md:text-4xl font-bold text-center mb-8 text-primary">Reservasi</h1>
            <form action="{{ route('tempat-duduk') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-text-muted-light dark:text-text-muted-dark mb-1" for="nama">Nama</label>
                        <input class="block w-full rounded-md border-gray-300 dark:border-gray-600 bg-background-light dark:bg-background-dark focus:ring-primary focus:border-primary transition duration-150 ease-in-out shadow-sm" id="nama" name="nama" placeholder="Nama Lengkap Anda" type="text"/>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-text-muted-light dark:text-text-muted-dark mb-1" for="no_hp">No. Hp</label>
                        <input class="block w-full rounded-md border-gray-300 dark:border-gray-600 bg-background-light dark:bg-background-dark focus:ring-primary focus:border-primary transition duration-150 ease-in-out shadow-sm" id="no_hp" name="no_hp" placeholder="+62 812-3456-7890" type="tel"/>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-text-muted-light dark:text-text-muted-dark mb-1" for="waktu">Waktu</label>
                        <input class="block w-full rounded-md border-gray-300 dark:border-gray-600 bg-background-light dark:bg-background-dark focus:ring-primary focus:border-primary transition duration-150 ease-in-out shadow-sm" id="waktu" name="waktu" type="time"/>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-text-muted-light dark:text-text-muted-dark mb-1" for="jumlah_tamu">Jumlah Tamu</label>
                        <input class="block w-full rounded-md border-gray-300 dark:border-gray-600 bg-background-light dark:bg-background-dark focus:ring-primary focus:border-primary transition duration-150 ease-in-out shadow-sm" id="jumlah_tamu" min="1" name="jumlah_tamu" placeholder="2" type="number"/>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-text-muted-light dark:text-text-muted-dark mb-1" for="tanggal">Tanggal</label>
                        <div class="relative">
                            <input class="block w-full rounded-md border-gray-300 dark:border-gray-600 bg-background-light dark:bg-background-dark focus:ring-primary focus:border-primary transition duration-150 ease-in-out shadow-sm pr-10" id="tanggal" name="tanggal" type="date"/>
                        </div>
                    </div>
                </div>
                <div class="mt-8">
                    <button class="w-full bg-primary text-white font-bold py-3 px-4 rounded-md hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary dark:focus:ring-offset-background-dark transition-all duration-300 ease-in-out shadow-lg hover:shadow-xl transform hover:-translate-y-0.5" type="submit">
                        Selanjutnya
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
