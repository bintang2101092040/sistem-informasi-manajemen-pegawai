<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class IzinsakitController extends Controller
{
    public function create()
    {
        return view('sakit.create');
    }

    public function store(Request $request)
    {
        $nik = Auth::guard('karyawan')->user()->nik;
        $tgl_izin_dari = $request->tgl_izin_dari;
        $tgl_izin_sampai = $request->tgl_izin_sampai;
        $status_izin = "s";
        $keterangan = $request->keterangan;
        $foto_izin = null;

        // Check if the request has a file named 'foto_izin'
        if ($request->hasFile('foto_izin')) {
            // Get the file from the request
            $file = $request->file('foto_izin');
            // Create a unique file name
            $fileName = $nik . "_" . time() . "." . $file->getClientOriginalExtension();
            // Define the storage path
            $folderPath = "public/uploads/izin/";
            // Store the file
            $file->storeAs($folderPath, $fileName);
            // Set the file name to be saved in the database
            $foto_izin = $fileName;
        }

        // Prepare data to be inserted
        $data = [
            'nik' => $nik,
            'tgl_izin_dari' => $tgl_izin_dari,
            'tgl_izin_sampai' => $tgl_izin_sampai,
            'status_izin' => $status_izin,
            'keterangan' => $keterangan,
            'foto_izin' => $foto_izin,
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
            return redirect('/izinsakit')->with(['error' => 'Tidak Bisa Melakukan Penggajuan Pada Tanggal ' . $blacklistdate . ' Karena Pada Tanggal Tersebut Sudah Digunakan / Sudah Melakukan Presensi']);
        } else if ($cekpengajuan->count() > 0) {
            $blacklistdate = "";

            foreach ($datapengajuan as $d) {



                $dates = getDateRange($d->tgl_izin_dari, $d->tgl_izin_sampai);
                foreach ($dates as $date) {
                    $blacklistdate .= tanggalIndo($date) . ",";
                }
            }
            return redirect('/izinsakit')->with(['error' => 'Tidak Bisa Melakukan Penggajuan Pada Tanggal ' . $blacklistdate . ' Karena Pada Tanggal Tersebut Sudah Digunakan / Sudah Melakukan Presensi']);
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

        return view('sakit.edit', compact('dataizin'));
    }
    public function update($izin_id, Request $request)
    {
        try {
            // Retrieve existing record using the correct primary key column name
            $izin = DB::table('pengajuan_izin')->where('izin_id', $izin_id)->first();

            if (!$izin) {
                return redirect('/presensi/izin')->with(['error' => 'Data tidak ditemukan']);
            }

            $tgl_izin_dari = $request->tgl_izin_dari;
            $tgl_izin_sampai = $request->tgl_izin_sampai;
            $keterangan = $request->keterangan;
            $foto_izin = $izin->foto_izin; // retain existing foto_izin

            // Check if the request has a file named 'foto_izin'
            if ($request->hasFile('foto_izin')) {
                // Get the file from the request
                $file = $request->file('foto_izin');
                // Create a unique file name
                $fileName = $izin_id . "_" . time() . "." . $file->getClientOriginalExtension();
                // Define the storage path
                $folderPath = "public/uploads/izin/";
                // Store the file
                $file->storeAs($folderPath, $fileName);
                // Set the file name to be saved in the database
                $foto_izin = $fileName;

                // Delete old file if exists
                if ($izin->foto_izin) {
                    Storage::delete($folderPath . $izin->foto_izin);
                }
            }

            // Prepare data for update
            $data = [
                'tgl_izin_dari' => $tgl_izin_dari,
                'tgl_izin_sampai' => $tgl_izin_sampai,
                'keterangan' => $keterangan,
                'foto_izin' => $foto_izin,
            ];

            // Update the record using the correct primary key column name
            $update = DB::table('pengajuan_izin')->where('izin_id', $izin_id)->update($data);

            if ($update) {
                return redirect('/presensi/izin')->with(['success' => 'Data Berhasil Diperbarui']);
            } else {
                return redirect('/presensi/izin')->with(['error' => 'Data Gagal Diperbarui']);
            }
        } catch (\Exception $e) {
            // Handle the exception
            return redirect('/presensi/izin')->with(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
