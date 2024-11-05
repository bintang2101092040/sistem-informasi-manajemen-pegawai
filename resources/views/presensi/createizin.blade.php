@extends('layouts.presensi')

@section('header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
    <style>
        .datepicker-modal {
            max-height: 430px !important;
        }
    </style>
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="/presensi/izin" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class='pageTitle'>Form Izin</div>
        <div class="right"></div>
    </div>
@endsection

@section('content')
    <div class="row" style="margin-top: 70px">
        <div class="col">
            <form method="POST" action="/presensi/storeizin" id="formIzin" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="text" id="tgl_izin" name="tgl_izin" class="form-control datepicker"
                        placeholder="Tanggal" autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="">Status</label>
                    <select name="status_izin" id="status_izin" class="form-control">
                        <option value="">Izin / Sakit</option>
                        <option value="i">Izin</option>
                        <option value="s">Sakit</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" class="form-control" cols="30" rows="5" placeholder="Keterangan"></textarea>
                </div>
                <div class="form-group">
                    <label for="foto_izin">Lampiran Dokter</label>
                    <input type="file" name="foto_izin" id="foto_izin" class="form-control">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary w-100">Kirim</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('myscript')
    <script>
        var currYear = (new Date()).getFullYear();

        $(document).ready(function() {
            $(".datepicker").datepicker({

                format: "yyyy-mm-dd"
            });

            $("#tgl_izin").change(function(e) {

                var tgl_izin = $("#tgl_izin").val();
                $.ajax({
                    type: 'POST',
                    url: '/presensi/cekpengajuanizin',
                    data: {
                        _token: "{{ csrf_token() }}",
                        tgl_izin: tgl_izin
                    },
                    cache: false,
                    success: function(respond) {
                        if (respond == 1) {
                            Swal.fire({
                                title: 'Ooops !',
                                text: 'Anda Sudah Melakukan Input Pada Tanggal',
                                icon: 'warning',
                            }).then((result) => {
                                $("#tgl_izin").val("");
                            });
                        }
                    }
                });
            });

            $("#formIzin").submit(function() {
                var tgl_izin = $("#tgl_izin").val();
                var status_izin = $("#status_izin").val();
                var keterangan = $("#keterangan").val();
                if (tgl_izin == "") {
                    Swal.fire({
                        title: 'Ooops !',
                        text: 'Tanggal Harus Diisi',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    });
                    return false;
                } else if (status_izin == "") {
                    Swal.fire({
                        title: 'Ooops !',
                        text: 'Status Harus Diisi',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    });
                    return false;
                } else if (keterangan == "") {
                    Swal.fire({
                        title: 'Ooops !',
                        text: 'Keterangan Harus Diisi',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    });
                    return false;
                }
            });
        });
    </script>
@endpush
