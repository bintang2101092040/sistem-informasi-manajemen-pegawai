@extends('layouts.presensi')
@section('header')
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="/dashboard" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Presensi</div>
        <div class="right"></div>
    </div>

    <style>
        .webcam-capture,
        .webcam-capture video {
            display: inline-block;
            width: 100% !important;
            height: auto !important;
            margin: auto;
            border-radius: 15px;
        }

        #map {
            height: 180px;
        }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
@endsection

@section('content')
    <div class="row" style="margin-top: 70px">
        <div class="col">
            <input type="hidden" id="lokasi">
            <div class="webcam-capture">

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            @if ($sudahAbsenPulang || $sudahAbsen)
                <button id="takeabsen" class="btn btn-secondary btn-block btn-lg" disabled>
                    <ion-icon name="warning-outline"></ion-icon>
                    Anda Sudah absen !!!
                </button>
            @else
                @if ($cek > 0)
                    <button id="takeabsen" class="btn btn-danger btn-block">
                        <ion-icon name="camera-outline"></ion-icon>
                        Absen Pulang
                    </button>
                @else
                    <button id="takeabsen" class="btn btn-primary btn-block">
                        <ion-icon name="camera-outline"></ion-icon>
                        Absen Masuk
                    </button>
                @endif
            @endif
        </div>
    </div>
    <div class="row mt-2">
        <div class="col">
            <div id="map"></div>
        </div>
    </div>
@endsection

@push('myscript')
    <script>
        Webcam.set({
            height: 480,
            width: 640,
            image_format: 'jpeg',
            jpeg_quality: 80
        });

        Webcam.attach('.webcam-capture');

        var lokasi = document.getElementById('lokasi');
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(succesCallback, errorCallback);
        }

        function succesCallback(position) {
            lokasi.value = position.coords.latitude + "," + position.coords.longitude;
            var map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 15);
            var lokasi_cabang = "{{ $lok_kantor->lokasi_cabang }}";
            var lok = lokasi_cabang.split(",");
            var lat_kantor = lok[0];
            var long_kantor = lok[1];
            var radius = "{{ $lok_kantor->radius_cabang }}";
            L.tileLayer('http://{s}.google.com/vt?lyrs=m&x={x}&y={y}&z={z}', {
                maxZoom: 19,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            }).addTo(map);

            var marker = L.marker([position.coords.latitude, position.coords.longitude]).addTo(map);

            var circle = L.circle([lat_kantor, long_kantor], {
                color: 'red',
                fillColor: '#f03',
                fillOpacity: 0.5,
                radius: radius
            }).addTo(map);
        }

        function errorCallback() {

        }

        navigator.geolocation.getCurrentPosition(succesCallback, errorCallback, {
            enableHighAccuracy: true
        });


        $("#takeabsen").click(function(e) {
            Webcam.snap(function(uri) {
                image = uri;
            });


            var lokasi = $("#lokasi").val();

            $.ajax({
                type: 'POST',
                url: '/presensi/store',
                data: {
                    _token: "{{ csrf_token() }}",
                    image: image,
                    lokasi: lokasi
                },
                cache: false,
                success: function(respond) {
                    var status = respond.split("|");
                    if (status[0] == "success") {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: status[1],
                            icon: 'success',
                            confirmButtonText: 'OK'
                        })
                        setTimeout("location.href='/dashboard'", 3000);
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: status[1],
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }

                }
            });
        });
    </script>
@endpush
