@extends('layouts.user')

@section('title', 'Dashboard')

@section('content')
                 <h2 class="page-title">Data Makanan</h2>

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

        </div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const ctx = document.getElementById("myChart").getContext("2d");

        new Chart(ctx, {
            type: "line",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "Mei"],
                datasets: [{
                    label: "Pelanggan",
                    data: [5, 9, 7, 12, 10],
                    borderWidth: 2,
                    borderColor: "blue"
                }]
            }
        });
    });
</script>
@endsection
