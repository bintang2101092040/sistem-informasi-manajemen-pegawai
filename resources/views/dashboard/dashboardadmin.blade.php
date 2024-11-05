@extends('layouts.admin.tabler')
@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
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
            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-3">
                <!-- Menggunakan row-cols untuk memastikan semua card berada dalam satu row -->

                <div class="col">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-success text-white avatar">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icon-tabler-users">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M12 14c4 0 7 1.5 7 4v2H5v-2c0-2.5 3-4 7-4z" />
                                            <path d="M9 10a3 3 0 1 1 6 0a3 3 0 1 1 -6 0" />
                                            <path d="M5 9a3 3 0 0 1 3 -3" />
                                            <path d="M16 6a3 3 0 0 1 3 3" />
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        {{ $totalKaryawan }}
                                    </div>
                                    <div class="text-secondary">
                                        Total Karyawan
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-success text-white avatar">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icon-tabler-fingerprint">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M18.9 7a8 8 0 0 1 1.1 5v1a6 6 0 0 0 .8 3" />
                                            <path d="M8 11a4 4 0 0 1 8 0v1a10 10 0 0 0 2 6" />
                                            <path d="M12 11v2a14 14 0 0 0 2.5 8" />
                                            <path d="M8 15a18 18 0 0 0 1.8 6" />
                                            <path d="M4.9 19a22 22 0 0 1 -.9 -7v-1a8 8 0 0 1 12 -6.95" />
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        {{ $rekappresensi->jmlhadir }}
                                    </div>
                                    <div class="text-secondary">
                                        Karyawan Hadir
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-info text-white avatar">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icon-tabler-clipboard-list">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                            <path
                                                d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                            <path d="M9 12l.01 0" />
                                            <path d="M13 12l2 0" />
                                            <path d="M9 16l.01 0" />
                                            <path d="M13 16l2 0" />
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        {{ $rekapizin->jmlizin != null ? $rekapizin->jmlizin : 0 }}
                                    </div>
                                    <div class="text-secondary">
                                        Karyawan Izin
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-warning text-white avatar">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icon-tabler-first-aid-kit">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M8 8v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2" />
                                            <path
                                                d="M4 8m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                                            <path d="M10 14h4" />
                                            <path d="M12 12v4" />
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        {{ $rekapizin->jmlsakit != null ? $rekapizin->jmlsakit : 0 }}
                                    </div>
                                    <div class="text-secondary">
                                        Karyawan Sakit
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




                <div class="col-md-6 col-xl-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span
                                        class="bg-danger text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-alarm">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M12 13m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                            <path d="M12 10l0 3l2 0" />
                                            <path d="M7 4l-2.75 2" />
                                            <path d="M17 4l2.75 2" />
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        {{ $rekappresensi->jmlterlambat != null ? $rekappresensi->jmlterlambat : 0 }}
                                    </div>
                                    <div class="text-secondary">
                                        Karyawan Terlambat
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




            </div>
        </div>
    </div>
@endsection
