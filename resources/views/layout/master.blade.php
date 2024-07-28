<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Kelompok Swadaya Masyarakat</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <!-- Favicons -->
    <link href="{{ asset('assets/img/logo.png') }}" rel="icon">
    {{-- <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    <!-- =======================================================
    * Template Name: NiceAdmin
    * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
    * Updated: Apr 20 2024 with Bootstrap v5.3.3
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center">
                <img src="{{ asset('assets/img/logo.png') }}" alt="">
                <span class="d-none d-lg-block">KSM Rimbo Panjang</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <div class="search-bar">
            <form class="search-form d-flex align-items-center" method="POST" action="#">
                <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>
        </div><!-- End Search Bar -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->

                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                        data-bs-toggle="dropdown">
                        <img src="{{ asset('assets/img/profil.jpg') }}" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::User()->name }}</span>
                    </a><!-- End Profile Image Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>{{ Auth::User()->name }}</h6>
                            <span>{{ Auth::User()->role }}</span>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="login">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>
                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->
            </ul>
        </nav><!-- End Icons Navigation -->
    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">

            @if (Auth::User()->role == 'ketua')
                <li class="nav-item">
                    <a class="nav-link collapsed" href="/dashboard">
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="/tabel_warga">
                        <i class="bi bi-people"></i>
                        <span>Data Warga</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="/tabel_karyawan">
                        <i class="bi bi-person"></i>
                        <span>Data Karyawan</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="/tabel_rute">
                        <i class="fas fa-route"></i>
                        <span>Data Rute</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#data_sampah" data-bs-toggle="collapse"
                        href="#">
                        <i class="bi bi-menu-button-wide"></i><span>Data Sampah</span><i
                            class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="data_sampah" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="/tabel_stoksampah">
                                <i class="bi bi-circle"></i><span>Stok Sampah</span>
                            </a>
                        </li>
                        <li>
                            <a href="/tabel_sampahkotor">
                                <i class="bi bi-circle"></i><span>Sampah Kotor</span>
                            </a>
                        </li>
                        <li>
                            <a href="/tabel_sampahbersih">
                                <i class="bi bi-circle"></i><span>Sampah Bersih</span>
                            </a>
                        </li>
                    </ul>
                </li><!-- End Components Nav -->

                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#data_pemasukan" data-bs-toggle="collapse"
                        href="#">
                        <i class="bi bi-menu-button-wide"></i><span>Data Pemasukan</span><i
                            class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="data_pemasukan" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="/tabel_penjualan">
                                <i class="bi bi-circle"></i><span>Data Penjualan</span>
                            </a>
                        </li>
                        <li>
                            <a href="/tabel_iuransampah">
                                <i class="bi bi-circle"></i><span>Iuran Sampah Warga</span>
                            </a>
                        </li>
                    </ul>
                </li><!-- End Components Nav -->

                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#data_pengeluaran" data-bs-toggle="collapse"
                        href="#">
                        <i class="bi bi-menu-button-wide"></i><span>Data Pengeluaran</span><i
                            class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="data_pengeluaran" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="/tabel_gaji">
                                <i class="bi bi-circle"></i><span>Gaji Karyawan</span>
                            </a>
                        </li>
                        <li>
                            <a href="/tabel_cost">
                                <i class="bi bi-circle"></i><span>Biaya Operasional</span>
                            </a>
                        </li>
                    </ul>
                </li><!-- End Components Nav -->

                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#data_laporan" data-bs-toggle="collapse"
                        href="#">
                        <i class="bi bi-menu-button-wide"></i><span>Laporan</span><i
                            class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="data_laporan" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="/laporanpemasukan">
                                <i class="bi bi-circle"></i><span>Laporan Pemasukan</span>
                            </a>
                        </li>
                        <li>
                            <a href="/laporanpengeluaran">
                                <i class="bi bi-circle"></i><span>Laporan Pengeluaran</span>
                            </a>
                        </li>
                        <li>
                            <a href="/laporan_labarugi">
                                <i class="bi bi-circle"></i><span>Laporan Laba/Rugi</span>
                            </a>
                        </li>
                    </ul>
                </li><!-- End Components Nav -->
            @elseif(Auth::User()->role == 'bendahara')
                <li class="nav-item">
                    <a class="nav-link collapsed" href="/dashboard">
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#data_pemasukan" data-bs-toggle="collapse"
                        href="#">
                        <i class="bi bi-menu-button-wide"></i><span>Data Pemasukan</span><i
                            class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="data_pemasukan" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="/tabel_penjualan">
                                <i class="bi bi-circle"></i><span>Data Penjualan</span>
                            </a>
                        </li>
                        <li>
                            <a href="/tabel_iuransampah">
                                <i class="bi bi-circle"></i><span>Iuran Sampah Warga</span>
                            </a>
                        </li>
                    </ul>
                </li><!-- End Components Nav -->

                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#data_pengeluaran" data-bs-toggle="collapse"
                        href="#">
                        <i class="bi bi-menu-button-wide"></i><span>Data Pengeluaran</span><i
                            class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="data_pengeluaran" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="/tabel_gaji">
                                <i class="bi bi-circle"></i><span>Gaji Karyawan</span>
                            </a>
                        </li>
                        <li>
                            <a href="/tabel_cost">
                                <i class="bi bi-circle"></i><span>Biaya Operasional</span>
                            </a>
                        </li>
                    </ul>
                </li><!-- End Components Nav -->

                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#data_laporan" data-bs-toggle="collapse"
                        href="#">
                        <i class="bi bi-menu-button-wide"></i><span>Laporan</span><i
                            class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="data_laporan" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="/laporanpemasukan">
                                <i class="bi bi-circle"></i><span>Laporan Pemasukan</span>
                            </a>
                        </li>
                        <li>
                            <a href="/laporanpengeluaran">
                                <i class="bi bi-circle"></i><span>Laporan Pengeluaran</span>
                            </a>
                        </li>
                        <li>
                            <a href="/laporan_labarugi">
                                <i class="bi bi-circle"></i><span>Laporan Laba/Rugi</span>
                            </a>
                        </li>
                    </ul>
                </li><!-- End Components Nav -->
            @elseif(Auth::User()->role == 'admin')
                <li class="nav-item">
                    <a class="nav-link collapsed" href="/dashboard">
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="/tabel_warga">
                        <i class="bi bi-people"></i>
                        <span>Data Warga</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="/tabel_karyawan">
                        <i class="bi bi-person"></i>
                        <span>Data Karyawan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="/tabel_rute">
                        <i class="fas fa-route"></i>
                        <span>Data Rute</span>
                    </a>
                </li>

                <a class="nav-link collapsed" data-bs-target="#data_sampah" data-bs-toggle="collapse"
                    href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Data Sampah</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="data_sampah" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="/tabel_stoksampah">
                            <i class="bi bi-circle"></i><span>Stok Sampah</span>
                        </a>
                    </li>
                    <li>
                        <a href="/tabel_sampahkotor">
                            <i class="bi bi-circle"></i><span>Sampah Kotor</span>
                        </a>
                    </li>
                    <li>
                        <a href="/tabel_sampahbersih">
                            <i class="bi bi-circle"></i><span>Sampah Bersih</span>
                        </a>
                    </li>
                </ul>
                </li><!-- End Components Nav -->
            @endif
        </ul>

    </aside><!-- End Sidebar -->

    @yield('content')

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            <strong>2024 © Kelompok Swadaya Masyarakat Rimbo Panjang</strong>
        </div>
        <div class="credits">
            Dikembangkan Oleh Khairi Annisa
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/quill/quill.js') }}"></script>
    <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>
