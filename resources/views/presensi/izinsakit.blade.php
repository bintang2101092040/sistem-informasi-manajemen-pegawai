@extends('layouts/admin/tabler')


@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Data Izin / Sakit
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <form action="/presensi/izinsakit" method="GET">
                                <div class="row">
                                    <div class="col-6">

                                        <div class="input-icon mb-3">
                                            <span class="input-icon-addon">
                                                <!-- SVG Icon for NIK -->
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-calendar">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                                    <path d="M16 3v4" />
                                                    <path d="M8 3v4" />
                                                    <path d="M4 11h16" />
                                                    <path d="M11 15h1" />
                                                    <path d="M12 15v3" />
                                                </svg>
                                            </span>
                                            <input type="text" value="{{ Request('dari') }}" id="dari"
                                                name="dari" class="form-control mb-4" placeholder="Dari"
                                                autocomplete="off" readonly>

                                        </div>
                                    </div>
                                    <div class="col-6">

                                        <div class="input-icon mb-3">

                                            <span class="input-icon-addon">
                                                <!-- SVG Icon for NIK -->
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-calendar">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                                    <path d="M16 3v4" />
                                                    <path d="M8 3v4" />
                                                    <path d="M4 11h16" />
                                                    <path d="M11 15h1" />
                                                    <path d="M12 15v3" />
                                                </svg>
                                            </span>
                                            <input type="text" value="{{ Request('sampai') }}" id="sampai"
                                                name="sampai" class="form-control mb-4" placeholder="Sampai"
                                                autocomplete="off" readonly>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">

                                        <div class="input-icon mb-3">
                                            <span class="input-icon-addon">
                                                <!-- SVG Icon for NIK -->
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                                    <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                                    <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                                                </svg>
                                            </span>
                                            <input type="text" value="{{ Request('nama_lengkap') }}" id="nama_lengkap"
                                                name="nama_lengkap" class="form-control mb-4"
                                                placeholder="Cari Berdasarkan Nama Karyawan" autocomplete="off">

                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <select name="status_approved" id="status_approved" class="form-select">
                                                <option value="">Pilih Status</option>
                                                <option value="0"
                                                    {{ Request('status_approved') === '0' ? 'selected' : '' }}>
                                                    Pending</option>
                                                <option value="1"
                                                    {{ Request('status_approved') == 1 ? 'selected' : '' }}>
                                                    Disetujui</option>
                                                <option value="2"
                                                    {{ Request('status_approved') == 2 ? 'selected' : '' }}>
                                                    Ditolak</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <button class="btn btn-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                                    <path d="M21 21l-6 -6" />
                                                </svg>
                                                Cari Data
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>


                            <div class="row">
                                <div class="col-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Nik</th>
                                                <th>Nama Karyawan</th>
                                                <th>Lampiran Dokter</th>
                                                <th>Jabatan</th>
                                                <th>Status</th>
                                                <th>Keterangan</th>
                                                <th>Status Approve</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($izinsakit as $d)
                                                @php
                                                    $path = Storage::url('uploads/izin/' . $d->foto_izin);
                                                @endphp
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ tanggalSingkat($d->tgl_izin_dari) }} s/d
                                                        {{ tanggalSingkat($d->tgl_izin_sampai) }}</td>
                                                    <td>{{ $d->nik }}</td>
                                                    <td>{{ $d->nama_lengkap }}</td>
                                                    <td style="text-align: center; vertical-align: middle;">
                                                        @if (empty($d->foto_izin))
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="#ff0000" stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-photo-off">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path d="M15 8h.01" />
                                                                <path
                                                                    d="M7 3h11a3 3 0 0 1 3 3v11m-.856 3.099a2.991 2.991 0 0 1 -2.144 .901h-12a3 3 0 0 1 -3 -3v-12c0 -.845 .349 -1.608 .91 -2.153" />
                                                                <path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l5 5" />
                                                                <path
                                                                    d="M16.33 12.338c.574 -.054 1.155 .166 1.67 .662l3 3" />
                                                                <path d="M3 3l18 18" />
                                                            </svg>
                                                        @else
                                                            <a href="{{ url($path) }}"
                                                                data-lightbox="izin-{{ $d->izin_id }}"
                                                                data-title="{{ $d->nama_lengkap }} <br> {{ $d->status_izin == 'i' ? 'Izin' : 'Sakit' }} : {{ $d->keterangan }}">
                                                                <img src="{{ url($path) }}" alt=""
                                                                    class="avatar">
                                                            </a>
                                                        @endif
                                                    </td>
                                                    <td>{{ $d->nama_jabatan }}</td>
                                                    <td>
                                                        @if ($d->status_izin == 'i')
                                                            Izin
                                                        @elseif ($d->status_izin == 's')
                                                            Sakit
                                                        @elseif ($d->status_izin == 'c')
                                                            Cuti
                                                        @else
                                                            Unknown
                                                        @endif
                                                    </td>
                                                    <td>{{ $d->keterangan }}</td>
                                                    <td>
                                                        @if ($d->status_approved == 1)
                                                            <span class="badge bg-success"
                                                                style="color: #fff;">Disetujui</span>
                                                        @elseif($d->status_approved == 2)
                                                            <span class="badge bg-danger"
                                                                style="color: #fff;">Ditolak</span>
                                                        @else
                                                            <span class="badge bg-warning"
                                                                style="color: #fff;">Pending</span>
                                                        @endif

                                                    </td>
                                                    <td>
                                                        @if ($d->status_approved == 0)
                                                            <a href="#" class="btn btn-sm btn-primary approve"
                                                                id="approve" id_izinsakit="{{ $d->izin_id }}"><svg
                                                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-external-link">
                                                                    <path stroke="none" d="M0 0h24v24H0z"
                                                                        fill="none" />
                                                                    <path
                                                                        d="M12 6h-6a2 2 0 0 0 -2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-6" />
                                                                    <path d="M11 13l9 -9" />
                                                                    <path d="M15 4h5v5" />
                                                                </svg> Aksi</a>
                                                        @else
                                                            <a href="/presensi/{{ $d->izin_id }}/batalkanizinsakit"
                                                                class="btn btn-sm btn-danger"><svg
                                                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-square-x">
                                                                    <path stroke="none" d="M0 0h24v24H0z"
                                                                        fill="none" />
                                                                    <path
                                                                        d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14z" />
                                                                    <path d="M9 9l6 6m0 -6l-6 6" />
                                                                </svg> Batalkan</a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>


                                    {{ $izinsakit->links('vendor.pagination.bootstrap-5') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal modal-blur fade" id="modal-izinsakit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Izin/Sakit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/presensi/approveizinsakit" method="POST">
                        @csrf
                        <input type="hidden" id="id_izinsakit_form" name="id_izinsakit_form">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <select name="status_approved" id="status_approved" class="form-select">
                                        <option value="1">Disetujui</option>
                                        <option value="2">Ditolak</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <button class="btn btn-primary w-100 mt-4" type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-send">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M10 14l11 -11" />
                                            <path
                                                d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5" />
                                        </svg>
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- Konten peta akan dimuat di sini -->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('myscript')
    <script>
        $(function() {
            $(".approve").click(function(e) {
                e.preventDefault();
                var id_izinsakit = $(this).attr('id_izinsakit');
                $("#id_izinsakit_form").val(id_izinsakit);
                $("#modal-izinsakit").modal("show");
            });

            $("#dari, #sampai").datepicker({
                autoclose: true,
                todayHighlight: true,
                format: 'yyyy MM dd',

            });


        });
    </script>

    <!-- Lightbox JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
@endpush
