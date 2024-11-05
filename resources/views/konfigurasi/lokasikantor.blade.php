@extends('layouts.admin.tabler')
@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->

                    <h2 class="page-title">
                        Konfigurasi Lokasi Kantor
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">

        <div class="container-xl">
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if (session('warning'))
                                <div class="alert alert-warning">
                                    {{ session('warning') }}
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="/konfigurasi/updatelokasikantor" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="form-label">Lokasi Kantor
                                                <a href="#" class="tutorial"><svg xmlns="http://www.w3.org/2000/svg"
                                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-help">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                                        <path d="M12 17l0 .01" />
                                                        <path d="M12 13.5a1.5 1.5 0 0 1 1 -1.5a2.6 2.6 0 1 0 -3 -4" />
                                                    </svg></a>
                                            </div>
                                            <div class="input-icon mb-3">
                                                <span class="input-icon-addon" style="margin-right: 8px;">
                                                    <!-- SVG Icon for NIK -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="currentColor"
                                                        class="icon icon-tabler icons-tabler-filled icon-tabler-gps">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path
                                                            d="M17 3.34a10 10 0 1 1 -15 8.66l.005 -.324a10 10 0 0 1 14.995 -8.336m-.086 5.066c.372 -.837 -.483 -1.692 -1.32 -1.32l-9 4l-.108 .055c-.75 .44 -.611 1.609 .271 1.83l3.418 .853l.855 3.419c.23 .922 1.498 1.032 1.884 .163z" />
                                                    </svg>
                                                </span>
                                                <input type="text" value="{{ $lok_kantor->lokasi_kantor }}"
                                                    id="lokasi_kantor" name="lokasi_kantor" class="form-control mb-4"
                                                    placeholder="Lokasi Kantor">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="form-label">Radius</div>
                                            <div class="input-icon mb-3">
                                                <span class="input-icon-addon" style="margin-right: 8px;">
                                                    <!-- SVG Icon for NIK -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-broadcast">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M18.364 19.364a9 9 0 1 0 -12.728 0" />
                                                        <path d="M15.536 16.536a5 5 0 1 0 -7.072 0" />
                                                        <path d="M12 13m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                                    </svg>
                                                </span>
                                                <input type="text" maxlength="5" value="{{ $lok_kantor->radius }}"
                                                    id="radius" name="radius" class="form-control mb-4"
                                                    placeholder="Radius">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100"> <svg xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-upload">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                                                <path d="M7 9l5 -5l5 5" />
                                                <path d="M12 4l0 12" />
                                            </svg>
                                            Update
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal modal-blur fade" id="modal-tutorial" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tutorial Memasukan Data Konfigurasi Lokasi Kantor </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    1. Buka <a href="https://www.google.com/maps" target="_blank">Google Maps</a> <br> <br>
                    2. Cari Titik Lokasi Kantor Yang Di inginkan, Lalu Klik kanan Pada Titik Tersebut. <br
                        style="margin-right: 8px;"> dan salin
                    titik(Bisa
                    Lansung di klik Kiri)
                    koordinat tersebut <br> seperti
                    gambar dibawah:<br>
                    <img src="{{ asset('tabler/static/tutorial1.png') }}" width="650" height="305"> <br> <br>

                    3. Paste Pada Inputan Konfigurasi Lokasi <br>
                    <img src="{{ asset('tabler/static/tutorial2.png') }}" width="650" height="305"> <br> <br>

                    4. Lalu Simpan/Update

                </div>
            </div>
        </div>
    </div>
@endsection

@push('myscript')
    <script>
        $(function() {
            $(".tutorial").click(function() {


                $("#modal-tutorial").modal("show");
            });
        });
    </script>
@endpush
