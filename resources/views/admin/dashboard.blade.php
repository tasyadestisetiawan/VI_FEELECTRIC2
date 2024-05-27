@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">

    {{-- Detail Card Count --}}
    <div class="row">
        <div class="col-md-3">
            <div class="card mb-3" style="max-width: 18rem; border: 2px solid #FF5B6C !important;">
                <div class="card-header fw-bold">Produk</div>
                <div class="card-body">
                    <h1 class="card-title text-center">
                        {{ $totalProducts }}
                    </h1>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mb-3" style="max-width: 18rem; border: 2px solid #007BFF !important;">
                <div class="card-header fw-bold">Kategori</div>
                <div class="card-body">
                    <h1 class="card-title text-center">
                        {{ $totalCategories }}
                    </h1>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mb-3" style="max-width: 18rem; border: 2px solid #3B2621 !important;">
                <div class="card-header fw-bold">Transaksi</div>
                <div class="card-body">
                    <h1 class="card-title text-center">
                        {{ $totalOrders }}
                    </h1>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mb-3" style="max-width: 18rem; border: 2px solid #3B2621 !important;">
                <div class="card-header fw-bold">Pelanggan</div>
                <div class="card-body">
                    <h1 class="card-title text-center">
                        {{ $totalUsers }}
                    </h1>
                </div>
            </div>
        </div>
    </div>

    {{-- Graph --}}
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Grafik Penjualan</div>
                <div class="card-body">
                    <canvas id="myChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Grafik Produk</div>
                <div class="card-body">
                    <canvas id="myChart2" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- CDN Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

{{-- Chart Penjualan --}}
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni'],
            datasets: [{
                label: 'Penjualan',
                data: [100, 200, 300, 400, 500, 600],
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        }
    });
</script>

{{-- Chart Pengunjung --}}
<script>
    var ctx = document.getElementById('myChart2').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni'],
            datasets: [{
                label: 'Produk',
                data: [200, 300, 400, 500, 600, 700],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        }
    });
</script>
@endsection