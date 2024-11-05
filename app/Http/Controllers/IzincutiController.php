<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class IzincutiController extends Controller
{
    public function create()
    {
        $mastercuti = DB::table('master_cuti')->orderBy('kode_cuti')->get();
        return view('izincuti.create', compact('mastercuti'));
    }

    public function store(Request $request)
    {
        $nik = Auth::guard('karyawan')->user()->nik;
        $tgl_izin_dari = $request->tgl_izin_dari;
        $tgl_izin_sampai = $request->tgl_izin_sampai;
        $kode_cuti = $request->kode_cuti;
        $status_izin = "c";
        $keterangan = $request->keterangan;

        $bulan = date("m", strtotime($tgl_izin_dari));
        $tahun = date("Y", strtotime($tgl_izin_dari));

        $jmlhari = hitunghari($tgl_izin_dari, $tgl_izin_sampai);

        $cuti = DB::table('master_cuti')
            ->where('kode_cuti', $kode_cuti)->first();

        $jmlmaxcuti = $cuti->jml_hari;

        $cutidigunakan = DB::table('presensi')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
            ->where('status_presensi', 'c')
            ->where('nik', $nik)
            ->count();

        $sisacuti = $jmlmaxcuti - $cutidigunakan;




        // Prepare data to be inserted
        $data = [
            'nik' => $nik,
            'tgl_izin_dari' => $tgl_izin_dari,
            'tgl_izin_sampai' => $tgl_izin_sampai,
            'kode_cuti' => $kode_cuti,
            'status_izin' => $status_izin,
            'keterangan' => $keterangan,

        ];

        $cekpresensi = DB::table('presensi')
            ->whereBetween('tgl_presensi', [$tgl_izin_dari, $tgl_izin_sampai])
            ->where('nik', $nik);

        $cekpengajuan = DB::table('pengajuan_izin')
            ->whereRaw('"' . $tgl_izin_dari . '" BETWEEN tgl_izin_dari AND tgl_izin_sampai')
            ->where('nik', $nik);

        $datapresensi = $cekpresensi->get();
        $datapengajuan = $cekpengajuan->get();


        if ($jmlhari > $sisacuti) {
            return redirect('/izincuti')->with(['error' => 'Jatah Cuti dalam 1 tahun Melebihi batasJatah Cuti dalam 1 tahun Melebihi batas, sisa Cuti Anda adalah ' . $sisacuti . 'Hari']);
        }

        if ($cekpresensi->count() > 0) {
            $blacklistdate = "";

            foreach ($datapresensi as $d) {

                $blacklistdate .= tanggalIndo($d->tgl_presensi) . ",";
            }
            return redirect('/izincuti')->with(['error' => 'Tidak Bisa Melakukan Penggajuan Pada Tanggal ' . $blacklistdate . ' Karena Pada Tanggal Tersebut Sudah Digunakan / Sudah Melakukan Presensi']);
        } else if ($cekpengajuan->count() > 0) {
            $blacklistdate = "";

            foreach ($datapengajuan as $d) {



                $dates = getDateRange($d->tgl_izin_dari, $d->tgl_izin_sampai);
                foreach ($dates as $date) {
                    $blacklistdate .= tanggalIndo($date) . ",";
                }
            }
            return redirect('/izinabsen')->with(['error' => 'Tidak Bisa Melakukan Penggajuan Pada Tanggal ' . $blacklistdate . ' Karena Pada Tanggal Tersebut Sudah Digunakan / Sudah Melakukan Presensi']);
        } else {

            // Insert data into the database
            $simpan = DB::table('pengajuan_izin')->insert($data);
            if ($simpan) {
                return redirect('/presensi/izin')->with(['success' => 'Data Berhasil Disimpan']);
            } else {
                return redirect('/presensi/izin')->with(['error' => 'Data Gagal Disimpan']);
            }
        }
    }

    public function edit($izin_id)
    {
        $dataizin = DB::table('pengajuan_izin')->where('izin_id', $izin_id)->first();
        $mastercuti = DB::table('master_cuti')->orderBy('kode_cuti')->get();
        return view('izincuti.edit', compact('mastercuti', 'dataizin'));
    }
    public function update($izin_id, Request $request)
    {
        $tgl_izin_dari = $request->tgl_izin_dari;
        $tgl_izin_sampai = $request->tgl_izin_sampai;
        $keterangan = $request->keterangan;
        $kode_cuti = $request->kode_cuti;

        try {
            $data = [
                'tgl_izin_dari' => $tgl_izin_dari,
                'tgl_izin_sampai' => $tgl_izin_sampai,
                'kode_cuti' => $kode_cuti,
                'keterangan' => $keterangan
            ];

            DB::table('pengajuan_izin')->where('izin_id', $izin_id)->update($data);
            return redirect('/presensi/izin')->with(['success' => 'Data Berhasil Diupdate']);
        } catch (\Throwable $th) {
            return redirect('/presensi/izin')->with(['error' => 'Data Gagal Diupdate']);
        }
    }
}
