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
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Grafik Penjualan</div>
                <div class="card-body">
                    <canvas id="myChart" width="400" height="200"></canvas>
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

    // Debugging
    console.log('Product Names:', {!! json_encode($productNames) !!});
    console.log('Product Quantities:', {!! json_encode($productQuantities) !!});

    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($productNames) !!},
            datasets: [{
                label: 'Penjualan',
                data: {!! json_encode($productQuantities) !!},
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        }
    });
</script>

@endsection