<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>A4</title>

    <!-- Normalize or reset CSS with your favorite library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

    <!-- Load paper.css for happy printing -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

    <!-- Set page size here: A5, A4 or A3 -->
    <!-- Set also "landscape" if you need -->
    <style>
        @page {
            size: A4
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        #title {
            font-size: 20px;
            font-weight: bold;
        }

        .tabeldatakaryawan {
            margin-top: 40px;
        }

        .tabeldatakaryawan td {
            padding: 5px;
        }

        .tabelpresensi {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .tabelpresensi th,
        .tabelpresensi td {
            border: 1px solid #141313;
            padding: 8px;
            font-size: 13px;
        }

        .tabelpresensi th {
            background: #bbb9b9;
        }

        .foto {
            width: 40px;
            height: 40px;
        }

        .signature {
            /* position: absolute; */
            bottom: 10mm;
            width: 100%;
            text-align: center;
        }

        .signature td {
            font-size: 18px;
            vertical-align: bottom;
        }

        body.A4 .sheet {

            height: auto;
        }
    </style>
</head>

<body class="A4">

    @if ($presensi->isEmpty())

        <body
            style="display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; font-family: Arial, sans-serif;">
            <div
                style="text-align: center; padding: 20px; border: 1px solid #ccc; background-color: #f2f2f2; max-width: 80%;">
                <h3>Tidak ada data presensi {{ ucwords(strtolower($karyawan->nama_lengkap)) }} untuk bulan ini.</h3>
            </div>
        </body>
    @else
        <section class="sheet padding-10mm">
            <table style="width: 100%">
                <tr>
                    <td align="center" style="padding-bottom: 1px;">
                        <img src="{{ asset('tabler/static/Logo_ATII.png') }}" width="220" height="205"
                            alt="" style="margin-top: -50px;">
                        <hr>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <span id="title" style="margin-top: -50px;">
                            LAPORAN PRESENSI KARYAWAN <br>
                            ({{ ucwords(strtolower($karyawan->nama_lengkap)) }})
                            <br style="padding-bottom: 10px;">
                            PERIODE {{ strtoupper($namabulan[$bulan]) }} {{ $tahun }}
                            <br>
                        </span>
                        <span style="font-size: 10px">Jl. Indarung Padang Besii, Bandar Buat, Kec. Lubuk Kilangan,
                            Kota
                            Padang, Sumatera Barat</span>
                        <hr>
                    </td>
                </tr>
            </table>


            <table class="tabeldatakaryawan">
                <tr>
                    <td rowspan="5">
                        @php
                            $path = Storage::url('uploads/karyawan/' . $karyawan->foto);
                        @endphp
                        @if (empty($karyawan->foto))
                            <img src="{{ asset('assets/img/nophoto.png') }}" alt="" width="100%"
                                height="150px">
                        @else
                            <img src="{{ url($path) }}" alt="" width="100%" height="150px">
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>NIK</td>
                    <td>:</td>
                    <td>{{ $karyawan->nik }}</td>
                </tr>
                <tr>
                    <td>Nama Karyawan</td>
                    <td>:</td>
                    <td>{{ $karyawan->nama_lengkap }}</td>
                </tr>
                <tr>
                    <td>Jabatan</td>
                    <td>:</td>
                    <td>{{ $karyawan->nama_jabatan }}</td>
                </tr>
                <tr>
                    <td>No. HP</td>
                    <td>:</td>
                    <td>{{ $karyawan->no_hp }}</td>
                </tr>
            </table>


            <table class="tabelpresensi" style="margin-bottom: 75px">
                <tr>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Jam Masuk</th>
                    <th>Foto</th>
                    <th>Jam Pulang</th>
                    <th>Foto</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                    <th>Jml Jam Kerja</th>
                </tr>

                @foreach ($presensi as $d)
                    @if ($d->status_presensi == 'h')
                        @php
                            $path_in = Storage::url('uploads/absensi/' . $d->foto_in);
                            $path_out = Storage::url('uploads/absensi/' . $d->foto_out);
                            $jamterlambat = selisih('08:00:00', $d->jam_in);
                            [$jam, $menit] = $jamterlambat;
                        @endphp

                        <tr>
                            <td>{{ $loop->iteration }}</td>


                            <td>{{ date('d', strtotime($d->tgl_presensi)) }} {{ $namabulan[$bulan] }}
                                {{ $tahun }}
                            </td>
                            <td>{{ $d->jam_in }}</td>
                            <td><img src="{{ url($path_in) }}" alt="" class="foto"></td>
                            <td>{{ $d->jam_out != null ? $d->jam_out : 'Belum Absen' }}</td>
                            <td>
                                @if ($d->jam_out != null)
                                    <img src="{{ $path_out }}" alt="" class="foto">
                                @else
                                    <img src="{{ asset('assets/img/nophoto.png') }}" alt="" class="foto">
                                @endif
                            </td>
                            <td>Hadir</td>
                            <td>


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
                            </td>
                            <td>
                                @if ($d->jam_out != null)
                                    @php
                                        $jmljamkerja = selisih($d->jam_in, $d->jam_out);
                                    @endphp
                                @else
                                    @php
                                        $jmljamkerja = [0, 0];
                                    @endphp
                                @endif
                                {{ $jmljamkerja[0] }} jam {{ $jmljamkerja[1] }} menit
                            </td>
                        </tr>
                    @else
                        <tr>
                            <td>{{ $loop->iteration }}</td>


                            <td>{{ date('d', strtotime($d->tgl_presensi)) }} {{ $namabulan[$bulan] }}
                                {{ $tahun }}
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                @if ($d->status_presensi == 'i')
                                    Izin
                                @elseif ($d->status_presensi == 's')
                                    Sakit
                                @elseif ($d->status_presensi == 'c')
                                    Cuti
                                @else
                                    {{ $d->status_presensi }}
                                @endif
                            </td>
                            <td>{{ $d->keterangan }}</td>
                            <td></td>
                        </tr>
                    @endif
                @endforeach
            </table>

            <table class="signature">
                <tr>
                    <td colspan="2" style="text-align: right; padding-right: 100px;margin-top:75px">Padang,
                        {{ date('d F Y') }}
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center;" height="130px">
                        <u>Irma Yuswara</u><br>
                        <i><b>HRD Manager</b></i>
                    </td>
                    <td style="text-align: center;">
                        <u>Rio Handevis</u><br>
                        <i><b>Direktur</b></i>
                    </td>
                </tr>
            </table>
        </section>


        <script>
            window.onload = function() {
                window.print();
            }
        </script>
    @endif

</body>

</html>
