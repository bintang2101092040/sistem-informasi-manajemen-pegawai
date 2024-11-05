@extends('layouts.presensi')

@section('header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
    <style>
        .datepicker-modal {
            max-height: 480px !important;
        }

        .datepicker-date-display {
            background-color: rgb(72, 72, 90) !important;
        }

        #keterangan {
            height: 5rem !important;
        }
    </style>
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="/presensi/izin" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class='pageTitle'>Form Izin Absen</div>
        <div class="right"></div>
    </div>
@endsection

@section('content')
    @php
        $messagesuccess = Session::get('success');
        $messageerror = Session::get('error');
    @endphp
    <div class="row" style="margin-top: 70px">
        <div class="col">
            @if (Session::get('success'))
                <div class="alert alert-success">
                    {{ $messagesuccess }}
                </div>
            @endif
            @if (Session::get('error'))
                <div class="alert alert-danger">
                    {{ $messageerror }}
                </div>
            @endif
            <form method="POST" action="/izinabsen/store" id="formIzin" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="text" id="tgl_izin_dari" name="tgl_izin_dari" class="form-control datepicker"
                        placeholder="Dari Tanggal" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="text" id="tgl_izin_sampai" name="tgl_izin_sampai" class="form-control datepicker"
                        placeholder="Sampai Tanggal" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="text" id="jml_hari" name="jml_hari" class="form-control " placeholder="Jumlah Hari"
                        autocomplete="off" readonly>
                </div>

                <div class="form-group">
                    <label for="">Keterangan</label>
                    <input name="keterangan" id="keterangan" class="form-control" placeholder="Keterangan"></input>
                </div>
                {{-- <div class="form-group">
                    <label for="foto_izin">Lampiran Dokter</label>
                    <input type="file" name="foto_izin" id="foto_izin" class="form-control">
                </div> --}}
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


            function loadjumlahhari() {
                var dari = $("#tgl_izin_dari").val();
                var sampai = $("#tgl_izin_sampai").val();
                var date1 = new Date(dari);
                var date2 = new Date(sampai);

                var Difference_In_Time = date2.getTime() - date1.getTime();

                var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);

                if (dari == "" || sampai == "") {
                    var jmlhari = 0;
                } else {

                    var jmlhari = Difference_In_Days + 1;
                }

                $("#jml_hari").val(jmlhari + " Hari");

            }
            $("#tgl_izin_dari,#tgl_izin_sampai").change(function(e) {
                loadjumlahhari();
            });




            // $("#tgl_izin").change(function(e) {

            //     var tgl_izin = $("#tgl_izin").val();
            //     $.ajax({
            //         type: 'POST',
            //         url: '/presensi/cekpengajuanizin',
            //         data: {
            //             _token: "{{ csrf_token() }}",
            //             tgl_izin: tgl_izin
            //         },
            //         cache: false,
            //         success: function(respond) {
            //             if (respond == 1) {
            //                 Swal.fire({
            //                     title: 'Ooops !',
            //                     text: 'Anda Sudah Melakukan Input Pada Tanggal',
            //                     icon: 'warning',
            //                 }).then((result) => {
            //                     $("#tgl_izin").val("");
            //                 });
            //             }
            //         }
            //     });
            // });

            $("#formIzin").submit(function() {
                var tgl_izin_dari = $("#tgl_izin_dari").val();
                var tgl_izin_sampai = $("#tgl_izin_sampai").val();

                var keterangan = $("#keterangan").val();
                if (tgl_izin_dari == "" || tgl_izin_sampai == "") {
                    Swal.fire({
                        title: 'Ooops !',
                        text: 'Tanggal Harus Diisi',
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
