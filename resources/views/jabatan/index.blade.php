@extends('layouts/admin/tabler')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Data Jabatan
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
                                    <a href="#" class="btn btn-primary" id="btnTambahjabatan">
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
                                                <th>Nama Jabatan</th>
                                                <th>Gaji Pokok</th>
                                                <th>Tunjangan Tetap</th>
                                                <th>Tunjangan Tidak Tetap</th>
                                                <th>BPJS Ketenagakerjaan</th>
                                                <th>BPJS Kesehatan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($jabatan as $d)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $d->nama_jabatan }}</td>
                                                    <td>Rp. {{ number_format($d->gaji_pokok, 0, ',', '.') }}</td>
                                                    <td>Rp. {{ number_format($d->tunjangan_tetap, 0, ',', '.') }}</td>
                                                    <td>Rp. {{ number_format($d->tunjangan_tidak_tetap, 0, ',', '.') }}</td>
                                                    <td>Rp. {{ number_format($d->gaji_bpjs_ketenagakerjaan, 0, ',', '.') }}
                                                    </td>
                                                    <td>Rp. {{ number_format($d->gaji_bpjs_kesehatan, 0, ',', '.') }}</td>
                                                    <td class="action-column">
                                                        <div class="btn-group">
                                                            <a href="#" class="edit btn btn-info btn-sm"
                                                                nama_jabatan="{{ $d->nama_jabatan }}">
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

                                                            <form action="/jabatan/{{ $d->nama_jabatan }}/delete"
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
    <div class="modal modal-blur fade" id="modal-inputjabatan" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Jabatan </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/jabatan/store" method="POST" id="formjabatan">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <label for="nama_jabatan">Nama Jabatan</label>
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
                                    <input type="text" value="" id="nama_jabatan" name="nama_jabatan"
                                        class="form-control" placeholder="Nama Jabatan">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <label for="gaji_pokok">Gaji Pokok</label>
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-coin">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                            <path
                                                d="M14.8 9a2 2 0 0 0 -1.8 -1h-2a2 2 0 1 0 0 4h2a2 2 0 1 1 0 4h-2a2 2 0 0 1 -1.8 -1" />
                                            <path d="M12 7v10" />
                                        </svg>
                                    </span>
                                    <input type="text" value="" id="gaji_pokok" name="gaji_pokok"
                                        class="form-control currency" placeholder="Gaji Pokok">
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-12">
                                <label for="tunjangan_tetap">Tunjangan Tetap</label>
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-coin">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                            <path
                                                d="M14.8 9a2 2 0 0 0 -1.8 -1h-2a2 2 0 1 0 0 4h2a2 2 0 1 1 0 4h-2a2 2 0 0 1 -1.8 -1" />
                                            <path d="M12 7v10" />
                                        </svg>
                                    </span>
                                    <input type="text" value="" id="tunjangan_tetap" name="tunjangan_tetap"
                                        class="form-control currency" placeholder="Tunjangan Tetap">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="tunjangan_tidak_tetap">Tunjangan Tidak Tetap</label>
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-coin">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                            <path
                                                d="M14.8 9a2 2 0 0 0 -1.8 -1h-2a2 2 0 1 0 0 4h2a2 2 0 1 1 0 4h-2a2 2 0 0 1 -1.8 -1" />
                                            <path d="M12 7v10" />
                                        </svg>
                                    </span>
                                    <input type="text" value="" id="tunjangan_tidak_tetap"
                                        name="tunjangan_tidak_tetap" class="form-control currency"
                                        placeholder="Tunjangan Tidak Tetap">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="gaji_bpjs_ketenagakerjaan">BPJS Ketenagakerjaan</label>
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-coin">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                            <path
                                                d="M14.8 9a2 2 0 0 0 -1.8 -1h-2a2 2 0 1 0 0 4h2a2 2 0 1 1 0 4h-2a2 2 0 0 1 -1.8 -1" />
                                            <path d="M12 7v10" />
                                        </svg>
                                    </span>
                                    <input type="text" value="" id="gaji_bpjs_ketenagakerjaan"
                                        name="gaji_bpjs_ketenagakerjaan" class="form-control currency"
                                        placeholder="BPJS Ketenagakerjaan">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="gaji_bpjs_kesehatan">BPJS Kesehatan</label>
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-coin">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                            <path
                                                d="M14.8 9a2 2 0 0 0 -1.8 -1h-2a2 2 0 1 0 0 4h2a2 2 0 1 1 0 4h-2a2 2 0 0 1 -1.8 -1" />
                                            <path d="M12 7v10" />
                                        </svg>
                                    </span>
                                    <input type="text" value="" id="gaji_bpjs_kesehatan"
                                        name="gaji_bpjs_kesehatan" class="form-control currency"
                                        placeholder="BPJS Kesehatan">
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
    <div class="modal modal-blur fade" id="modal-editjabatan" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Jabatan </h5>
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
            $("#btnTambahjabatan").click(function() {
                $("#modal-inputjabatan").modal("show");
            });

            $(".edit").click(function() {
                var nama_jabatan = $(this).attr('nama_jabatan');
                $.ajax({
                    type: 'POST',
                    url: '/jabatan/edit',
                    cache: false,
                    data: {
                        _token: "{{ csrf_token() }}",
                        nama_jabatan: nama_jabatan
                    },
                    success: function(respond) {
                        $("#loadeditform").html(respond);
                    }
                });

                $("#modal-editjabatan").modal("show");
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

            $("#formjabatan").submit(function() {
                var nama_jabatan = $("#nama_jabatan").val();
                var gaji_pokok = $("#gaji_pokok").val();
                var tunjangan_tetap = $("#tunjangan_tetap").val();
                var gaji_bpjs_ketenagakerjaan = $("#gaji_bpjs_ketenagakerjaan").val();
                var gaji_bpjs_kesehatan = $("#gaji_bpjs_kesehatan").val();

                if (nama_jabatan == "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Nama Jabatan Harus Diisi!',
                        icon: 'warning',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        $("#nama_jabatan").focus();
                    });
                    return false;
                } else if (gaji_pokok == "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Gaji Pokok Harus Diisi!',
                        icon: 'warning',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        $("#gaji_pokok").focus();
                    });
                    return false;
                } else if (tunjangan_tetap == "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Tunjangan Tetap Harus Diisi!',
                        icon: 'warning',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        $("#tunjangan_tetap").focus();
                    });
                    return false;
                } else if (gaji_bpjs_ketenagakerjaan == "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'BPJS Ketenagakerjaan Harus Diisi!',
                        icon: 'warning',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        $("#gaji_bpjs_ketenagakerjaan").focus();
                    });
                    return false;
                } else if (gaji_bpjs_kesehatan == "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'BPJS Kesehatan Harus Diisi!',
                        icon: 'warning',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        $("#gaji_bpjs_kesehatan").focus();
                    });
                    return false;
                }
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            const currencyInputs = document.querySelectorAll('.currency');

            currencyInputs.forEach(input => {
                // Format input saat pengguna mengetik
                input.addEventListener('input', function(e) {
                    let value = e.target.value.replace(/\D/g, ''); // Hapus karakter non-digit
                    if (value) {
                        const formattedValue = new Intl.NumberFormat('id-ID').format(
                        value); // Format mata uang
                        e.target.value = formattedValue;
                    }
                });

                // Format ulang nilai saat form disubmit
                input.form.addEventListener('submit', function() {
                    let rawValue = input.value.replace(/[^\d]/g,
                    ''); // Hapus semua karakter non-digit
                    input.value = rawValue; // Set nilai mentah kembali ke input
                });
            });
        });
    </script>
@endpush
