<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use App\Models\Pengajuanizin;
use Illuminate\Support\Carbon;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\select;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class PresensiController extends Controller
{
    public function create()
    {
        $hariini = date("Y-m-d");
        $nik = Auth::guard('karyawan')->user()->nik;
        $hariIni = date('Y-m-d');
        $cek = DB::table('presensi')->where('tgl_presensi', $hariini)->where('nik', $nik)->count();
        $sudahAbsenPulang = DB::table('presensi')
            ->where('nik', $nik)
            ->whereDate('tgl_presensi', $hariIni)

            ->whereNotNull('jam_out')

            ->exists();

        $sudahAbsen = DB::table('presensi')
            ->where('nik', $nik)
            ->whereDate('tgl_presensi', $hariIni)
            ->whereNotNull('izin_id')
            ->exists();
        $kode_cabang = Auth::guard('karyawan')->user()->kode_cabang;
        $lok_kantor = DB::table('cabang')->where('kode_cabang', $kode_cabang)->first();

        return view('presensi.create', compact('cek', 'lok_kantor', 'sudahAbsenPulang', 'sudahAbsen'));
    }

    // public function store(Request $request)
    // {

    //     $nik = Auth::guard('karyawan')->user()->nik;
    //     $tgl_presensi = date("Y-m-d");
    //     $jam = date("H:i:s");
    //     $latitudekantor = 0.4637491116008792;
    //     $longitudekantor = 101.39871285686762;
    //     $lokasi = $request->lokasi;
    //     $lokasiuser = explode(",", $lokasi);
    //     $latitudeuser = $lokasiuser[0];
    //     $longitudeuser = $lokasiuser[1];

    //     $jarak = $this->distance($latitudekantor, $longitudekantor, $latitudeuser, $longitudeuser);
    //     $radius = round($jarak("meters"));
    //     $cek = DB::table('presensi')->where('tgl_presensi', $tgl_presensi)->where('nik', $nik)->count();

    //     if ($radius > 10) {
    //         echo "error|Maaf Anda Berada Diluar Radius";
    //     } else {



    //         if ($cek > 0) {
    //             $ket = 'out';
    //         } else {
    //             $ket = 'in';
    //         }
    //         $image = $request->image;
    //         //0.4637600021034451, 101.39871673141371
    //         $folderPath = "public/uploads/absensi/";
    //         $formatName = $nik . "-" . $tgl_presensi . "-" . $ket;
    //         $image_parts = explode(";base64", $image);
    //         $image_base64 = base64_decode($image_parts[1]);
    //         $fileName = $formatName . ".png";
    //         $file = $folderPath . $fileName;


    //         if ($cek > 0) {
    //             $data_pulang = [
    //                 'jam_out' => $jam,
    //                 'foto_out' => $fileName,
    //                 'lokasi_out' =>  $lokasi,

    //             ];
    //             $update = DB::table('presensi')->where('tgl_presensi', $tgl_presensi)->where('nik', $nik)->update($data_pulang);
    //             if ($update) {
    //                 echo "success|Terimakasih, Hati Hati Di Jalan|out";
    //                 Storage::put($file, $image_base64);
    //             } else {
    //                 echo "error|Maaf Gagal Absen, Silahkan Hubungi Admin|out";
    //             }
    //         } else {
    //             $data = [
    //                 'nik' => $nik,
    //                 'tgl_presensi' => $tgl_presensi,
    //                 'jam_in' => $jam,
    //                 'foto_in' => $fileName,
    //                 'lokasi_in' =>  $lokasi,

    //             ];

    //             $simpan = DB::table('presensi')->insert($data);
    //             if ($simpan) {

    //                 echo "success|Terimakasih, Selamat Bekerja|in";
    //                 Storage::put($file, $image_base64);
    //             } else {
    //                 echo "error|Maaf Gagal Absen, Silahkan Hubungi Admin|in";
    //             }
    //         }
    //     }
    // }

    public function store(Request $request)
    {
        $nik = Auth::guard('karyawan')->user()->nik;
        $tgl_presensi = date("Y-m-d");
        $jam = date("H:i:s");
        $kode_cabang = Auth::guard('karyawan')->user()->kode_cabang;
        $lok_kantor = DB::table('cabang')->where('kode_cabang', $kode_cabang)->first();
        $lok = explode(",", $lok_kantor->lokasi_cabang);
        $latitudekantor = $lok[0];
        $longitudekantor = $lok[1];
        $lokasi = $request->input('lokasi');
        $lokasiuser = explode(",", $lokasi);
        $latitudeuser = $lokasiuser[0];
        $longitudeuser = $lokasiuser[1];

        $jarak = $this->distance($latitudekantor, $longitudekantor, $latitudeuser, $longitudeuser);
        $radius = round($jarak);

        $cek = DB::table('presensi')->where('tgl_presensi', $tgl_presensi)->where('nik', $nik)->count();

        if ($radius > $lok_kantor->radius_cabang) {
            echo "error|Maaf Anda Berada Diluar Radius, Jarak Anda : " . $radius . " Meter Dari Kantor";
        } else {
            if ($cek > 0) {
                $ket = 'out';
            } else {
                $ket = 'in';
            }

            $image = $request->input('image');
            $folderPath = "public/uploads/absensi/";
            $formatName = $nik . "-" . $tgl_presensi . "-" . $ket;
            $image_parts = explode(";base64,", $image);
            $image_base64 = base64_decode($image_parts[1]);
            $fileName = $formatName . ".png";
            $file = $folderPath . $fileName;


            if ($cek > 0) {
                $data_pulang = [
                    'jam_out' => $jam,
                    'foto_out' => $fileName,
                    'lokasi_out' =>  $lokasi,
                ];
                $update = DB::table('presensi')->where('tgl_presensi', $tgl_presensi)->where('nik', $nik)->update($data_pulang);
                if ($update) {
                    Storage::put($file, $image_base64);
                    echo "success|Terimakasih, Hati Hati Di Jalan|out";
                } else {
                    echo "error|Maaf Gagal Absen, Silahkan Hubungi Admin|out";
                }
            } else {
                $data = [
                    'nik' => $nik,
                    'tgl_presensi' => $tgl_presensi,
                    'jam_in' => $jam,
                    'foto_in' => $fileName,
                    'lokasi_in' =>  $lokasi,
                    'status_presensi' => 'h'
                ];

                $simpan = DB::table('presensi')->insert($data);
                if ($simpan) {
                    echo "success|Terimakasih, Selamat Bekerja|in";
                    Storage::put($file, $image_base64);
                } else {
                    echo "error|Maaf Gagal Absen, Silahkan Hubungi Admin|in";
                }
            }
        }
    }


    //menghitung jarak
    function distance($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;
        return $meters;
    }


    public function editprofile()
    {
        $nik = Auth::guard('karyawan')->user()->nik;
        $karyawan = DB::table('karyawan')->where('nik', $nik)->first();
        return view('presensi.editprofile', compact('karyawan'));
    }

    public function updateprofile(Request $request)
    {
        $nik = Auth::guard('karyawan')->user()->nik;
        $nama_lengkap = $request->nama_lengkap;
        $no_hp = $request->no_hp;
        $karyawan = DB::table('karyawan')->where('nik', $nik)->first();

        $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4048', // validasi tipe file gambar
        ]);

        // Mengambil foto lama dari database
        $fotoLama = $karyawan->foto;

        if ($request->hasFile('foto')) {
            // Menghapus foto lama dari storage jika ada
            if ($fotoLama) {
                Storage::delete('public/uploads/karyawan/' . $fotoLama);
            }

            // Menyimpan foto baru dengan nama yang sama dengan $nik
            $foto = $nik . "." . $request->file('foto')->getClientOriginalExtension();
            $folderPath = "public/uploads/karyawan/";
            $path = $request->file('foto')->storeAs($folderPath, $foto);
        } else {
            // Jika tidak ada foto baru diunggah, tetap gunakan foto lama
            $foto = $fotoLama;
        }

        // Hanya menghash kata sandi jika kata sandi baru diisi
        if (!empty($request->password)) {
            $password = Hash::make($request->password);
            $data = [
                'nama_lengkap' => $nama_lengkap,
                'no_hp' => $no_hp,
                'password' => $password,
                'foto' => $foto
            ];
        } else {
            $data = [
                'nama_lengkap' => $nama_lengkap,
                'no_hp' => $no_hp,
                'foto' => $foto
            ];
        }

        // Melakukan update data karyawan
        $update = DB::table('karyawan')->where('nik', $nik)->update($data);

        if ($update) {
            if ($request->hasFile('foto') && $path) {
                return Redirect::back()->with(['success' => 'Data Berhasil Diupdate dan Foto Berhasil Diupload']);
            } else {
                return Redirect::back()->with(['success' => 'Data Berhasil Diupdate']);
            }
        } else {
            return Redirect::back()->with(['error' => 'Data Gagal Diupdate']);
        }
    }




    public function histori()
    {
        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        return view('presensi.histori', compact('namabulan'));
    }

    public function gethistori(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $nik = Auth::guard('karyawan')->user()->nik;
        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

        $histori = DB::table('presensi')->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
            ->leftJoin('pengajuan_izin', 'presensi.izin_id', 'pengajuan_izin.izin_id')
            ->leftJoin('master_cuti', 'pengajuan_izin.kode_cuti', 'master_cuti.kode_cuti')
            ->where('presensi.nik', $nik)
            ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
            ->orderBy('tgl_presensi')
            ->get();


        return view('presensi.gethistori', compact('histori', 'namabulan'));
    }

    public function izin(Request $request)
    {
        $nik = Auth::guard('karyawan')->user()->nik;

        if (!empty($request->bulan) && !empty($request->tahun)) {
            $dataizin = DB::table('pengajuan_izin')
                ->leftJoin('master_cuti', 'pengajuan_izin.kode_cuti', '=', 'master_cuti.kode_cuti')
                ->where('nik', $nik)
                ->whereRaw('MONTH(tgl_izin_dari)="' . $request->bulan . '"')
                ->whereRaw('YEAR(tgl_izin_dari)="' . $request->tahun . '"')
                ->orderBy('tgl_izin_dari', 'desc')
                ->get();
        } else {

            $dataizin = DB::table('pengajuan_izin')
                ->leftJoin('master_cuti', 'pengajuan_izin.kode_cuti', '=', 'master_cuti.kode_cuti')
                ->where('nik', $nik)
                ->orderBy('tgl_izin_dari', 'desc')
                ->limit(5)
                ->orderBy('tgl_izin_dari', 'desc')->get();
        }

        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        return view('presensi.izin', compact('dataizin', 'namabulan'));
    }

    public function createizin()
    {

        return view('presensi.createizin');
    }
    public function storeizin(Request $request)
    {
        $nik = Auth::guard('karyawan')->user()->nik;
        $tgl_izin = $request->tgl_izin;
        $status_izin = $request->status_izin;
        $keterangan = $request->keterangan;
        $foto_izin = null;

        // Check if the request has a file named 'foto_izin'
        if ($request->hasFile('foto_izin')) {
            // Get the file from the request
            $file = $request->file('foto_izin');
            // Create a unique file name
            $fileName = $nik . "." . $file->getClientOriginalExtension();
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
            'tgl_izin' => $tgl_izin,
            'status_izin' => $status_izin,
            'keterangan' => $keterangan,
            'foto_izin' => $foto_izin,
        ];

        // Insert data into the database
        $simpan = DB::table('pengajuan_izin')->insert($data);
        if ($simpan) {
            return redirect('/presensi/izin')->with(['success' => 'Data Berhasil Disimpan']);
        } else {
            return redirect('/presensi/izin')->with(['error' => 'Data Gagal Disimpan']);
        }
    }

    public function monitoring()
    {
        return view('presensi.monitoring');
    }

    public function getpresensi(Request $request)
    {

        // Ambil tanggal dari request
        $tanggal = $request->tanggal;

        $tanggal = Carbon::createFromFormat('Y F d', $tanggal)->toDateString();

        // Query untuk mendapatkan data presensi berdasarkan tanggal
        $presensi = DB::table('presensi')
            ->leftJoin('pengajuan_izin', 'presensi.izin_id', '=', 'pengajuan_izin.izin_id')
            ->join('karyawan', 'presensi.nik', '=', 'karyawan.nik')
            ->select('presensi.*', 'nama_lengkap', 'nama_jabatan', 'keterangan')
            ->where('tgl_presensi', $tanggal)
            ->get();

        // Jika tidak ada data pre

        return view('presensi.getpresensi', compact('presensi'));
    }

    public function laporan()
    {
        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $karyawan = DB::table('karyawan')->orderBy('nama_lengkap')->get();
        return view('presensi.laporanpresensi', compact('namabulan', 'karyawan'));
    }

    public function cetaklaporan(Request $request)
    {
        // Ambil data dari request
        $bulan = $request->bulan;
        $nik = $request->nik;
        $tahun = $request->tahun;


        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

        // Query untuk mendapatkan data presensi berdasarkan tanggal
        $karyawan = DB::table('karyawan')->where('nik', $nik)->first();

        $presensi = DB::table('presensi')
            ->leftJoin('pengajuan_izin', 'presensi.izin_id', '=', 'pengajuan_izin.izin_id')
            ->join('karyawan', 'presensi.nik', '=', 'karyawan.nik')
            ->select('presensi.*', 'nama_lengkap', 'nama_jabatan', 'keterangan')
            ->where('presensi.nik', $nik)
            ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
            ->orderBy('tgl_presensi')
            ->get();



        if (isset($_POST['exportexcel'])) {
            $time = date("H:i:s");

            header("Content-type:application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=laporan Presensi Karyawan Bulan $namabulan[$bulan] $tahun.xls");

            // Pastikan variabel $nama_lengkap dilewatkan ke view
            return view('presensi.cetaklaporanexcel', compact('bulan', 'tahun', 'namabulan', 'karyawan', 'presensi'));
        }

        // Pastikan variabel $nama_lengkap dilewatkan ke view
        return view('presensi.cetaklaporan', compact('bulan', 'tahun', 'namabulan', 'karyawan', 'presensi'));
    }

    public function tampilkanpeta(Request $request)
    {
        $id = $request->id;
        $presensi = DB::table('presensi')->where('id', $id)->join('karyawan', 'presensi.nik', '=', 'karyawan.nik')->first();
        $lok_kantor = DB::table('konfigurasi_lokasi')->where('id', 1)->first();

        return view('presensi.showmap', compact('presensi', 'lok_kantor'));
    }


    public function rekap()
    {
        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

        return view('presensi.rekap', compact('namabulan'));
    }
    public function cetakrekap(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $dari = $tahun . "-" . $bulan . "-01";
        $sampai = date("Y-m-t", strtotime($dari));
        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

        while (strtotime($dari) <= strtotime($sampai)) {
            $rangetanggal[] = $dari;
            $dari = date("Y-m-d", strtotime("+1 day", strtotime($dari)));
        }

        $jmlhari = count($rangetanggal);
        $lastrange = $jmlhari - 1;
        $sampai = $rangetanggal[$lastrange];

        if ($jmlhari == 30) {
            array_push($rangetanggal, NULL);
        } else if ($jmlhari == 29) {
            array_push($rangetanggal, NULL, NULL);
        } else if ($jmlhari == 28) {
            array_push($rangetanggal, NULL, NULL, NULL);
        }

        $query = Karyawan::query();
        $query->selectRaw('karyawan.nik, nama_lengkap, nama_jabatan,
        tgl_1,
        tgl_2,
        tgl_3,
        tgl_4,
        tgl_5,
        tgl_6,
        tgl_7,
        tgl_8,
        tgl_9,
        tgl_10,
        tgl_11,
        tgl_12,
        tgl_13,
        tgl_14,
        tgl_15,
        tgl_16,
        tgl_17,
        tgl_18,
        tgl_19,
        tgl_20,
        tgl_21,
        tgl_22,
        tgl_23,
        tgl_24,
        tgl_25,
        tgl_26,
        tgl_27,
        tgl_28,
        tgl_29,
        tgl_30,
        tgl_31');

        $query->leftJoin(
            DB::raw("(
            SELECT presensi.nik,
                MAX(IF(tgl_presensi = '$rangetanggal[0]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_1,
                MAX(IF(tgl_presensi = '$rangetanggal[1]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_2,
                MAX(IF(tgl_presensi = '$rangetanggal[2]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_3,
                MAX(IF(tgl_presensi = '$rangetanggal[3]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_4,
                MAX(IF(tgl_presensi = '$rangetanggal[4]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_5,
                MAX(IF(tgl_presensi = '$rangetanggal[5]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_6,
                MAX(IF(tgl_presensi = '$rangetanggal[6]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_7,
                MAX(IF(tgl_presensi = '$rangetanggal[7]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_8,
                MAX(IF(tgl_presensi = '$rangetanggal[8]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_9,
                MAX(IF(tgl_presensi = '$rangetanggal[9]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_10,
                MAX(IF(tgl_presensi = '$rangetanggal[10]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_11,
                MAX(IF(tgl_presensi = '$rangetanggal[11]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_12,
                MAX(IF(tgl_presensi = '$rangetanggal[12]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_13,
                MAX(IF(tgl_presensi = '$rangetanggal[13]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_14,
                MAX(IF(tgl_presensi = '$rangetanggal[14]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_15,
                MAX(IF(tgl_presensi = '$rangetanggal[15]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_16,
                MAX(IF(tgl_presensi = '$rangetanggal[16]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_17,
                MAX(IF(tgl_presensi = '$rangetanggal[17]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_18,
                MAX(IF(tgl_presensi = '$rangetanggal[18]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_19,
                MAX(IF(tgl_presensi = '$rangetanggal[19]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_20,
                MAX(IF(tgl_presensi = '$rangetanggal[20]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_21,
                MAX(IF(tgl_presensi = '$rangetanggal[21]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_22,
                MAX(IF(tgl_presensi = '$rangetanggal[22]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_23,
                MAX(IF(tgl_presensi = '$rangetanggal[23]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_24,
                MAX(IF(tgl_presensi = '$rangetanggal[24]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_25,
                MAX(IF(tgl_presensi = '$rangetanggal[25]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_26,
                MAX(IF(tgl_presensi = '$rangetanggal[26]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_27,
                MAX(IF(tgl_presensi = '$rangetanggal[27]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_28,
                MAX(IF(tgl_presensi = '$rangetanggal[28]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_29,
                MAX(IF(tgl_presensi = '$rangetanggal[29]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_30,
                MAX(IF(tgl_presensi = '$rangetanggal[30]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_31
            FROM presensi
            LEFT JOIN pengajuan_izin ON presensi.izin_id = pengajuan_izin.izin_id
            WHERE tgl_presensi BETWEEN '$rangetanggal[0]' AND '$sampai'
            GROUP BY nik
        ) presensi"),
            function ($join) {
                $join->on('karyawan.nik', '=', 'presensi.nik');
            }
        );

        $query->orderBy('nama_lengkap');
        $rekap = $query->get();

        if (isset($_POST['exportexcel'])) {
            $time = date("H:i:s");


            header("Content-type:application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=Rekap Presensi Karyawan Bulan $namabulan[$bulan] $tahun.xls");
        }

        return view('presensi.cetakrekap', compact('bulan', 'tahun', 'namabulan', 'rekap', 'rangetanggal', 'jmlhari'));
    }

    public function gaji()
    {
        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

        return view('presensi.gaji', compact('namabulan'));
    }
    public function cetakgaji(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $dari = $tahun . "-" . $bulan . "-01";
        $sampai = date("Y-m-t", strtotime($dari));
        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

        while (strtotime($dari) <= strtotime($sampai)) {
            $rangetanggal[] = $dari;
            $dari = date("Y-m-d", strtotime("+1 day", strtotime($dari)));
        }

        $jmlhari = count($rangetanggal);
        $lastrange = $jmlhari - 1;
        $sampai = $rangetanggal[$lastrange];

        if ($jmlhari == 30) {
            array_push($rangetanggal, NULL);
        } else if ($jmlhari == 29) {
            array_push($rangetanggal, NULL, NULL);
        } else if ($jmlhari == 28) {
            array_push($rangetanggal, NULL, NULL, NULL);
        }

        $query = Karyawan::query();
        $query->selectRaw('karyawan.nik, nama_lengkap, jabatan.nama_jabatan, gaji_pokok, tunjangan_tetap, tunjangan_tidak_tetap, gaji_bpjs_ketenagakerjaan, gaji_bpjs_kesehatan, tanggal_gabung,
        tgl_1,
        tgl_2,
        tgl_3,
        tgl_4,
        tgl_5,
        tgl_6,
        tgl_7,
        tgl_8,
        tgl_9,
        tgl_10,
        tgl_11,
        tgl_12,
        tgl_13,
        tgl_14,
        tgl_15,
        tgl_16,
        tgl_17,
        tgl_18,
        tgl_19,
        tgl_20,
        tgl_21,
        tgl_22,
        tgl_23,
        tgl_24,
        tgl_25,
        tgl_26,
        tgl_27,
        tgl_28,
        tgl_29,
        tgl_30,
        tgl_31');

        $query->leftJoin(
            DB::raw("(
            SELECT presensi.nik,
                MAX(IF(tgl_presensi = '$rangetanggal[0]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_1,
                MAX(IF(tgl_presensi = '$rangetanggal[1]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_2,
                MAX(IF(tgl_presensi = '$rangetanggal[2]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_3,
                MAX(IF(tgl_presensi = '$rangetanggal[3]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_4,
                MAX(IF(tgl_presensi = '$rangetanggal[4]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_5,
                MAX(IF(tgl_presensi = '$rangetanggal[5]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_6,
                MAX(IF(tgl_presensi = '$rangetanggal[6]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_7,
                MAX(IF(tgl_presensi = '$rangetanggal[7]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_8,
                MAX(IF(tgl_presensi = '$rangetanggal[8]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_9,
                MAX(IF(tgl_presensi = '$rangetanggal[9]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_10,
                MAX(IF(tgl_presensi = '$rangetanggal[10]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_11,
                MAX(IF(tgl_presensi = '$rangetanggal[11]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_12,
                MAX(IF(tgl_presensi = '$rangetanggal[12]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_13,
                MAX(IF(tgl_presensi = '$rangetanggal[13]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_14,
                MAX(IF(tgl_presensi = '$rangetanggal[14]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_15,
                MAX(IF(tgl_presensi = '$rangetanggal[15]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_16,
                MAX(IF(tgl_presensi = '$rangetanggal[16]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_17,
                MAX(IF(tgl_presensi = '$rangetanggal[17]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_18,
                MAX(IF(tgl_presensi = '$rangetanggal[18]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_19,
                MAX(IF(tgl_presensi = '$rangetanggal[19]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_20,
                MAX(IF(tgl_presensi = '$rangetanggal[20]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_21,
                MAX(IF(tgl_presensi = '$rangetanggal[21]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_22,
                MAX(IF(tgl_presensi = '$rangetanggal[22]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_23,
                MAX(IF(tgl_presensi = '$rangetanggal[23]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_24,
                MAX(IF(tgl_presensi = '$rangetanggal[24]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_25,
                MAX(IF(tgl_presensi = '$rangetanggal[25]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_26,
                MAX(IF(tgl_presensi = '$rangetanggal[26]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_27,
                MAX(IF(tgl_presensi = '$rangetanggal[27]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_28,
                MAX(IF(tgl_presensi = '$rangetanggal[28]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_29,
                MAX(IF(tgl_presensi = '$rangetanggal[29]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_30,
                MAX(IF(tgl_presensi = '$rangetanggal[30]', CONCAT(IFNULL(jam_in,'NA'),'|', IFNULL(jam_out,'NA'),'|', IFNULL(presensi.status_presensi,'NA'),'|', IFNULL(presensi.izin_id,'NA'),'|', IFNULL(keterangan,'NA'),'|'), NULL)) as tgl_31
            FROM presensi
            LEFT JOIN pengajuan_izin ON presensi.izin_id = pengajuan_izin.izin_id
            WHERE tgl_presensi BETWEEN '$rangetanggal[0]' AND '$sampai'
            GROUP BY nik
        ) presensi"),
            function ($join) {
                $join->on('karyawan.nik', '=', 'presensi.nik');
            }
        );

        $query->leftJoin('jabatan', 'karyawan.nama_jabatan', '=', 'jabatan.nama_jabatan');

        $query->orderBy('nama_lengkap');
        $rekap = $query->get();

        if (isset($_POST['exportexcel'])) {
            $time = date("H:i:s");


            header("Content-type:application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=Rekap Presensi Karyawan Bulan $namabulan[$bulan] $tahun.xls");
        }

        return view('presensi.cetakgaji', compact('bulan', 'tahun', 'namabulan', 'rekap', 'rangetanggal', 'jmlhari'));
    }
    public function izinsakit(Request $request)
    {
        $query = Pengajuanizin::query();

        // Parsing tanggal menggunakan Carbon jika diperlukan
        $dari = null;
        $sampai = null;

        if (!empty($request->dari)) {
            try {
                $dari = Carbon::createFromFormat('Y F d', $request->dari)->toDateString();
            } catch (\Exception $e) {
                // Tangani kesalahan format tanggal
            }
        }

        if (!empty($request->sampai)) {
            try {
                $sampai = Carbon::createFromFormat('Y F d', $request->sampai)->toDateString();
            } catch (\Exception $e) {
                // Tangani kesalahan format tanggal
            }
        }

        // Query select
        $query->select('pengajuan_izin.izin_id', 'tgl_izin_dari', 'tgl_izin_sampai', 'pengajuan_izin.nik', 'nama_lengkap', 'foto_izin', 'nama_jabatan', 'status_izin', 'keterangan', 'status_approved');
        $query->join('karyawan', 'pengajuan_izin.nik', '=', 'karyawan.nik');

        // Filter by date range if both dates are provided
        if ($dari && $sampai) {
            $query->whereBetween('tgl_izin_dari', [$dari, $sampai]);
        }

        // Filter by name if provided
        if (!empty($request->nama_lengkap)) {
            $query->where('nama_lengkap', 'LIKE', '%' . $request->nama_lengkap . '%');
        }

        if ($request->status_approved != "") {
            $query->where('status_approved', $request->status_approved);
        }

        // Order by date
        $query->orderBy('tgl_izin_dari', 'desc');

        // Paginate results
        $izinsakit = $query->paginate(5);
        $izinsakit->appends($request->all());

        // Return view with results
        return view('presensi.izinsakit', compact('izinsakit'));
    }

    public function approveizinsakit(Request $request)
    {
        $status_approved = $request->status_approved;
        $id_izinsakit_form = $request->id_izinsakit_form;

        $dataizin = DB::table('pengajuan_izin')->where('izin_id', $id_izinsakit_form)->first();
        $izin_id = $dataizin->izin_id;
        $nik = $dataizin->nik;
        $tgl_dari = $dataizin->tgl_izin_dari;
        $tgl_sampai = $dataizin->tgl_izin_sampai;
        $status_izin = $dataizin->status_izin;
        DB::beginTransaction();
        try {

            if ($status_approved == "1") {

                while (strtotime($tgl_dari) <= strtotime($tgl_sampai)) {

                    DB::table('presensi')->insert([
                        'nik' => $nik,
                        'tgl_presensi' => $tgl_dari,
                        'status_presensi' => $status_izin,
                        'izin_id' => $izin_id


                    ]);
                    $tgl_dari = date("Y-m-d", strtotime("+1 days", strtotime($tgl_dari)));
                }
            }
            DB::table('pengajuan_izin')->where('izin_id', $id_izinsakit_form)->update([
                'status_approved' => $status_approved
            ]);
            DB::commit();
            return redirect()->back()->with(['success' => 'Data Berhasil Diproses']);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['warning' => 'Data Gagal Diproses']);
        }

        //

        //
        // if ($update) {
        //     return Redirect::back()->with(['success' => 'Data Berhasil Diupdate']);
        // } else {
        //     return Redirect::back()->with(['warning' => 'Data Gagal Diupdate']);
        // }
    }

    public function batalkanizinsakit($izin_id)
    {
        DB::beginTransaction();
        try {
            DB::table('pengajuan_izin')->where('izin_id', $izin_id)->update([
                'status_approved' => 0

            ]);
            DB::table('presensi')->where('izin_id', $izin_id)->delete();
            DB::commit();
            return redirect()->back()->with(['success' => 'Data Berhasil Dibatalkan']);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['success' => 'Data Gagal Dibatalkan']);
        }
    }

    public function cekpengajuanizin(Request $request)
    {

        $tgl_izin = $request->tgl_izin;
        $nik = Auth::guard('karyawan')->user()->nik;

        $cek = DB::table('pengajuan_izin')->where('nik', $nik)->where('tgl_izin', $tgl_izin)->count();

        return $cek;
    }

    public function showact($izin_id)
    {
        $dataizin = DB::table('pengajuan_izin')->where('izin_id', $izin_id)->first();

        return view('presensi.showact', compact('dataizin'));
    }
    public function deleteizin($izin_id)
    {
        $cekdataizin = DB::table('pengajuan_izin')->where('izin_id', $izin_id)->first();
        $foto_izin = $cekdataizin->foto_izin;

        try {
            DB::table('pengajuan_izin')->where('izin_id', $izin_id)->delete();
            if ($foto_izin != null) {
                Storage::delete('public/uploads/izin/' . $foto_izin);
            }
            return redirect('/presensi/izin')->with(['success' => 'Data Berhasil Dihapus']);
        } catch (\Throwable $e) {
            return redirect('/presensi/izin')->with(['success' => 'Data Gagal Dihapus']);
        }
    }
}
