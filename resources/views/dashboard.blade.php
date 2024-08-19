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
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0/dist/chartjs-plugin-datalabels.min.js">
</script>


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
                        <div class="col-md-6">
                            <div class="card card-custom">
                                <div class="card-body">
                                    <h5 class="card-title">Grafik Perbandingan Sampah (Minggu Ini)</h5>
                                    <div class="chart-container">
                                        <canvas id="perbandinganSampahChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-custom">
                                <div class="card-body">
                                    <h5 class="card-title">Persentase Resapan Sampah</h5>
                                    <div class="chart-container">
                                        <canvas id="pieChart"></canvas>
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
        });

        const ctxSampah = document.getElementById('sampahKategoriChart').getContext('2d');
        const sampahKategoriChart = new Chart(ctxSampah, {
            type: 'pie',
            data: {
                labels: @json($sampahMasukByKategori->pluck('kategori')),
                datasets: [{
                    data: @json($sampahMasukByKategori->pluck('percentage')),
                    backgroundColor: [
                        'rgba(64, 81, 59, 0.5)', // Warna untuk Organik
                        'rgba(54, 71, 49, 10)', // Warna untuk Anorganik
                    ],
                    borderColor: [
                        'rgba(64, 81, 59, 1)', // Border warna untuk Organik
                        'rgba(54, 71, 49, 1)', // Border warna untuk Anorganik
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
                                return `${data.labels[tooltipItem.index]}: ${tooltipItem.raw.toFixed(2)}%`;
                            }
                        }
                    },
                    datalabels: {
                        formatter: (value) => value.toFixed(2) + "%",
                        color: '#fff',
                    }
                }
            },
            plugins: [ChartDataLabels]
        });


        const ctxSelisih = document.getElementById('perbandinganSampahChart').getContext('2d');
        const perbandinganSampahChart = new Chart(ctxSelisih, {
            type: 'line',
            data: {
                labels: @json($labels),
                datasets: [{
                        label: 'Total Sampah Kotor',
                        data: @json($totalBerat),
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1,
                        fill: true,
                    },
                    {
                        label: 'Total Sampah Masuk',
                        data: @json($totalMasuk),
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1,
                        fill: true,
                    },
                    {
                        label: 'Resapan Sampah',
                        data: @json($selisih),
                        backgroundColor: 'rgba(54, 71, 49, 10)',
                        borderColor: 'rgba(54, 71, 49, 5)',
                        borderWidth: 1,
                        fill: true,
                    }
                ]
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
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.raw.toLocaleString() + ' kg';
                            }
                        }
                    },
                    datalabels: {
                        formatter: function(value) {
                            return value.toLocaleString() + ' kg';
                        },
                        color: '#000',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString() + ' kg';
                            }
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        });

        const ctxPie = document.getElementById('pieChart').getContext('2d');
        const pieChart = new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: ['Total Sampah Kotor', 'Total Sampah Masuk', 'Resapan Sampah'],
                datasets: [{
                    data: [{{ $persenSampahKotor }}, {{ $persenSampahMasuk }}, {{ $persenSelisih }}],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(54, 71, 49, 10)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 71, 49, 5)'
                    ],
                    borderWidth: 1
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
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2) + '%';
                            }
                        }
                    },
                    datalabels: {
                        formatter: function(value) {
                            return value.toFixed(2) + '%';
                        },
                        color: '#000',
                        font: {
                            weight: 'bold'
                        },
                        align: 'center',
                    }
                }
            },
            plugins: [ChartDataLabels]
        });
    </script>
@endsection
