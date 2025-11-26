@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
     <div class="topbar">
                <input type="text" placeholder="Search..." class="search-bar" />
            </div>

            <div class="stats">
                <div class="card">Total Meja</div>
                <div class="card">Total Pelanggan</div>
                <div class="card">Pesanan Masuk</div>
            </div>

            <div class="chart">
                <canvas id="myChart"></canvas>
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
