@extends('layouts/admin/tabler')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Data Cabang
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

                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-12 mb-2">
                                    <a href="#" class="btn btn-primary" id="btnTambahcabang">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icon-tabler-plus">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M12 5l0 14" />
                                            <path d="M5 12l14 0" />
                                        </svg>
                                        Tambah Data
                                    </a>
                                    <a href="#" class="tutorial" style="font-size: 50px;margin-left:20px"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="48" height="48"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-help">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                            <path d="M12 17l0 .01" />
                                            <path d="M12 13.5a1.5 1.5 0 0 1 1 -1.5a2.6 2.6 0 1 0 -3 -4" />
                                        </svg></a>
                                </div>



                            </div>



                            <div class="row mt-2">
                                <div class="col-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Cabang</th>
                                                <th>Nama Cabang</th>
                                                <th>Lokasi</th>
                                                <th>Radius</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($cabang as $d)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $d->kode_cabang }}</td>
                                                    <td>{{ $d->nama_cabang }}</td>
                                                    <td>{{ $d->lokasi_cabang }}</td>
                                                    <td>{{ $d->radius_cabang }} Meter</td>
                                                    <td class="action-column">
                                                        <div class="btn-group">
                                                            <a href="#" class="edit btn btn-info btn-sm"
                                                                kode_cabang="{{ $d->kode_cabang }}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="icon icon-tabler icon-tabler-edit">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                    <path
                                                                        d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                                    <path
                                                                        d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                                    <path d="M16 5l3 3" />
                                                                </svg>
                                                                Edit
                                                            </a>

                                                            <form action="/cabang/{{ $d->kode_cabang }}/delete"
                                                                style="margin-left: 5px" method="POST">
                                                                @csrf
                                                                <a class="btn btn-danger btn-sm delete-confirm">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="icon icon-tabler icon-tabler-trash">
                                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                                            fill="none" />
                                                                        <path d="M4 7l16 0" />
                                                                        <path d="M10 11l0 6" />
                                                                        <path d="M14 11l0 6" />
                                                                        <path
                                                                            d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                                        <path
                                                                            d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
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
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal Tambah Data Karyawan --}}
    <div class="modal modal-blur fade" id="modal-inputcabang" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Cabang </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/cabang/store" method="POST" id="formcabang">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <label for="kode_cabang">Kode Cabang</label>
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icon-tabler-barcode">
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
                                    <input type="text" value="" id="kode_cabang" name="kode_cabang"
                                        class="form-control" placeholder="Kode Cabang">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <label for="nama_cabang">Nama Cabang</label>
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icon-tabler-user">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                        </svg>
                                    </span>
                                    <input type="text" value="" id="nama_cabang" name="nama_cabang"
                                        class="form-control" placeholder="Nama Cabang">
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-12">
                                <label for="lokasi_cabang">Lokasi</label>
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-map-pin-check">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                                            <path
                                                d="M11.87 21.48a1.992 1.992 0 0 1 -1.283 -.58l-4.244 -4.243a8 8 0 1 1 13.355 -3.474" />
                                            <path d="M15 19l2 2l4 -4" />
                                        </svg>
                                    </span>
                                    <input type="text" value="" id="lokasi_cabang" name="lokasi_cabang"
                                        class="form-control" placeholder="Lokasi Cabang">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="radius_cabang">Radius</label>
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-radar-2">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                            <path d="M15.51 15.56a5 5 0 1 0 -3.51 1.44" />
                                            <path d="M18.832 17.86a9 9 0 1 0 -6.832 3.14" />
                                            <path d="M12 12v9" />
                                        </svg>
                                    </span>
                                    <input type="text" value="" id="radius_cabang" name="radius_cabang"
                                        class="form-control" placeholder="Radius Cabang">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-12">
                                <div class="form-group">
                                    <button class="btn btn-primary w-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icon-tabler-send">
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
    <div class="modal modal-blur fade" id="modal-editcabang" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Cabang </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="loadeditform">
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
            $("#btnTambahcabang").click(function() {
                $("#modal-inputcabang").modal("show");
            });

            $(".edit").click(function() {
                var kode_cabang = $(this).attr('kode_cabang');
                $.ajax({
                    type: 'POST',
                    url: '/cabang/edit',
                    cache: false,
                    data: {
                        _token: "{{ csrf_token() }}",
                        kode_cabang: kode_cabang
                    },
                    success: function(respond) {
                        $("#loadeditform").html(respond);
                    }
                });

                $("#modal-editcabang").modal("show");
            });

            $(".delete-confirm").click(function(e) {
                var form = $(this).closest('form');
                e.preventDefault();
                Swal.fire({
                    title: "Apakah Anda Yakin?",
                    text: "Data Anda Akan Dihapus!",
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

            $("#formcabang").submit(function() {
                var kode_cabang = $("#kode_cabang").val();
                var nama_cabang = $("#nama_cabang").val();
                var lokasi_cabang = $("#lokasi_cabang").val();
                var radius_cabang = $("#radius_cabang").val();

                if (kode_cabang == "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Kode Cabang Harus Diisi!',
                        icon: 'warning',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        $("#kode_cabang").focus();
                    });
                    return false;
                } else if (nama_cabang == "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Nama Cabang Harus Diisi!',
                        icon: 'warning',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        $("#nama_cabang").focus();
                    });
                    return false;
                } else if (lokasi_cabang == "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Lokasi Cabang Harus Diisi!',
                        icon: 'warning',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        $("#lokasi_cabang").focus();
                    });
                    return false;
                } else if (radius_cabang == "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Radius Cabang Harus Diisi!',
                        icon: 'warning',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        $("#radius_cabang").focus();
                    });
                    return false;
                }
            });
        });
    </script>
@endpush
