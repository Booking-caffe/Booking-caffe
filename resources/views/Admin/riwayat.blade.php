@extends('layouts.admin')

@section('title', 'Data Riwayat')

@section('content')

<h2 class="page-title">Data Riwayat</h2>

<div class="top-actions">
    <button class="btn-primary">Download</button>

    <div class="search-box">
        <input type="text" placeholder="Search">
    </div>
</div>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Jumlah Pesanan</th>
                <th>Total</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>1</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
            </tr>
        </tbody>

        <tfoot>
            <tr>
                <td colspan="3"><b>Total</b></td>
                <td><b>Rp.</b></td>
            </tr>
        </tfoot>
    </table>
</div>

<div class="pagination">
    <div class="show-entries">
        Show
        <select>
            <option>4</option>
            <option>8</option>
            <option>12</option>
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
