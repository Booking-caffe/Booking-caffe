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
                <th>No HP</th>
                <th>Jumlah</th>
                <th>No Meja</th>
                <th>Pesanan</th>
                <th>Total</th>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>1</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>Indoor-M1</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td class="aksi">
                    <button class="aksi-btn detail">Detail</button>
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
