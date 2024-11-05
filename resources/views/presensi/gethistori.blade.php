<style>
    .historicontent {
        display: flex;

    }

    .datapresensi {
        margin-left: 10px;
    }
</style>
@if ($histori->isEmpty())
    <div class="alert alert-outline-danger mt-2">
        <p>Data Belum Ada!</p>
    </div>
@else
    @foreach ($histori as $d)
        @php
            $path = Storage::url('uploads/absensi/' . $d->foto_in);
            $tanggal = date('d', strtotime($d->tgl_presensi));
            $bulan = date('n', strtotime($d->tgl_presensi));
            $tahun = date('Y', strtotime($d->tgl_presensi));
            $namaBulan = $namabulan[$bulan];
        @endphp
        @if ($d->status_presensi == 'h')
            <div class="card" style="margin-top: 12px; border: 1px solid rgb(59, 59, 65);">
                <div class="card-body">
                    <div class="historicontent">
                        <div class="iconpresensi">
                            <ion-icon name="finger-print-outline" style="font-size: 40px" class="text-success"></ion-icon>
                        </div>
                        <div class="datapresensi">
                            @php
                                $jamterlambat = selisih('08:00:00', $d->jam_in);
                                [$jam, $menit] = explode(':', $jamterlambat);
                            @endphp
                            <h3 style="line-height: 3px"> {{ $tanggal }} {{ $namaBulan }}
                                {{ $tahun }}</h3>
                            <span>
                                {!! $d->jam_in != null ? date('H:i', strtotime($d->jam_in)) : '<span class="text-danger">Belum Absen</span>' !!}
                            </span>
                            <span>
                                {!! $d->jam_out != null
                                    ? '-' . date('H:i', strtotime($d->jam_out))
                                    : '<span class="text-danger">- Belum Scan</span>' !!}
                            </span>
                            <br>
                            <div id="keterangan">
                                @if ($d->jam_in >= '08:00')
                                    @php
                                        $jamterlambat = selisih('08:00:00', $d->jam_in);
                                        [$jam, $menit] = explode(':', $jamterlambat);
                                    @endphp
                                    <span class="danger">Terlambat
                                        {{ $jam }} jam
                                        {{ $menit }} menit</span>
                                @else
                                    <span style="color: green;">Tepat Waktu</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @elseif ($d->status_presensi == 'i')
            <div class="card" style="margin-top: 12px;border: 1px solid rgb(59, 59, 65)">
                <div class="card-body">
                    <div class="historicontent">
                        <div class="iconpresensi">
                            <svg xmlns="http://www.w3.org/2000/svg" width="52" height="52" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-file-description">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                <path d="M9 17h6" />
                                <path d="M9 13h6" />
                            </svg>
                        </div>
                        <div class="datapresensi">

                            <h3 style="line-height: 3px"> IZIN - {{ $d->izin_id }} </h3>
                            <h4 style="margin: 0;">
                                {{ $tanggal }} {{ $namaBulan }}
                                {{ $tahun }}
                            </h4>
                            ket: <span style="color: green;">{{ $d->keterangan }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @elseif ($d->status_presensi == 's')
            <div class="card" style="margin-top: 12px; border: 1px solid rgb(59, 59, 65)">
                <div class="card-body">
                    <div class="historicontent">
                        <div class="iconpresensi">
                            <svg xmlns="http://www.w3.org/2000/svg" width="52" height="52" viewBox="0 0 24 24"
                                fill="none" stroke="#910808" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-first-aid-kit">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M8 8v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2" />
                                <path
                                    d="M4 8m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                                <path d="M10 14h4" />
                                <path d="M12 12v4" />
                            </svg>
                        </div>
                        <div class="datapresensi">

                            <h3 style="line-height: 3px"> SAKIT - {{ $d->izin_id }} </h3>
                            <h4 style="margin: 0;">{{ $tanggal }}
                                {{ $namaBulan }} {{ $tahun }}</h4>
                            ket: <span style="color: green;">{{ $d->keterangan }}</span>
                            <br>
                            @php
                                $path = Storage::url('uploads/izin/' . $d->foto_izin);
                            @endphp
                            @if (!empty($d->foto_izin))
                                <a href="{{ url($path) }}" target="_blank" style="color: blue; margin-top:2px">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                        viewBox="0 0 24 24" fill="none" stroke="#0a57a4" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-paperclip">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M15 7l-6.5 6.5a1.5 1.5 0 0 0 3 3l6.5 -6.5a3 3 0 0 0 -6 -6l-6.5 6.5a4.5 4.5 0 0 0 9 9l6.5 -6.5" />
                                    </svg> Lampiran Dokter
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @elseif ($d->status_presensi == 'c')
            <div class="card" style="margin-top: 12px; border: 1px solid rgb(59, 59, 65)">
                <div class="card-body">
                    <div class="historicontent">
                        <div class="iconpresensi">
                            <svg xmlns="http://www.w3.org/2000/svg" width="52" height="52" viewBox="0 0 24 24"
                                fill="none" stroke="#0b7f77" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-beach">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M17.553 16.75a7.5 7.5 0 0 0 -10.606 0" />
                                <path d="M18 3.804a6 6 0 0 0 -8.196 2.196l10.392 6a6 6 0 0 0 -2.196 -8.196z" />
                                <path
                                    d="M16.732 10c1.658 -2.87 2.225 -5.644 1.268 -6.196c-.957 -.552 -3.075 1.326 -4.732 4.196" />
                                <path d="M15 9l-3 5.196" />
                                <path
                                    d="M3 19.25a2.4 2.4 0 0 1 1 -.25a2.4 2.4 0 0 1 2 1a2.4 2.4 0 0 0 2 1a2.4 2.4 0 0 0 2 -1a2.4 2.4 0 0 1 2 -1a2.4 2.4 0 0 1 2 1a2.4 2.4 0 0 0 2 1a2.4 2.4 0 0 0 2 -1a2.4 2.4 0 0 1 2 -1a2.4 2.4 0 0 1 1 .25" />
                            </svg>
                        </div>
                        <div class="datapresensi">

                            <h3 style="line-height: 3px"> CUTI - {{ $d->izin_id }} </h3>
                            <h4 style="margin: 0;">
                                {{ $tanggal }} {{ $namaBulan }}
                                {{ $tahun }}
                            </h4>
                            <span style="color: #21aaaf">
                                Cuti :{{ $d->nama_cuti }}
                            </span>
                            <br>
                            ket: <span style="color: green;">{{ $d->keterangan }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
@endif
