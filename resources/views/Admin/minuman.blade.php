@extends('layouts.admin')

@section('title', 'Minuman')

@section('content')

<h2 class="page-title">Data Minuman</h2>

<div class="top-actions">
    <button class="btn-primary">+ Menu</button>

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
            <tr>
                <td>1</td>
                <td><div class="foto-box"></div></td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td class="aksi">
                    <button class="aksi-btn edit">✏️</button>
                    <button class="aksi-btn delete">🗑️</button>
                </td>
            </tr>
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
