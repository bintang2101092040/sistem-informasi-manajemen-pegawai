@foreach ($presensi as $d)
    @php
        $foto_in = Storage::url('uploads/absensi/' . $d->foto_in);
        $foto_out = Storage::url('uploads/absensi/' . $d->foto_out);
    @endphp
    @if ($d->status_presensi == 'h')
        <tr>
            <td>{{ $loop->iteration }}</td> <!-- Kolom No -->
            <td>{{ $d->nik }}</td>
            <td>{{ $d->nama_lengkap }}</td>
            <td>{{ $d->nama_jabatan }}</td>
            <td>{{ $d->jam_in }}</td>
            <td>
                <a href="{{ $foto_in }}" data-lightbox="image-{{ $d->id }}"
                    data-title="Foto Masuk {{ $d->nama_lengkap }}">
                    <img src="{{ $foto_in }}" alt="" class="avatar">
                </a>
            </td>
            <td>{!! $d->jam_out != null
                ? $d->jam_out
                : '<span class="badge bg-danger" style="color: white;">Belum Absen Pulang</span>' !!}</td>
            <td>
                @if ($d->jam_out != null)
                    <a href="{{ $foto_out }}" data-lightbox="image-{{ $d->id }}"
                        data-title="Foto Pulang {{ $d->nama_lengkap }}">
                        <img src="{{ $foto_out }}" alt="" class="avatar">
                    </a>
                @else
                    No Image
                @endif
            </td>
            <td>Hadir</td>
            <td>
                @if ($d->jam_in >= '08:00')
                    @php
                        $jamterlambat = selisih('08:00:00', $d->jam_in);
                        [$jam, $menit] = explode(':', $jamterlambat);
                    @endphp
                    <span class="badge bg-danger" style="color: white;">Terlambat : {{ $jam }} jam
                        {{ $menit }} menit</span>
                @else
                    <span class="badge bg-success" style="color: white;">Tepat Waktu</span>
                @endif
            </td>
            <td>
                <a href="#" class="btn btn-primary tampilkanpeta" id="{{ $d->id }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-map-pin">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                        <path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z" />
                    </svg>
                </a>
            </td>
        </tr>
    @else
        <tr>
            <td>{{ $loop->iteration }}</td> <!-- Kolom No -->
            <td>{{ $d->nik }}</td>
            <td>{{ $d->nama_lengkap }}</td>
            <td>{{ $d->nama_jabatan }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>
                @if ($d->status_presensi == 'i')
                    <span class="badge bg-warning" style="color: whitesmoke">Izin</span>
                @elseif ($d->status_presensi == 's')
                    <span class="badge bg-danger" style="color: whitesmoke">Sakit</span>
                @elseif ($d->status_presensi == 'c')
                    <span class="badge bg-info" style="color: whitesmoke">Cuti</span>
                @else
                    {{ $d->status_presensi }}
                @endif
            </td>
            <td>{{ $d->keterangan }}</td>
            <td></td>
        </tr>
    @endif
@endforeach

<!-- Include Lightbox2 CSS and JS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

<style>
    .lightbox .lb-close {
        top: 10px;
        /* Sesuaikan nilai sesuai kebutuhan */
        right: 10px;
        /* Sesuaikan nilai sesuai kebutuhan */
        bottom: auto;
    }
</style>

<script>
    $(function() {
        $(".tampilkanpeta").click(function() {
            var id = $(this).attr('id');
            $.ajax({
                type: 'POST',
                url: '/tampilkanpeta',
                cache: false,
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                },
                success: function(respond) {
                    $("#loadpeta").html(respond);
                }
            });

            $("#modal-tampilkanpeta").modal("show");
        });
    });
</script>
