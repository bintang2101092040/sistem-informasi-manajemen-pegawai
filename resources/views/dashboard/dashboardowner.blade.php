@extends('layouts.admin.tabler')

@section('content')
    <style>
        #monthlyChart {
            width: 100% !important;
            height: 400px !important;
        }
    </style>
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        Overview
                    </div>
                    <h2 class="page-title">
                        Dashboard
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div>
                <canvas id="monthlyChart"></canvas>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const bulanLabels = @json($bulanLabels);
            const gajiPerBulan = @json($gajiPerBulan);

            console.log('Bulan Labels:', bulanLabels);
            console.log('Gaji Per Bulan:', gajiPerBulan);

            const ctx = document.getElementById('monthlyChart').getContext('2d');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: bulanLabels,
                    datasets: [{
                        label: 'Gaji Terima per Bulan',
                        data: gajiPerBulan,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@endsection
