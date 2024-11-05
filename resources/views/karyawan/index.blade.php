@extends('layouts/admin/tabler')
@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Karyawan
                    </div>
                    <h2 class="page-title">
                        Data Karyawan
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    @if (Session::get('success'))
                                        <div class="alert alert-success">
                                            {{ Session::get('success') }}
                                        </div>
                                    @endif

                                    @if (Session::get('warning'))
                                        <div class="alert alert-warning">

                                            {{ Session::get('warning') }}

                                        </div>
                                    @endif
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            {{ $errors->first('email') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- tombol tambah data karyawan --}}
                        <div class="row">
                            <div class="col-12">
                                <a href="#" class="btn btn-primary" id="btnTambahkaryawan">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 5l0 14" />
                                        <path d="M5 12l14 0" />
                                    </svg>
                                    Tambah Data
                                </a>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <form action="/karyawan" method="GET">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="text" name="nama_karyawan" id="nama_karyawan"
                                                    class="form-control" placeholder="Cari Nama/Jabatan"
                                                    value="{{ Request('nama_karyawan') }}">

                                            </div>
                                        </div>
                                        {{-- <div class="col-4">
                                                <div class="form-group">
                                                    <select name="jabatan" id="karyawan" class="form-select">
                                                        <option value="">Jabatan</option>
                                                        @foreach ($jabatan as $d)
                                                            <option value="{{ $d->jabatan }}">{{ $d->jabatan }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div> --}}

                                        {{-- tombol cari --}}
                                        <div class="col-6">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary"><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                                        <path d="M21 21l-6 -6" />
                                                    </svg>
                                                    Cari
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        {{-- tampilan tabel data --}}
                        <div class="row mt-2">
                            <div class="col-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nik</th>
                                            <th>Foto</th>
                                            <th>Nama</th>
                                            <th>Jabatan</th>
                                            <th>Cabang</th>
                                            <th>No. HP</th>
                                            <th>Status</th>
                                            <th>aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($karyawan as $d)
                                            @php
                                                $path = Storage::url('uploads/karyawan/' . $d->foto);
                                            @endphp
                                            <tr>
                                                <td>{{ $loop->iteration + $karyawan->firstItem() - 1 }}</td>
                                                <td>{{ $d->nik }}</td>
                                                <td>
                                                    @if (empty($d->foto))
                                                        <img src="{{ asset('assets/img/nophoto.png') }}" alt=""
                                                            class="avatar">
                                                    @else
                                                        <img src="{{ url($path) }}" alt="" class="avatar">
                                                    @endif
                                                </td>
                                                <td>{{ $d->nama_lengkap }}</td>
                                                <td>{{ $d->nama_jabatan }}</td>
                                                <td>{{ $d->kode_cabang }}</td>
                                                <td>{{ $d->no_hp }}</td>
                                                <td style="text-align: center; vertical-align: middle;">
                                                    @if (empty($d->status))
                                                        -
                                                    @else
                                                        {{ $d->status }}
                                                    @endif
                                                </td>
                                                <td class="action-column">
                                                    <div class="btn-group">
                                                        <a href="#" class="view btn btn-primary btn-sm"
                                                            style="margin-right: 5px" nik="{{ $d->nik }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                                <path
                                                                    d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                            </svg>
                                                            Detail
                                                        </a>
                                                        <div class="btn-group">
                                                            <a href="#" class="edit btn btn-info btn-sm"
                                                                nik="{{ $d->nik }}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                                                    <path stroke="none" d="M0 0h24v24H0z"
                                                                        fill="none" />
                                                                    <path
                                                                        d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                                    <path
                                                                        d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                                    <path d="M16 5l3 3" />
                                                                </svg>
                                                                Edit
                                                            </a>
                                                        </div>
                                                        <a href="/karyawan/{{ Crypt::encrypt($d->nik) }}/resetpassword"
                                                            class="btn btn-sm btn-warning" style="margin-left: 5px"><svg
                                                                xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-refresh">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                                                                <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                                                            </svg>Reset Password</a>
                                                        <form action="/karyawan/{{ $d->nik }}/delete"
                                                            style="margin-left: 5px" method="POST">
                                                            @csrf
                                                            <a class="btn btn-danger btn-sm delete-confirm">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                                                    <path stroke="none" d="M0 0h24v24H0z"
                                                                        fill="none" />
                                                                    <path d="M4 7l16 0" />
                                                                    <path d="M10 11l0 6" />
                                                                    <path d="M14 11l0 6" />
                                                                    <path
                                                                        d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                                </svg>
                                                                Hapus
                                                            </a>
                                                        </form>
                                                    </div>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                {{ $karyawan->links('vendor.pagination.bootstrap-5') }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>

    {{-- modal Tambah Data Karyawan --}}
    <div class="modal modal-blur fade" id="modal-inputkaryawan" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Karyawan </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/karyawan/store" method="POST" id="formkaryawan" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <!-- Input NIK -->
                                <div class="form-label">NIK</div>
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <!-- SVG Icon for NIK -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-barcode">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M4 7v-1a2 2 0 0 1 2 -2h2" />
                                            <path d="M4 17v1a2 2 0 0 0 2 2h2" />
                                            <path d="M16 4h2a2 2 0 0 1 2 2v1" />
                                            <path d="M16 20h2a2 2 0 0 0 2 -2v-1" />
                                            <path d="M5 11h1v2h-1z" />
                                            <path d="M10 11l0 2" />
                                            <path d="M14 11h1v2h-1z" />
                                            <path d="M19 11l0 2" />
                                        </svg>
                                    </span>
                                    <input type="text" value="" id="nik" name="nik"
                                        class="form-control mb-4" placeholder="NIK">
                                    <div id="error-nik" class="text-danger"></div>
                                </div>
                            </div>

                            <div class="col-6">
                                <!-- Input Nama Lengkap -->
                                <div class="form-label">Nama Lengkap</div>
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <!-- SVG Icon for Nama Lengkap -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icon-tabler-user">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                        </svg>
                                    </span>
                                    <input type="text" value="" id="nama_lengkap" name="nama_lengkap"
                                        class="form-control" placeholder="Nama Lengkap">

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-label">Cabang</div>
                                <select name="nama_jabatan" id="nama_jabatan" class="form-select">
                                    <option value="">Pilih Jabatan</option>
                                    @foreach ($jabatan as $d)
                                        <option value="{{ $d->nama_jabatan }}">{{ $d->nama_jabatan }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-6">
                                <!-- Input NO. HP -->
                                <div class="form-label">No. HP</div>
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <!-- SVG Icon for NO. HP -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icon-tabler-phone">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                                        </svg>
                                    </span>
                                    <input type="text" value="" id="no_hp" name="no_hp"
                                        class="form-control" placeholder="NO. Hp">
                                    <div id="error-no_hp" class="text-danger"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-label">Cabang</div>
                                <select name="kode_cabang" id="kode_cabang" class="form-select">
                                    <option value="">Pilih Cabang</option>
                                    @foreach ($cabang as $d)
                                        <option value="{{ $d->kode_cabang }}">{{ $d->nama_cabang }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>



                        <!-- Input Tambahan -->
                        <div class="row mt-2">
                            <div class="col-6">
                                <!-- Input Jenis Kelamin -->
                                <div class="form-label">Jenis Kelamin</div>
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <!-- SVG Icon for Jenis Kelamin -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icon-tabler-gender">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <circle cx="12" cy="9" r="6" />
                                            <path d="M12 3v6h6" />
                                            <path d="M5.5 17h2.5l1 3l3 -6h2.5" />
                                        </svg>
                                    </span>
                                    <input type="text" value="" id="jenis_kelamin" name="jenis_kelamin"
                                        class="form-control" placeholder="Jenis Kelamin">

                                </div>
                            </div>


                            <div class="col-6">
                                <!-- Input Tempat Tanggal Lahir -->
                                <div class="form-label">Tempat Tanggal Lahir</div>
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <!-- SVG Icon for Tempat Tanggal Lahir -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icon-tabler-calendar">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <rect x="4" y="5" width="16" height="16" rx="2" />
                                            <line x1="16" y1="3" x2="16" y2="7" />
                                            <line x1="8" y1="3" x2="8" y2="7" />
                                            <line x1="4" y1="11" x2="20" y2="11" />
                                        </svg>
                                    </span>
                                    <input type="text" value="" id="tempat_tgl_lahir" name="tempat_tgl_lahir"
                                        class="form-control" placeholder="Tempat, Tanggal Lahir">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <!-- Input NO. KK -->
                                <div class="form-label">No. KK</div>
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <!-- SVG Icon for NO. KK -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icon-tabler-id">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <rect x="4" y="4" width="16" height="16" rx="2" />
                                            <line x1="9" y1="9" x2="9.01" y2="9" />
                                            <line x1="9" y1="15" x2="15" y2="15" />
                                            <line x1="9" y1="11" x2="15" y2="11" />
                                        </svg>
                                    </span>
                                    <input type="text" value="" id="no_kk" name="no_kk"
                                        class="form-control" placeholder="NO. KK">
                                    <div id="error-no_kk" class="text-danger"></div>
                                </div>
                            </div>

                            <div class="col-6">
                                <!-- Input NIK Karyawan -->
                                <div class="form-label">NIK. Karyawan</div>
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <!-- SVG Icon for NIK Karyawan -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icon-tabler-badge">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <rect x="4" y="4" width="16" height="16" rx="2" />
                                            <circle cx="12" cy="10" r="3" />
                                            <path d="M8 16h8" />
                                        </svg>
                                    </span>
                                    <input type="text" value="" id="nik_karyawan" name="nik_karyawan"
                                        class="form-control" placeholder="NIK Karyawan">
                                    <div id="error-nik_karyawan" class="text-danger"></div>
                                </div>
                            </div>

                        </div>

                        <div class="row">




                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-label">Tanggal Gabung</div>
                                <!-- Input Tanggal Gabung -->
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <!-- SVG Icon for Tanggal Gabung -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icon-tabler-calendar">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <rect x="4" y="5" width="16" height="16" rx="2" />
                                            <line x1="16" y1="3" x2="16" y2="7" />
                                            <line x1="8" y1="3" x2="8" y2="7" />
                                            <line x1="4" y1="11" x2="20" y2="11" />
                                        </svg>
                                    </span>
                                    <input type="date" value="" id="tanggal_gabung" name="tanggal_gabung"
                                        class="form-control" placeholder="Tanggal Gabung">


                                </div>
                            </div>


                            <div class="col-6">
                                <!-- Input BPJS Kesehatan -->
                                <div class="form-label">BPJS Kesehatan</div>
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <!-- SVG Icon for BPJS Kesehatan -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icon-tabler-heart-rate-monitor">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M12 5v14" />
                                            <path d="M8 8v8" />
                                            <path d="M16 8v8" />
                                            <path d="M20 10v4" />
                                            <path d="M4 10v4" />
                                        </svg>
                                    </span>
                                    <input type="text" value="" id="bpjs_kesehatan" name="bpjs_kesehatan"
                                        class="form-control" placeholder="BPJS Kesehatan">
                                    <div id="bpjs_kesehatan" class="text-danger"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-label">BPJS Ketenagakerjaan</div>
                                <!-- Input BPJS Ketenagakerjaan -->
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <!-- SVG Icon for BPJS Ketenagakerjaan -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icon-tabler-heart">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M12 21c-4.636 0 -9 -4.29 -9 -9.5a9 9 0 0 1 17.543 -3.78a9 9 0 0 1 -2.543 13.28" />
                                        </svg>
                                    </span>
                                    <input type="text" value="" id="bpjs_ketenagakerjaan"
                                        name="bpjs_ketenagakerjaan" class="form-control"
                                        placeholder="BPJS Ketenagakerjaan">
                                    <div id="error-bpjs_ketenagakerjaan" class="text-danger"></div>
                                </div>
                            </div>


                            <div class="col-6">
                                <!-- Input Rekening Mandiri -->
                                <div class="form-label">Input Rekening Mandiri</div>
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <!-- SVG Icon for Rekening Mandiri -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icon-tabler-credit-card">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <rect x="3" y="5" width="18" height="14" rx="3" />
                                            <line x1="3" y1="10" x2="21" y2="10" />
                                            <line x1="7" y1="15" x2="7.01" y2="15" />
                                            <line x1="11" y1="15" x2="13" y2="15" />
                                        </svg>
                                    </span>
                                    <input type="text" value="" id="rek_mandiri" name="rek_mandiri"
                                        class="form-control" placeholder="Rek Mandiri">
                                    <div id="error-rek_mandiri" class="text-danger"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <!-- Input Email -->
                                <div class="form-label">Email</div>
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <!-- SVG Icon for Email -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icon-tabler-mail">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <rect x="3" y="5" width="18" height="14" rx="2" />
                                            <path d="M3 7l9 6l9 -6" />
                                        </svg>
                                    </span>
                                    <input type="email" value="" id="email" name="email"
                                        class="form-control" placeholder="Email">
                                </div>
                            </div>

                            <div class="col-6">
                                <!-- Input NPWP -->
                                <div class="form-label">NPWP</div>
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <!-- SVG Icon for NPWP -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icon-tabler-id">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <rect x="4" y="4" width="16" height="16" rx="2" />
                                            <line x1="9" y1="9" x2="9.01" y2="9" />
                                            <line x1="9" y1="15" x2="15" y2="15" />
                                            <line x1="9" y1="11" x2="15" y2="11" />
                                        </svg>
                                    </span>
                                    <input type="text" value="" id="npwp" name="npwp"
                                        class="form-control" placeholder="NPWP">
                                    <div id="error-npwp" class="text-danger"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <!-- Input Golongan Darah -->
                                <div class="form-label">Golongan Darah</div>
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <!-- SVG Icon for Golongan Darah -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icon-tabler-drop">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M12 3l-6 7a6 6 0 0 0 12 0z" />
                                        </svg>
                                    </span>
                                    <input type="text" value="" id="golongan_darah" name="golongan_darah"
                                        class="form-control" placeholder="Golongan Darah">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-label">Status</div>
                                <!-- Input Status -->
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <!-- SVG Icon for Status -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icon-tabler-flag">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M5 4v17" />
                                            <path d="M5 4a5 5 0 0 0 5 5h7l-2 7h-5a5 5 0 0 0 -5 5" />
                                        </svg>
                                    </span>
                                    <input type="text" value="" id="status" name="status"
                                        class="form-control" placeholder="Status">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <!-- Input Data Keluarga -->
                                <div class="form-label">Data Keluarga</div>
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <!-- SVG Icon for Data Keluarga -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icon-tabler-users">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <circle cx="9" cy="7" r="4" />
                                            <circle cx="20" cy="7" r="4" />
                                            <circle cx="20" cy="17" r="4" />
                                            <circle cx="9" cy="17" r="4" />
                                        </svg>
                                    </span>
                                    <textarea id="data_keluarga" name="data_keluarga" class="form-control" placeholder="Data Keluarga" rows="6"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <!-- Input Alamat KTP -->
                                <div class="form-label">Alamat KTP</div>
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <!-- SVG Icon for Alamat KTP -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icon-tabler-map-pin">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <circle cx="12" cy="11" r="3" />
                                            <path d="M12 2a9 9 0 0 0 -9 9c0 5 9 13 9 13s9 -8 9 -13a9 9 0 0 0 -9 -9" />
                                        </svg>
                                    </span>

                                    <textarea id="alamat_ktp" name="alamat_ktp" class="form-control" placeholder="Alamat KTP" rows="6"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-label">Alamat Domisili</div>
                                <!-- Input Alamat Domisili -->
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <!-- SVG Icon for Alamat Domisili -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icon-tabler-home">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M5 12h14" />
                                            <path d="M12 5l-7 7v6h14v-6z" />
                                        </svg>
                                    </span>


                                    <textarea id="alamat_domisili" name="alamat_domisili" class="form-control" placeholder="Alamat Domisili"
                                        rows="6"></textarea>
                                </div>
                            </div>

                        </div>


                        <div class="row mt-2">
                            <div class="col-12">

                                <div class="form-label">Foto</div>
                                <input type="file" name="foto" class="form-control">

                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <div class="form-group">
                                    <button class="btn btn-primary w-100"><svg xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-send">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M10 14l11 -11" />
                                            <path
                                                d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5" />
                                        </svg>
                                        Simpan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- modal edit --}}
    <div class="modal modal-blur fade" id="modal-editkaryawan" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Karyawan </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="loadeditform">

                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-blur fade" id="modal-viewkaryawan" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">View Data Karyawan </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="loadviewform">

                </div>
            </div>
        </div>
    </div>
@endsection

@push('myscript')
    <script>
        //fungsi btn tambah data karyawan
        $(function() {
            $("#nik").mask('0000000000000000000000');

            $("#btnTambahkaryawan").click(function() {

                $("#modal-inputkaryawan").modal("show");
            });


            //fungsi btn edit
            $(".edit").click(function() {
                var nik = $(this).attr('nik');
                $.ajax({
                    type: 'POST',
                    url: '/karyawan/edit',
                    cache: false,
                    data: {
                        _token: "{{ csrf_token() }}",
                        nik: nik
                    },
                    success: function(respond) {
                        $("#loadeditform").html(respond);
                    }
                });

                $("#modal-editkaryawan").modal("show");
            });

            $(".view").click(function() {
                var nik = $(this).attr('nik');
                $.ajax({
                    type: 'POST',
                    url: '/karyawan/view',
                    cache: false,
                    data: {
                        _token: "{{ csrf_token() }}",
                        nik: nik
                    },
                    success: function(respond) {
                        $("#loadviewform").html(respond);
                    }
                });

                $("#modal-viewkaryawan").modal("show");
            });




            //fungsi btn delete
            $(".delete-confirm").click(function(e) {
                var form = $(this).closest('form');
                e.preventDefault();
                Swal.fire({
                    title: "Apakah Anda Yakin?",
                    text: "Data Anda Akan Di Hapus!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                        Swal.fire({
                            title: "Deleted!",
                            text: "Data Berhasil Dihapus.",
                            icon: "success"
                        });
                    }
                });

            });


            //alert input karyawan
            $("#formkaryawan").submit(function() {
                var nik = $("#nik").val();
                var nama_lengkap = $("#nama_lengkap").val();
                var nama_jabatan = $("#nama_jabatan").val();
                var no_hp = $("#no_hp").val();
                var email = $("#email").val();
                var status = $("#status").val();
                var tanggal_gabung = $("#tanggal_gabung").val();
                var kode_cabang = $("#kode_cabang").val();
                if (nik == "") {
                    // alert('Nik Harus Diisi!');
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Nik Harus Diisi !',
                        icon: 'warning',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        $("#nik").focus();

                    });
                    return false;
                } else if (nama_lengkap == "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Nama Harus Diisi !',
                        icon: 'warning',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        $("#nama_lengkap").focus();

                    });
                    return false;
                } else if (nama_jabatan == "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Jabatan Harus Diisi !',
                        icon: 'warning',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        $("#nama_jabatan").focus();

                    });
                    return false;
                } else if (no_hp == "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'No HP Harus Diisi !',
                        icon: 'warning',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        $("#no_hp").focus();

                    });
                    return false;
                } else if (email == "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Email Harus Diisi !',
                        icon: 'warning',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        $("#email").focus();

                    });
                    return false;
                } else if (status == "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Status Harus Diisi !',
                        icon: 'warning',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        $("#status").focus();

                    });
                    return false;
                } else if (kode_cabang == "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Cabang Harus Dipilih !',
                        icon: 'warning',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        $("#kode_cabang").focus();

                    });
                    return false;
                } else if (tanggal_gabung == "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Tanggal Gabung Harus Diisi !',
                        icon: 'warning',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        $("#tanggal_gabung").focus();

                    });
                    return false;
                }

            });
        });


        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("formkaryawan").addEventListener("submit", function(event) {
                // Validasi NIK



                var no_hp = document.getElementById("no_hp").value;
                var errorno_hp = document.getElementById("error-no_hp");
                if (no_hp !== "" && !/^\d+$/.test(no_hp)) {
                    errorno_hp.innerText = "No.Hp harus berupa angka.";
                    document.getElementById("no_hp").focus();
                    event.preventDefault();
                    return;
                } else {
                    errorno_hp.innerText = ""; // Clear error message if valid
                }

                var no_kk = document.getElementById("no_kk").value;
                var errorno_kk = document.getElementById("error-no_kk");
                if (no_kk !== "" && !/^\d+$/.test(no_kk)) {
                    errorno_kk.innerText = "No. KK harus berupa angka.";
                    document.getElementById("no_kk").focus();
                    event.preventDefault();
                    return;
                } else {
                    errorno_kk.innerText = ""; // Clear error message if valid
                }

                var nik_karyawan = document.getElementById("nik_karyawan").value;
                var errornik_karyawan = document.getElementById("error-nik_karyawan");
                if (nik_karyawan !== "" && !/^\d+$/.test(nik_karyawan)) {
                    errornik_karyawan.innerText = "NIK Karyawan harus berupa angka.";
                    document.getElementById("nik_karyawan").focus();
                    event.preventDefault();
                    return;
                } else {
                    errornik_karyawan.innerText = ""; // Clear error message if valid
                }


                var bpjs_kesehatan = document.getElementById("bpjs_kesehatan").value;
                var errorbpjs_kesehatan = document.getElementById("error-bpjs_kesehatan");
                if (bpjs_kesehatan !== "" && !/^\d+$/.test(bpjs_kesehatan)) {
                    errorbpjs_kesehatan.innerText = "BPJS Kesehatan harus berupa angka.";
                    document.getElementById("bpjs_kesehatan").focus();
                    event.preventDefault();
                    return;
                } else {
                    errorbpjs_kesehatan.innerText = ""; // Clear error message if valid
                }

                var bpjs_ketenagakerjaan = document.getElementById("bpjs_ketenagakerjaan").value;
                var errorbpjs_ketenagakerjaan = document.getElementById("error-bpjs_ketenagakerjaan");
                if (bpjs_ketenagkerjaan !== "" && !/^\d+$/.test(bpjs_ketenagakerjaan)) {
                    errorbpjs_ketenagakerjaan.innerText = "BPJS Ketenagakerjaan harus berupa angka.";
                    document.getElementById("bpjs_ketenagakerjaan").focus();
                    event.preventDefault();
                    return;
                } else {
                    errorbpjs_ketenagakerjaan.innerText = ""; // Clear error message if valid
                }

                var rek_mandiri = document.getElementById("rek_mandiri").value;
                var errorrek_mandiri = document.getElementById("error-rek_mandiri");
                if (rek_mandiri !== "" && !/^\d+$/.test(rek_mandiri)) {
                    errorrek_mandiri.innerText = "Rekening Mandiri harus berupa angka.";
                    document.getElementById("rek_mandiri").focus();
                    event.preventDefault();
                    return;
                } else {
                    errorrek_mandiri.innerText = ""; // Clear error message if valid
                }

                var npwp = document.getElementById("npwp").value;
                var errornpwp = document.getElementById("error-npwp");
                if (npwp !== "" && !/^\d+$/.test(npwp)) {
                    errornpwp.innerText = "NPWP harus berupa angka.";
                    document.getElementById("npwp").focus();
                    event.preventDefault();
                    return;
                } else {
                    errornpwp.innerText = ""; // Clear error message if valid
                }

                // Lakukan validasi lainnya untuk input lainnya ...
            });
        });
    </script>
@endpush
