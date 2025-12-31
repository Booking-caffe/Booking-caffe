@extends('layouts.admin')

@section('title', 'Edit Menu')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/form-makanan.css') }}">
@endpush

@section('content')
    <div class="main-content" style="max-width: 600px">
        <div class="max-w-2xl  bg-white  dark:bg-surface-dark rounded-lg shadow-lg p-6 sm:p-8 md:p-12">

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <h1 class="text-3xl md:text-4xl font-bold text-center mb-8 text-primary">Edit User</h1>

            <form action="{{ route('updateUser', $userEdit->id_pelanggan) }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                {{-- @method('PUT') --}}
                <div class="mb-5" style="display: flex; justify-content: center;">
                    {{-- @if ($userUpdate->gambar)
                        <img src="{{ asset('storage/' . $userUpdate->gambar) }}" style="width: 350px;" class="w-32 rounded mb-3">
                    @endif --}}
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label class="block text-sm font-medium text-text-muted-light dark:text-text-muted-dark mb-1"
                            for="nama_pelanggan">Nama Pelanggan</label>

                        <input
                            class="block w-full rounded-md border-gray-300 dark:border-gray-600 bg-background-light dark:bg-background-dark focus:ring-primary focus:border-primary transition duration-150 ease-in-out shadow-sm"
                            id="nama_pelanggan" name="nama_pelanggan" placeholder="Nama Pelanggan"
                            value="{{ old('nama_pelanggan', $userEdit->nama_pelanggan) }}" type="text" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-text-muted-light dark:text-text-muted-dark mb-1"
                            for="no_telepon">No. Telepon</label>
                        <input
                            class="block w-full rounded-md border-gray-300 dark:border-gray-600 bg-background-light dark:bg-background-dark focus:ring-primary focus:border-primary transition duration-150 ease-in-out shadow-sm text-sm font-medium text-text-muted-light dark:text-text-muted-dark "
                            id="no_telepon" name="no_telepon" placeholder="No Telepon" type="text"
                            value="{{ old('no_telepon', $userEdit->no_telepon) }}" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-text-muted-light dark:text-text-muted-dark mb-1"
                            for="username">Username</label>
                        <input
                            class="block w-full rounded-md border-gray-300 dark:border-gray-600 bg-background-light dark:bg-background-dark focus:ring-primary focus:border-primary transition duration-150 ease-in-out shadow-sm text-sm font-medium text-text-muted-light dark:text-text-muted-dark "
                            id="username" name="username" placeholder="Username" type="text"
                            value="{{ old('username', $userEdit->username) }}" />
                    </div>

                    {{-- <div>
                        <label class="block text-sm font-medium text-text-muted-light dark:text-text-muted-dark mb-1"
                            for="stok">Stok</label>
                        <input
                            class="block w-full rounded-md border-gray-300 dark:border-gray-600 bg-background-light dark:bg-background-dark focus:ring-primary focus:border-primary transition duration-150 ease-in-out shadow-sm text-sm font-medium text-text-muted-light dark:text-text-muted-dark "
                            id="stok" name="stok" min="0" placeholder="Stok Makanan" type="number"
                            value="{{ old('stok', $menu->stok) }}" />
                    </div> --}}
                </div>
                {{-- <div class="mb-3 mt-4">
                    <label
                        class="form-label block text-sm font-medium text-text-muted-light dark:text-text-muted-dark mb-1">Upload
                        Gambar</label>
                    <input type="file" name="gambar" id="previewGambar" accept="image/*"
                        class="
                            block w-full 
                            rounded-md 
                            border-gray-300 dark:border-gray-600 
                            bg-background-light dark:bg-background-dark 
                            focus:ring-primary focus:border-primary 
                            transition duration-150 ease-in-out shadow-sm 
                            text-sm font-medium text-text-muted-light dark:text-text-muted-dark

                            file:py-2     /* tinggi tombol */
                            file:px-4
                            file:rounded-md
                            file:border-0
                            file:text-sm
                            file:font-medium
                            file:bg-primary
                            file:text-white
                            hover:file:bg-primary/80
                        ">
                </div> --}}

                <!-- Tempat Preview -->
                <div class="mt-5" style="display: flex; align-items: center; justify-content: center;">
                    <img id="gambarPreview" src="#" alt="Preview Gambar"
                        style="display:none; width:200px; border-radius:10px;">
                </div>

                <div class="mt-8">
                    <button
                        class="w-full bg-primary text-white font-bold py-3 px-4 rounded-md hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary dark:focus:ring-offset-background-dark transition-all duration-300 ease-in-out shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
                        type="submit">
                        Selanjutnya
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('extra-script')
    <script>
        // Menampilkan preview setelah pilih gambar
        document.getElementById('previewGambar').addEventListener('change', function(event) {
            const file = event.target.files[0];

            if (file) {
                const gambarPreview = document.getElementById('gambarPreview');
                gambarPreview.src = URL.createObjectURL(file);
                gambarPreview.style.display = 'block';
            }
        });
    </script>
@endpush
