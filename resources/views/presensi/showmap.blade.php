<!DOCTYPE html>
<html>

<head>
    <title>Geolocation Example</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <style>
        #map_in,
        #map_out {
            height: 290px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body style=" font-family: Arial, sans-serif;">

    {{ $presensi->nama_lengkap }}
    <br><br>
    <b
        style="font-size: 24px; font-weight: bold; color: #0eb40e; margin: 20px 0 10px; display: block; text-align: center;">Absen
        Masuk</b>
    <div id="map_in"></div>
    <b
        style="font-size: 24px; font-weight: bold; color: #9e1515; margin: 20px 0 10px; display: block; text-align: center;">Absen
        Pulang</b>
    <div id="map_out"></div>

    <script>
        function createMap(divId, latitude, longitude, lat_kantor, long_kantor, radius, content) {
            var map = L.map(divId).setView([latitude, longitude], 18);
            L.tileLayer('http://{s}.google.com/vt?lyrs=m&x={x}&y={y}&z={z}', {
                maxZoom: 19,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            }).addTo(map);

            L.marker([latitude, longitude]).addTo(map);



            L.popup()
                .setLatLng([latitude, longitude])
                .setContent(content)
                .openOn(map);
        }

        var lokasi_in = "{{ $presensi->lokasi_in }}".split(",");
        var lokasi_out = "{{ $presensi->lokasi_out }}".split(",");
        var lokasi_kantor = "{{ $lok_kantor->lokasi_kantor }}".split(",");
        var radius = "{{ $lok_kantor->radius }}";

        var lat_kantor = lokasi_kantor[0];
        var long_kantor = lokasi_kantor[1];

        createMap('map_in', lokasi_in[0], lokasi_in[1], lat_kantor, long_kantor, radius,
            "{{ $presensi->nama_lengkap }} - Absen Masuk");
        createMap('map_out', lokasi_out[0], lokasi_out[1], lat_kantor, long_kantor, radius,
            "{{ $presensi->nama_lengkap }} - Absen Pulang");
    </script>

</body>

</html>
