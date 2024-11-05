<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>A4 Landscape Rekap Presensi Karyawan</title>

    <!-- Normalize or reset CSS with your favorite library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

    <!-- Load paper.css for happy printing -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

    <style>
        @page {
            size: A4 landscape;
            margin: 10mm;
        }

        body.A4.landscape .sheet {

            height: auto;
        }

        #title {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 18px;
            font-weight: bold;
        }

        .tabeldatakaryawan {
            margin-top: 20px;
        }

        .tabeldatakaryawan td {
            padding: 3px;
        }

        .tabelpresensi {
            width: 100%;
            margin-top: 10px;
            border-collapse: collapse;
            font-size: 10px;
        }

        .tabelpresensi th,
        .tabelpresensi td {
            border: 1px solid #141313;
            padding: 3px;
        }

        .tabelpresensi th {
            background: #bbb9b9;
            text-align: center;
        }

        .tabelpresensi td {
            text-align: center;
        }

        .foto {
            width: 40px;
            height: 40px;
        }

        .footer-table {
            margin-top: 20px;
            width: 100%;
        }

        .footer-table td {
            text-align: center;
            vertical-align: bottom;
            font-size: 12px;
        }

        /* Pecahkan tabel menjadi beberapa halaman */
        .page-break {
            page-break-before: always;
        }
    </style>
</head>

<body class="A4 landscape">



    <section class="sheet padding-10mm">
        <table style="width: 100%">
            <tr>
                <td align="center" style="padding-bottom: 1px;">
                    <img src="{{ asset('tabler/static/Logo_ATII.png') }}" width="220" height="205" alt="Logo"
                        style="margin-top: -50px;">
                    <hr>
                </td>
            </tr>
            <tr>
                <td align="center">
                    <span id="title" style="margin-top: -50px;">
                        REKAP PRESENSI KARYAWAN
                        <br> PERIODE {{ strtoupper($namabulan[$bulan]) }} {{ $tahun }}
                    </span>
                    <br>
                    <span style="font-size: 10px;">
                        Jl. Indarung Padang Besii, Bandar Buat, Kec. Lubuk Kilangan, Kota Padang, Sumatera Barat
                    </span>
                    <hr>
                </td>
            </tr>
        </table>

        <table class="tabelpresensi">
            <tr>
                <th rowspan="2" style="text-align: center; vertical-align: middle;">Nik</th>
                <th rowspan="2" style="text-align: center; vertical-align: middle;">Nama Karyawan</th>
                <th colspan="{{ $jmlhari }}">Bulan {{ $namabulan[$bulan] }} Tahun {{ $tahun }}</th>
                <th rowspan="2" style="text-align: center; vertical-align: middle;">Total Kehadiran</th>
                <th rowspan="2" style="text-align: center; vertical-align: middle;">Total Sakit</th>
                <th rowspan="2" style="text-align: center; vertical-align: middle;">Total Izin</th>
                <th rowspan="2" style="text-align: center; vertical-align: middle;">Total Cuti</th>
                <th rowspan="2" style="text-align: center; vertical-align: middle;">Total Keterlambatan</th>
                <th rowspan="2" style="text-align: center; vertical-align: middle;">Total Alpa</th>
            </tr>
            <tr>

                @foreach ($rangetanggal as $d)
                    @if ($d != null)
                        <th>{{ date('d', strtotime($d)) }}</th>
                    @endif
                @endforeach
            </tr>
            @foreach ($rekap as $d)
                @php
                    $totalhadir = 0;
                    $totalketerlambatan = 0;
                    $totalizin = 0;
                    $totalsakit = 0;
                    $totalcuti = 0;
                    $totalalpa = 0;
                    $color = '';
                @endphp
                <tr>
                    <td>{{ $d->nik }}</td>
                    <td style="text-align: left">{{ $d->nama_lengkap }}</td>

                    @for ($i = 1; $i <= $jmlhari; $i++)
                        @php
                            $tgl = 'tgl_' . $i;
                            $datapresensi = explode('|', $d->$tgl ?? '');
                            $statusPresensi = $datapresensi[2] ?? 'NA';
                            $keterangan = '';

                            if ($statusPresensi == 'h') {
                                $keterangan = 'Hadir';
                                $color = 'white';
                                $totalhadir++;
                                if (isset($datapresensi[0]) && $datapresensi[0] > '08:00:00') {
                                    $totalketerlambatan++;
                                }
                            } elseif ($statusPresensi == 'i') {
                                $keterangan = 'Izin';
                                $color = '#ffbb00';
                                $totalizin++;
                            } elseif ($statusPresensi == 's') {
                                $keterangan = 'Sakit';
                                $color = '#34a1eb';
                                $totalsakit++;
                            } elseif ($statusPresensi == 'c') {
                                $keterangan = 'Cuti';
                                $color = '#a600ff';
                                $totalcuti++;
                            } else {
                                $keterangan = '';
                                $totalalpa++;
                                $color = 'red';
                            }

                        @endphp
                        <td style="background-color: {{ $color }}">
                            @if ($d->$tgl != null)
                                {{ $keterangan }}
                            @endif
                        </td>
                    @endfor
                    <td>{{ !empty($totalhadir) ? $totalhadir : '' }}</td>
                    <td>{{ !empty($totalsakit) ? $totalsakit : '' }}</td>
                    <td>{{ !empty($totalizin) ? $totalizin : '' }}</td>
                    <td>{{ !empty($totalcuti) ? $totalcuti : '' }}</td>
                    <td style="background-color: gray">{{ !empty($totalketerlambatan) ? $totalketerlambatan : '' }}
                    </td>
                    <td>{{ !empty($totalalpa) ? $totalalpa : '' }}</td>
                    {{-- <td>{{ !empty($totalalpa) ? number_format($totalalpa * 0.02, 2) : '' }}</td> --}}
                </tr>
                </tr>
            @endforeach
        </table>

        <div class="page-break"></div>

        <table class="footer-table">
            <tr>
                <td colspan="2" style="text-align: right; padding-right: 180px; padding-top: 40px;">Padang,
                    {{ date('d F Y') }}</td>
            </tr>
            <tr>
                <td height="130px">
                    <u>Irma Yuswara</u><br>
                    <i><b>HRD Manager</b></i>
                </td>
                <td>
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

</body>

</html>
