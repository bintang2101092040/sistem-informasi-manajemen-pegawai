<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class IzinabsenController extends Controller
{
    public function create()
    {
        return view('izin.create');
    }

    public function store(Request $request)
    {
        $nik = Auth::guard('karyawan')->user()->nik;
        $tgl_izin_dari = $request->tgl_izin_dari;
        $tgl_izin_sampai = $request->tgl_izin_sampai;
        $status_izin = "i";
        $keterangan = $request->keterangan;


        // Prepare data to be inserted
        $data = [
            'nik' => $nik,
            'tgl_izin_dari' => $tgl_izin_dari,
            'tgl_izin_sampai' => $tgl_izin_sampai,
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



        if ($cekpresensi->count() > 0) {
            $blacklistdate = "";

            foreach ($datapresensi as $d) {

                $blacklistdate .= tanggalIndo($d->tgl_presensi) . ",";
            }
            return redirect('/izinabsen')->with(['error' => 'Tidak Bisa Melakukan Penggajuan Pada Tanggal ' . $blacklistdate . ' Karena Pada Tanggal Tersebut Sudah Digunakan / Sudah Melakukan Presensi']);
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

            $simpan = DB::table('pengajuan_izin')->insert($data);
            if ($simpan) {
                return redirect('/presensi/izin')->with(['success' => 'Data Berhasil Disimpan']);
            } else {
                return redirect('/presensi/izin')->with(['error' => 'Data Gagal Disimpan']);
            }
        }

        // Insert data into the database
    }

    public function edit($izin_id)
    {
        $dataizin = DB::table('pengajuan_izin')->where('izin_id', $izin_id)->first();

        return view('izin.edit', compact('dataizin'));
    }
    public function update($izin_id, Request $request)
    {
        $tgl_izin_dari = $request->tgl_izin_dari;
        $tgl_izin_sampai = $request->tgl_izin_sampai;
        $keterangan = $request->keterangan;

        try {
            $data = [
                'tgl_izin_dari' => $tgl_izin_dari,
                'tgl_izin_sampai' => $tgl_izin_sampai,
                'keterangan' => $keterangan
            ];

            DB::table('pengajuan_izin')->where('izin_id', $izin_id)->update($data);
            return redirect('/presensi/izin')->with(['success' => 'Data Berhasil Diupdate']);
        } catch (\Throwable $th) {
            return redirect('/presensi/izin')->with(['error' => 'Data Gagal Disimpan']);
        }
    }
}
