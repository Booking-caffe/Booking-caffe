@extends('layouts.admin')

@section('title', 'Makanan')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/detail-menu.css') }}">
@endpush


@section('content')

<h2 class="page-title">Data Makanan</h2>

<div class="top-actions">
    <button class="btn-primary"><a href="{{ route('formMakanan') }}" style="text-decoration: none; color: white;">+ Menu</a></button>

    <div class="search-box">
        <input type="text" placeholder="Search">
    </div>
</div>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Foto</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Deskripsi</th>
                <th>Jumlah</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($makanan as $menu)
                <tr>
                    <td>1</td>
                    <td>
                        <div class="foto-box">
                            <img src="{{ asset('storage/' . $menu->gambar) }}" alt="{{ $menu->nama_menu }}">
                        </div>
                    </td>
                    <td><span>{{ $menu->nama_menu }}</span></td>
                    <td><span>{{ $menu->harga }}</span></td>
                    <td><span>{{ $menu->deskripsi }}</span></td>
                    <td><span>{{ $menu->stok }}</span></td>
                    <td>
                        <button class="aksi-btn edit"><a href="{{ route('edit' , $menu->id_menu) }}">✏️</a></button>
                        <!-- HAPUS -->
                        <form action="{{ route('destroy', $menu->id_menu) }}"
                              method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus menu ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="px-3 py-1 bg-red-600 text-white rounded">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="pagination">
    <div class="show-entries">
        Show
        <select>
            <option>5</option>
            <option>10</option>
            <option>20</option>
        </select>
        entries
    </div>

    <div class="page-controls">
        <button>Previous</button>
        <span>1</span>
        <button>Next</button>
    </div>
</div>

@endsection
