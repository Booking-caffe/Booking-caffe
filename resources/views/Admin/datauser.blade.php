@extends('layouts.admin')

@section('title', 'Data User')

@section('content')

    <h2 class="page-title">Data User</h2>

    <div class="top-actions">
        <div class="search-box">
            <input type="text" placeholder="Search">
        </div>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Nomor Telepon</th>
                    <th>Tgl Terdaftar</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @if ($dataUser->isEmpty())
                    <tr>
                        <td colspan="11" class="text-center">Tidak Ada Data</td>
                    </tr>
                @else
                    @foreach ($dataUser as $u)
                        
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td style="text-align: left">{{ $u->nama_pelanggan }}</td>
                                <td>{{ $u->no_telepon }}</td>
                                <td>{{ $u->created_at }}</td>
                                <td class="aksi">
                                    {{-- EDIT --}}
                                    <button class="aksi-btn edit"><a href="{{ route('editUser', $u->id_pelanggan) }}"><i class="bi bi-pencil-square"></i></a></button>

                                    <!-- HAPUS -->
                                    {{-- <form action="{{ route('hapusUser', $u->id_pelanggan) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus menu ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class=" aksi-btn delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form> --}}
                                </td>
                            </tr>
                        
                    @endforeach
                @endif
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
