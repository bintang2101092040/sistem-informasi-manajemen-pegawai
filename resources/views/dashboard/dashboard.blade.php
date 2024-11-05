@extends('layouts.presensi')

@section('content')
    <style>
        .logout {
            position: absolute;
            color: #FFFFE0;
            font-size: 30px;
            text-decoration: none;
            right: 20px;
        }

        .logout:hover {
            color: #FFFFE0;
        }
    </style>

    <div class="section" id="user-section">
        <a href="/proseslogout" class="logout">
            <ion-icon name="exit-outline"></ion-icon>
        </a>
        <div id="user-detail">
            <div class="avatar">
                @if (!empty(Auth::guard('karyawan')->user()->foto))
                    @php
                        $path = Storage::url('uploads/karyawan/' . Auth::guard('karyawan')->user()->foto);
                        $namabulan = [
                            1 => 'Januari',
                            2 => 'Februari',
                            3 => 'Maret',
                            4 => 'April',
                            5 => 'Mei',
                            6 => 'Juni',
                            7 => 'Juli',
                            8 => 'Agustus',
                            9 => 'September',
                            10 => 'Oktober',
                            11 => 'November',
                            12 => 'Desember',
                        ];
                    @endphp
                    <img src="{{ url($path) }}" alt="avatar" class="imaged w64 " style="height: 60px width: 70px;">
                @else
                    <img src="assets/img/sample/avatar/avatar1.jpg" alt="avatar" class="imaged w64 ">
                @endif

            </div>
            <div id="user-info">
                <h2 id="user-name">{{ Auth::guard('karyawan')->user()->nama_lengkap }}</h2>
                <span id="user-role" style="color: #FFFFE0;">{{ Auth::guard('karyawan')->user()->nama_jabatan }}</span>
            </div>
        </div>
    </div>

    <div class="section" id="menu-section">
        <div class="card">
            <div class="card-body text-center" style=" border-radius: 10px;">
                <div class="list-menu">
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="/editprofile" class="green" style="font-size: 40px;">
                                <ion-icon name="person-sharp"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Profil</span>
                        </div>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="/presensi/izin" class="danger" style="font-size: 40px;">
                                <ion-icon name="calendar-number"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Cuti</span>
                        </div>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="/presensi/histori" class="warning" style="font-size: 40px;">
                                <ion-icon name="document-text"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Histori</span>
                        </div>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="" class="orange" style="font-size: 40px;">
                                <ion-icon name="location"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            Lokasi
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section mt-2" id="presence-section">
        <div class="todaypresence">
            <div class="row">
                <div class="col-6">
                    <div class="card gradasigreen">
                        <div class="card-body">
                            <div class="presencecontent">
                                <div class="iconpresence">
                                    @if ($presensihariini != null)
                                        @php
                                            $path = Storage::url('public/uploads/absensi/') . $presensihariini->foto_in;
                                        @endphp
                                        <img src={{ url($path) }} alt="" class="imaged w64 ">
                                    @else
                                        <ion-icon name="camera"></ion-icon>
                                    @endif
                                </div>
                                <div class="presencedetail">
                                    <h4 class="presencetitle">Masuk</h4>
                                    <span>{{ $presensihariini != null ? $presensihariini->jam_in : 'Belum Absen' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card gradasired">
                        <div class="card-body">
                            <div class="presencecontent">
                                <div class="iconpresence">
                                    @if ($presensihariini != null && $presensihariini->jam_out != null)
                                        @php
                                            $path =
                                                Storage::url('public/uploads/absensi/') . $presensihariini->foto_out;
                                        @endphp
                                        <img src={{ url($path) }} alt="" class="imaged w64 ">
                                    @else
                                        <ion-icon name="camera"></ion-icon>
                                    @endif
                                </div>
                                <div class="presencedetail">
                                    <h4 class="presencetitle">Pulang</h4>
                                    <span>{{ $presensihariini != null && $presensihariini->jam_out != null ? $presensihariini->jam_out : 'Belum Absen' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="rekappresensi">
            <h3>Rekap presensi {{ $namabulan[$bulanini] }} {{ $tahunini }}</h3>
            <div class="row">
                <div class="col-3">
                    <a href="/presensi/histori">
                        <div class="card">
                            <div class="card-body text-center" style="padding : 12px 12px !important; line-height:0.8rem">
                                <span class="badge bg-danger"
                                    style="position: absolute; top:3px; right:10px; font-size:0.6rem; z-index:999">{{ $rekappresensi->jmlhadir }}</span>
                                <ion-icon name="accessibility-outline" style="font-size: 1.6rem"
                                    class="text-primary mb-1"></ion-icon>
                                <br>
                                <span style="font-size: 0.8rem; font-weight:500">Hadir</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center" style="padding : 12px 12px !important; line-height:0.8rem">
                            <span class="badge bg-danger"
                                style="position: absolute; top:3px; right:10px; font-size:0.6rem; z-index:999">{{ $rekapizin->jmlizin != null ? $rekapizin->jmlizin : 0 }}</span>
                            <ion-icon name="newspaper-outline" style="font-size: 1.6rem"
                                class="text-success mb-1"></ion-icon>
                            <br>
                            <span style="font-size: 0.8rem; font-weight:500">Izin</span>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center" style="padding : 12px 12px !important; line-height:0.8rem">
                            <span class="badge bg-danger"
                                style="position: absolute; top:3px; right:10px; font-size:0.6rem; z-index:999">{{ $rekapizin->jmlsakit != null ? $rekapizin->jmlsakit : 0 }}</span>
                            <ion-icon name="medkit-outline" style="font-size: 1.6rem"
                                class="text-warning mb-1"></ion-icon>
                            <br>
                            <span style="font-size: 0.8rem; font-weight:500">Sakit</span>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center" style="padding : 12px 12px !important; line-height:0.8rem">
                            <span class="badge bg-danger"
                                style="position: absolute; top:3px; right:10px; font-size:0.6rem; z-index:999">{{ $rekappresensi->jmlterlambat != null ? $rekappresensi->jmlterlambat : 0 }}</span>
                            <ion-icon name="alarm-outline" style="font-size: 1.6rem" class="text-danger mb-1"></ion-icon>
                            <br>
                            <span style="font-size: 0.8rem; font-weight:500">Telat</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="presencetab mt-2">
            <div class="tab-pane fade show active" id="pilled" role="tabpanel">
                <ul class="nav nav-tabs style1" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#home" role="tab">
                            Bulan Ini
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#profile" role="tab">
                            Leaderboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#sakit" role="tab">
                            Karyawan izin/sakit
                        </a>
                    </li>
                </ul>
            </div>
            <div class="tab-content mt-2" style="margin-bottom:100px;">
                <div class="tab-pane fade show active" id="home" role="tabpanel">


                    {{--

                        <ul class="listview image-listview">
                        @foreach ($historibulanini as $d)
                            @php
                                $path = Storage::url('uploads/absensi/' . $d->foto_in);
                                $tanggal = date('d', strtotime($d->tgl_presensi));
                                $bulan = date('n', strtotime($d->tgl_presensi));
                                $tahun = date('Y', strtotime($d->tgl_presensi));
                                $namaBulan = $namabulan[$bulan];
                            @endphp
                            <li>
                                <div class="item">
                                    <div class="icon-box bg-primary">
                                        <ion-icon name="finger-print-outline"></ion-icon>
                                    </div>
                                    <div class="in">
                                        <div>{{ $tanggal }} {{ $namaBulan }} {{ $tahun }}</div>
                                        <span class="badge badge-success">{{ $d->jam_in }}</span>
                                        <span
                                            class="badge badge-danger">{{ $presensihariini != null && $d->jam_out != null ? $d->jam_out : 'Belum Scan' }}</span>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    --}}

                    <style>
                        .historicontent {
                            display: flex;

                        }

                        .datapresensi {
                            margin-left: 10px;
                        }
                    </style>

                    @foreach ($historibulanini as $d)
                        @php
                            $path = Storage::url('uploads/absensi/' . $d->foto_in);
                            $tanggal = date('d', strtotime($d->tgl_presensi));
                            $bulan = date('n', strtotime($d->tgl_presensi));
                            $tahun = date('Y', strtotime($d->tgl_presensi));
                            $namaBulan = $namabulan[$bulan];
                        @endphp
                        @if ($d->status_presensi == 'h')
                            <div class="card" style="margin-top: 12px; border: 1px solid rgb(59, 59, 65)">
                                <div class="card-body">
                                    <div class="historicontent">
                                        <div class="iconpresensi">
                                            <ion-icon name="finger-print-outline" style="font-size: 40px"
                                                class="text-success"></ion-icon>
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
                                            <svg xmlns="http://www.w3.org/2000/svg" width="52" height="52"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-file-description">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                                <path
                                                    d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
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
                                            <svg xmlns="http://www.w3.org/2000/svg" width="52" height="52"
                                                viewBox="0 0 24 24" fill="none" stroke="#910808" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
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
                                                <a href="{{ url($path) }}" target="_blank"
                                                    style="color: blue; margin-top:2px">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                        viewBox="0 0 24 24" fill="none" stroke="#0a57a4"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
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
                                            <svg xmlns="http://www.w3.org/2000/svg" width="52" height="52"
                                                viewBox="0 0 24 24" fill="none" stroke="#0b7f77" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-beach">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M17.553 16.75a7.5 7.5 0 0 0 -10.606 0" />
                                                <path
                                                    d="M18 3.804a6 6 0 0 0 -8.196 2.196l10.392 6a6 6 0 0 0 -2.196 -8.196z" />
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
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel">
                    <ul class="listview image-listview">

                        @foreach ($leaderboard as $d)
                            <li>
                                <div class="item">
                                    <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                                    <div class="in">
                                        <div>
                                            <b>{{ $d->nama_lengkap }}</b><br>
                                            <small class="text-muted">{{ $d->nama_jabatan }}</small>
                                        </div>
                                        <span class="badge {{ $d->jam_in < '08:00' ? 'bg-success' : 'bg-danger' }}">
                                            {{ $d->jam_in }}
                                        </span>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="tab-pane fade" id="sakit" role="tabpanel">
                    <ul class="listview image-listview">

                        @foreach ($karyawansakit as $d)
                            <li>
                                <div class="item">
                                    <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                                    <div class="in">
                                        <div>
                                            <b>{{ $d->nama_lengkap }}</b><br>
                                            <small class="text-muted">{{ $d->nama_jabatan }}</small>
                                        </div>

                                        <span style="font-weight: bold; font-style: italic;">
                                            {{ $d->status_presensi == 's' ? 'Sakit' : ($d->status_presensi == 'c' ? 'Cuti' : 'Izin') }}

                                        </span>
                                        <span style="font-weight: bold; font-style: italic;">
                                            {{ tanggalIndo($d->tgl_presensi) }}
                                        </span>
                                    </div>
                                </div>
                            </li>
                        @endforeach


                    </ul>
                </div>

            </div>
        </div>
    </div>
@endsection
