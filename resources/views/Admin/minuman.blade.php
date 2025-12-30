@extends('layouts.admin')

@section('title', 'Minuman')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/menu-admin.css') }}">
    
@endpush

@section('content')
<h2 class="page-title">Data Minuman</h2>

<div class="top-actions">
    <button class="btn-primary"><a href="{{ route('formMinuman') }}">+ Menu</a></button>

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
            @foreach ($minuman as $menu)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <div class="foto-box">
                            <img src="{{ asset('storage/' . $menu->gambar) }}" alt="{{ $menu->nama_menu }}">
                        </div>
                    </td>
                    <td style="text-align: left;"><span>{{ $menu->nama_menu }}</span></td>
                    <td style="text-align: left;"><span>{{ $menu->harga }}</span></td>
                    <td style="text-align: left;"><span>{{ $menu->deskripsi }}</span></td>
                    <td><span>{{ $menu->stok }}</span></td>
                    <td>
                        <div class="aksi">
                            {{-- EDIT --}}
                            <button class="aksi-btn edit"><a href="{{ route('edit' , $menu->id_menu) }}"><i class="bi bi-pencil-square"></i></a></button>
                            
                            {{-- HAPUS --}}
                            <form action="{{ route('destroy', $menu->id_menu) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus menu ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class=" aksi-btn delete">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
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
