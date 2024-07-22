@extends('layout.master')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

<style>
    .data-dashboard {
        background-color: #7C9070;
        color: white;
        padding: 10px 50px;
        border-radius: 5px 5px 30px 5px;
        display: inline-block;
        font-size: 17px;
        margin-bottom: 50px;
        font-weight: 600;
    }

    .card-custom {
        background-color: white;
        border: 2px solid #7C9070;
        color: #40513B;
    }

    .card-custom .card-title,
    .card-custom .card-text {
        color: #40513B;
    }

    .chart-container {
        position: relative;
        height: 300px;
        margin-top: 20px;
    }

    @media (max-width: 768px) {
        .chart-container {
            height: 200px;
        }
    }

    .d-flex-center {
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>

@section('content')
    <main id="main" class="main">
        <div class="data-dashboard">
            Beranda
        </div>
        <!-- End Page Title -->
        <section class="section dashboard">
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-xxl-4 col-md-4">
                            <div class="card card-custom mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Total Pemasukan</h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-cash-coin icon"></i>
                                        </div>
                                        <div class="ps-3">
                                            <p class="card-text">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-4 col-md-4">
                            <div class="card card-custom mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Total Pengeluaran</h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-wallet2 icon"></i>
                                        </div>
                                        <div class="ps-3">
                                            <p class="card-text">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-4 col-md-4">
                            <div class="card card-custom mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Laba Rugi</h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-graph-up icon"></i>
                                        </div>
                                        <div class="ps-3">
                                            <p class="card-text">Rp {{ number_format($labaRugi, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-4 col-md-4">
                            <div class="card card-custom mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Total Warga</h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people icon"></i>
                                        </div>
                                        <div class="ps-3">
                                            <p class="card-text">{{ $totalWarga }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-4 col-md-4">
                            <div class="card card-custom mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Iuran Lunas</h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-check-circle icon"></i>
                                        </div>
                                        <div class="ps-3">
                                            <p class="card-text">{{ $totalIuranLunas }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-4 col-md-4">
                            <div class="card card-custom mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Iuran Belum Lunas</h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-x-circle icon"></i>
                                        </div>
                                        <div class="ps-3">
                                            <p class="card-text">{{ $totalIuranBelumLunas }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="card card-custom">
                                <div class="card-body">
                                    <h5 class="card-title">Total Sampah Masuk</h5>
                                    <div class="chart-container">
                                        <canvas id="totalSampahChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-custom">
                                <div class="card-body">
                                    <h5 class="card-title">Sampah Masuk PerKategori</h5>
                                    <div class="chart-container d-flex-center">
                                        <canvas id="sampahKategoriChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->

    <script>
        const ctx = document.getElementById('totalSampahChart').getContext('2d');
        const totalSampahChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($sampahMasukPerNama->pluck('nama_sampah')),
                datasets: [{
                    label: 'Total Sampah Masuk',
                    data: @json($sampahMasukPerNama->pluck('total')),
                    backgroundColor: 'rgba(64, 81, 59, 1)',
                    borderColor: 'rgba(64, 81, 59, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                layout: {
                    padding: {
                        right: 10,
                        top: 25,
                    },
                },
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    datalabels: {
                        anchor: 'end',
                        align: 'end',
                        formatter: function(value) {
                            return value.toLocaleString() + ' kg'; // Format angka sesuai kebutuhan
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString(); // Format angka sesuai kebutuhan
                            }
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        });

        const ctxSampah = document.getElementById('sampahKategoriChart').getContext('2d');
        const sampahKategoriChart = new Chart(ctxSampah, {
            type: 'pie',
            data: {
                labels: @json($sampahMasukByKategori->pluck('kategori')),
                datasets: [{
                    data: @json($sampahMasukByKategori->pluck('total')),
                    backgroundColor: [
                        'rgba(64, 81, 59, 0.5)',
                        'rgba(54, 71, 49, 10)',
                        // Add more colors if needed
                    ],
                    borderColor: [
                        'rgba(64, 81, 59, 1)',
                        'rgba(54, 71, 49, 5)',
                        // Add more colors if needed
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem, data) {
                                let dataset = data.datasets[tooltipItem.datasetIndex];
                                let total = dataset.data.reduce((previousValue, currentValue) => previousValue +
                                    currentValue);
                                let currentValue = dataset.data[tooltipItem.index];
                                let percentage = Math.round((currentValue / total) * 100);
                                return `${data.labels[tooltipItem.index]}: ${percentage}%`;
                            }
                        }
                    },
                    datalabels: {
                        formatter: (value, ctx) => {
                            let total = ctx.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                            let percentage = ((value / total) * 100).toFixed(0) + "%";
                            return percentage;
                        },
                        color: '#fff',
                    }
                }
            },
            plugins: [ChartDataLabels]
        });
    </script>
@endsection
