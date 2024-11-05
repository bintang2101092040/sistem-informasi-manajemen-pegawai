<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>A4 Landscape Rekap Penggajian Karyawan</title>

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

        .table-container {
            width: 100%;
            overflow: auto;
            margin-top: 10px;
        }

        .tabelpresensi {
            width: max-content;

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
                        PENGGAJIAN KARYAWAN
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

        <div class="table-container">
            <table class="tabelpresensi">
                <tr>
                    <th rowspan="3" style="text-align: center; vertical-align: middle;">No</th>
                    <th rowspan="3" style="text-align: center; vertical-align: middle;">Nik</th>
                    <th rowspan="3" style="text-align: center; vertical-align: middle;">Nama Karyawan</th>
                    <th rowspan="3" style="text-align: center; vertical-align: middle;">Jabatan</th>
                    <th rowspan="3" style="text-align: center; vertical-align: middle;">Tanggal<br>Gabung</th>
                    <th rowspan="3" style="background: #86bace;">Gaji Pokok</th>
                    <th rowspan="3"style="background: #86bace;">Tunjangan Tetap</th>
                    <th rowspan="3"style="background: #86bace;">Tunjangan Tidak Tetap</th>
                    <th rowspan="3"style="background: #86bace;">Gaji Bruto</th>
                    <th rowspan="3" style="text-align: center; vertical-align: middle;background: #86bace;">Total
                        Kehadiran</th>
                    <th rowspan="3" style="text-align: center; vertical-align: middle;background: #86bace;">Total
                        Sakit</th>
                    <th rowspan="3" style="text-align: center; vertical-align: middle;background: #86bace;">Total
                        Izin</th>
                    <th rowspan="3" style="text-align: center; vertical-align: middle;background: #86bace;">Total
                        Cuti</th>
                    <th rowspan="3" style="text-align: center; vertical-align: middle;background: #86bace;">Jumlah
                        hari pada bulan ini
                    </th>
                    <th rowspan="3" style="text-align: center; vertical-align: middle;background: #86bace;">Gaji
                        Bruto Prorate</th>
                    <th rowspan="3" style="text-align: center; vertical-align: middle;background: #e0de5d;">Basic
                        BPJS Ketenagakerjaan
                        (JHT,JKK,JK)</th>
                    <th rowspan="3" style="text-align: center; vertical-align: middle;background: #e0de5d;">Basic
                        BPJS Ketenagakerjaan
                        (Jaminan Kesehatan)</th>
                    <th rowspan="3" style="text-align: center; vertical-align: middle;background: #e0de5d;">Basic
                        BPJS Kesehatan</th>
                    <th rowspan="3" style="text-align: center; vertical-align: middle;background: #e0de5d;">
                        Perhitungan BPJS Kesehatan
                    </th>
                    <th rowspan="3" style="text-align: center; vertical-align: middle;background: #e0de5d;">Total
                        Keterlambatan</th>
                    <th colspan="5" style="text-align: center; vertical-align: middle;background: #e0de5d;">Potongan
                        Perusahaan</th>
                    <th colspan="3" style="text-align: center; vertical-align: middle;background: #e0de5d;">Potongan
                        Karyawan</th>
                    <th rowspan="3" style="text-align: center; vertical-align: middle;background: #86bace;">
                        Penghasilan</th>
                    <th colspan="2" rowspan="2"
                        style="text-align: center; vertical-align: middle;background: #86bace;">
                        Pengurangan</th>
                    <th rowspan="3" style="text-align: center; vertical-align: middle;background: #86bace;">
                        Penghasilan Neto</th>
                    <th rowspan="3" style="text-align: center; vertical-align: middle;">Gaji Yang Diterima</th>
                    {{-- <th rowspan="2" style="text-align: center; vertical-align: middle;">Total Alpa</th> --}}
                </tr>
                <tr>
                    <th colspan="1" style="background: #e0de5d;">JHT</th>
                    <th colspan="1" style="background: #e0de5d;">JKK</th>
                    <th colspan="1" style="background: #e0de5d;">JK</th>
                    <th colspan="1" style="background: #e0de5d;">JP</th>
                    <th colspan="1" style="background: #e0de5d;">Jaminan Kesehatan</th>
                    {{-- karyawan --}}
                    <th colspan="1" style="background: #e0de5d;">JHT</th>

                    <th colspan="1" style="background: #e0de5d;">JP</th>
                    <th colspan="1" style="background: #e0de5d;">Jaminan Kesehatan</th>
                </tr>
                <tr>
                    <th style="background: #e0de5d;">3,7%</th>
                    <th style="background: #e0de5d;">0,54%(OFFICE) 0,89%(TEKNISI)</th>
                    <th style="background: #e0de5d;">0,3%</th>
                    <th style="background: #e0de5d;">2%</th>
                    <th style="background: #e0de5d;">4%</th>

                    {{-- karyawan --}}

                    <th style="background: #e0de5d;">2%</th>
                    <th style="background: #e0de5d;">1%</th>
                    <th style="background: #e0de5d;">1%</th>

                    {{-- pengurangan --}}
                    <th style="background: #86bace;">Biaya Jabatan</th>
                    <th style="background: #86bace;">Jumlah Pengurangan</th>


                </tr>
                @php
                    $totalGajiPokok = 0;
                    $totalTunjanganTetap = 0;
                    $totalTunjanganTidakTetap = 0;
                    $totalGajiBruto = 0;
                    $totalHadir = 0;
                    $totalSakit = 0;
                    $totalIzin = 0;
                    $totalCuti = 0;
                    $totalGajiBrutoProrate = 0;
                    $totalJHTP = 0;
                    $totalJKKP = 0;
                    $totalJKP = 0;
                    $totalJPP = 0;
                    $totalJaminanP = 0;
                    $totalJHTK = 0;
                    $totalJPK = 0;
                    $totalJaminanK = 0;
                    $totalPenghasilan = 0;
                    $totalBiayaJabatan = 0;
                    $totalPengurangan = 0;
                    $totalPenghasilanNeto = 0;
                    $totalGajiTerima = 0;
                @endphp

                @foreach ($rekap as $d)
                    @php
                        $totalhadir = 26;
                        $totalketerlambatan = 0;
                        $totalizin = 0;
                        $totalsakit = 0;
                        $totalcuti = 0;
                        $totalalpa = 0;
                        $color = '';
                        $gajibruto = $d->gaji_pokok + $d->tunjangan_tetap + $d->tunjangan_tidak_tetap;
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $d->nik }}</td>
                        <td style="text-align: left">{{ $d->nama_lengkap }}</td>
                        <td style="text-align: left">{{ $d->nama_jabatan }}</td>
                        <td style="text-align: left">{{ tanggalSingkat($d->tanggal_gabung) }}</td>

                        @for ($i = 1; $i <= $jmlhari; $i++)
                            @php
                                $tgl = 'tgl_' . $i;
                                $datapresensi = explode('|', $d->$tgl ?? '');
                                $statusPresensi = $datapresensi[2] ?? 'NA';
                                $keterangan = '';
                                $gajibrutoprorate = ($gajibruto / $jmlhari) * $totalhadir;

                                $jhtP = $d->gaji_bpjs_ketenagakerjaan * 0.037;
                                $jkkP = $d->gaji_bpjs_ketenagakerjaan * 0.0089;
                                $jkP = $d->gaji_bpjs_ketenagakerjaan * 0.003;
                                $jpP = $d->gaji_bpjs_ketenagakerjaan * 0.02;
                                $jaminanP = $d->gaji_bpjs_kesehatan * 0.04;

                                $jhtK = $d->gaji_bpjs_ketenagakerjaan * 0.02;
                                $jpK = $d->gaji_bpjs_ketenagakerjaan * 0.01;
                                $jaminanK = $d->gaji_bpjs_kesehatan * 0.01;
                                $penghasilan = $gajibrutoprorate + $jkkP + $jkP + $jaminanP;
                                $biayajabatan = $penghasilan * 0.05 > 500000 ? 500000 : $penghasilan * 0.05;
                                $jmlpengurangan = $biayajabatan + $jhtK + $jaminanK;
                                $penghasilanneto = $penghasilan - $jmlpengurangan;
                                $gajiterima = $gajibrutoprorate - $jhtK - $jpK - $jaminanK;
                                $penalty_points = floor($totalketerlambatan / 4);
                                $gajibrutoprorate = ($gajibruto / $jmlhari) * ($totalhadir - $penalty_points);

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
                        @endfor

                        <td>Rp. {{ number_format($d->gaji_pokok, 0, ',', '.') }}</td>
                        <td>Rp. {{ number_format($d->tunjangan_tetap, 0, ',', '.') }}</td>
                        <td>Rp. {{ number_format($d->tunjangan_tidak_tetap, 0, ',', '.') }}</td>
                        <td>Rp. {{ number_format($gajibruto, 0, ',', '.') }}</td>
                        <td>{{ !empty($totalhadir) ? $totalhadir : '' }}</td>
                        <td>{{ !empty($totalsakit) ? $totalsakit : '' }}</td>
                        <td>{{ !empty($totalizin) ? $totalizin : '' }}</td>
                        <td>{{ !empty($totalcuti) ? $totalcuti : '' }}</td>
                        <td>{{ $jmlhari }}</td>
                        <td>Rp. {{ number_format($gajibrutoprorate, 0, ',', '.') }}</td>
                        <td>Rp. {{ number_format($d->gaji_bpjs_ketenagakerjaan, 0, ',', '.') }}</td>
                        <td>Rp. {{ number_format($d->gaji_bpjs_ketenagakerjaan, 0, ',', '.') }}</td>
                        <td>Rp. {{ number_format($d->gaji_bpjs_kesehatan, 0, ',', '.') }}</td>
                        <td>Rp. {{ number_format($d->gaji_bpjs_kesehatan, 0, ',', '.') }}</td>
                        <td style="background-color: gray">
                            {{ !empty($totalketerlambatan) ? $totalketerlambatan : '' }}
                        </td>
                        <td>Rp. {{ number_format($jhtP, 0, ',', '.') }}</td>
                        <td>Rp. {{ number_format($jkkP, 0, ',', '.') }}</td>
                        <td>Rp. {{ number_format($jkP, 0, ',', '.') }}</td>
                        <td>Rp. {{ number_format($jpP, 0, ',', '.') }}</td>
                        <td>Rp. {{ number_format($jaminanP, 0, ',', '.') }}</td>

                        {{-- potongan perusahaan --}}
                        <td>Rp. {{ number_format($jhtK, 0, ',', '.') }}</td>
                        <td>Rp. {{ number_format($jpK, 0, ',', '.') }}</td>
                        <td>Rp. {{ number_format($jaminanK, 0, ',', '.') }}</td>

                        {{-- penghasila --}}
                        <td>Rp. {{ number_format($penghasilan, 0, ',', '.') }}</td>
                        <td>Rp. {{ number_format($biayajabatan, 0, ',', '.') }}</td>
                        <td>Rp. {{ number_format($jmlpengurangan, 0, ',', '.') }}</td>
                        <td>Rp. {{ number_format($penghasilanneto, 0, ',', '.') }}</td>
                        <td>Rp. {{ number_format($gajiterima, 0, ',', '.') }}</td>
                    </tr>
                    @php
                        $totalGajiPokok += $d->gaji_pokok;
                        $totalTunjanganTetap += $d->tunjangan_tetap;
                        $totalTunjanganTidakTetap += $d->tunjangan_tidak_tetap;
                        $totalGajiBruto += $gajibruto;
                        $totalHadir += $totalhadir;
                        $totalSakit += $totalsakit;
                        $totalIzin += $totalizin;
                        $totalCuti += $totalcuti;
                        $totalGajiBrutoProrate += $gajibrutoprorate;
                        $totalJHTP += $jhtP;
                        $totalJKKP += $jkkP;
                        $totalJKP += $jkP;
                        $totalJPP += $jpP;
                        $totalJaminanP += $jaminanP;
                        $totalJHTK += $jhtK;
                        $totalJPK += $jpK;
                        $totalJaminanK += $jaminanK;
                        $totalPenghasilan += $penghasilan;
                        $totalBiayaJabatan += $biayajabatan;
                        $totalPengurangan += $jmlpengurangan;
                        $totalPenghasilanNeto += $penghasilanneto;
                        $totalGajiTerima += $gajiterima;
                    @endphp
                @endforeach
                <tr style="background:#bbb9b9">
                    <td colspan="5" style="text-align: center; font-weight: bold;">Total</td>
                    <td>Rp. {{ number_format($totalGajiPokok, 0, ',', '.') }}</td>
                    <td>Rp. {{ number_format($totalTunjanganTetap, 0, ',', '.') }}</td>
                    <td>Rp. {{ number_format($totalTunjanganTidakTetap, 0, ',', '.') }}</td>
                    <td>Rp. {{ number_format($totalGajiBruto, 0, ',', '.') }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Rp. {{ number_format($totalGajiBrutoProrate, 0, ',', '.') }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Rp. {{ number_format($totalJHTP, 0, ',', '.') }}</td>
                    <td>Rp. {{ number_format($totalJKKP, 0, ',', '.') }}</td>
                    <td>Rp. {{ number_format($totalJKP, 0, ',', '.') }}</td>
                    <td>Rp. {{ number_format($totalJPP, 0, ',', '.') }}</td>
                    <td>Rp. {{ number_format($totalJaminanP, 0, ',', '.') }}</td>
                    <td>Rp. {{ number_format($totalJHTK, 0, ',', '.') }}</td>
                    <td>Rp. {{ number_format($totalJPK, 0, ',', '.') }}</td>
                    <td>Rp. {{ number_format($totalJaminanK, 0, ',', '.') }}</td>
                    <td>Rp. {{ number_format($totalPenghasilan, 0, ',', '.') }}</td>
                    <td>Rp. {{ number_format($totalBiayaJabatan, 0, ',', '.') }}</td>
                    <td>Rp. {{ number_format($totalPengurangan, 0, ',', '.') }}</td>
                    <td>Rp. {{ number_format($totalPenghasilanNeto, 0, ',', '.') }}</td>
                    <td>Rp. {{ number_format($totalGajiTerima, 0, ',', '.') }}</td>
                </tr>
            </table>
        </div>

        <div class="row mt-4">
            <table style="padding-top: 15px; text-align: left;">
                <tr>
                    <td style="padding-right: 10px;">Gaji {{ tanggalBulanTahun($d->tanggal_gabung) }} </td>
                    <td style="padding-right: 10px;">:</td>
                    <td>Rp. {{ number_format($totalGajiTerima, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td style="padding-right: 10px;">Total BPJS Ketenagakerjaan </td>
                    <td style="padding-right: 10px;">:</td>
                    <td>Rp.
                        {{ number_format($totalJHTP + $totalJKKP + $totalJKP + $totalJPP + $totalJHTK + $totalJPK, 0, ',', '.') }}
                    </td>
                </tr>
                <tr>
                    <td style="padding-right: 10px;">Total BPJS Kesehatan </td>
                    <td style="padding-right: 10px;">:</td>
                    <td>Rp. {{ number_format($totalJaminanP + $totalJaminanK, 0, ',', '.') }}</td>
                </tr>
            </table>
        </div>



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
