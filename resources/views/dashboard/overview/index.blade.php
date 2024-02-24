@extends('layouts.main')

@section('container')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="container px-4">
    <div class="p-5 rounded-lg">
        <div class="text-left">
            <h1 class="text-xl font-semibold">Overview</h1>
        </div>
        <div class="flex flex-col md:flex-row gap-4 mt-5">
            <div
                class="bg-white border-l-4 border-green-400 rounded w-full md:w-1/3 text-center hover:border-gray-500 p-5 md:p-10">
                <h2 class="font-bold text-2xl md:text-4xl">{{$countProducts}}</h2>
                <p class="text-sm md:text-base mt-2 text-gray-600">Jumlah Data Barang</p>
            </div>
            <div
                class="bg-white border-l-4 border-blue-400 rounded w-full md:w-1/3 text-center hover:border-red-500 p-5 md:p-10 mt-4 md:mt-0">
                <h2 class="font-bold text-2xl md:text-4xl">{{$countProductOutcome}}</h2>
                <p class="text-sm md:text-base mt-2 text-gray-600">Jumlah Data Barang Keluar</p>
            </div>
            <div
                class="bg-white border-l-4 border-yellow-400 rounded w-full md:w-1/3 text-center hover:border-fuchsia-500 p-5 md:p-10 mt-4 md:mt-0">
                <h2 class="font-bold text-2xl md:text-4xl">{{$countProductIncome}}</h2>
                <p class="text-sm md:text-base mt-2 text-gray-600">Jumlah Data Barang Masuk</p>
            </div>
        </div>
    </div>
    <div class="p-5 rounded-lg">
        <canvas id="productsChart" width="400" height="135"></canvas>

    </div>
</div>
<script>
    var ctx = document.getElementById('productsChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($labels),
            datasets: [{
                label: 'Jumlah barang',
                data: @json($data),
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgb(74 222 128)',
                borderWidth: 4
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: 'black'
                    }
                },
                x: {
                    ticks: {
                        color: 'black',
                    }
                }
            }
        }
    });
</script>
@endsection