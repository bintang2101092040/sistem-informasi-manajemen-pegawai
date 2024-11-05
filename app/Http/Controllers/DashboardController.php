<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use App\Models\Pengajuanizin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    //dasboardindex
    public function index()
    {
        $hariini = date('Y-m-d');
        $bulanini = date('m') * 1;
        $tahunini  = date('Y');
        $nik = Auth::guard('karyawan')->user()->nik;
        $presensihariini = DB::table('presensi')->where('nik', $nik)->where('tgl_presensi', $hariini)->where('status_presensi', 'h')->first();
        $historibulanini = DB::table('presensi')->whereRaw('MONTH(tgl_presensi)="' . $bulanini . '"')
            ->leftJoin('pengajuan_izin', 'presensi.izin_id', 'pengajuan_izin.izin_id')
            ->leftJoin('master_cuti', 'pengajuan_izin.kode_cuti', 'master_cuti.kode_cuti')
            ->where('presensi.nik', $nik)
            ->whereRaw('MONTH(tgl_presensi)="' . $bulanini . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahunini . '"')
            ->orderBy('tgl_presensi', 'desc')
            ->get();

        $rekappresensi = DB::table('presensi')
            ->selectRaw('
        COUNT(CASE WHEN status_presensi = "h" THEN 1 END) as jmlhadir,
        SUM(CASE WHEN status_presensi = "h" AND jam_in > "08:00:00" THEN 1 ELSE 0 END) as jmlterlambat
    ')
            ->where('nik', $nik)
            ->whereRaw('MONTH(tgl_presensi)="' . $bulanini . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahunini . '"')
            ->first();

        $leaderboard = DB::table('presensi')
            ->join('karyawan', 'presensi.nik', '=', 'karyawan.nik')
            ->where('tgl_presensi', $hariini)
            ->where('status_presensi', 'h')
            ->orderBy('jam_in')
            ->take(5)
            ->get();

        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

        $rekapizin = DB::table('pengajuan_izin')
            ->leftJoin('presensi', 'pengajuan_izin.izin_id', 'presensi.izin_id')
            // ->selectRaw('SUM(IF(status_izin="i",1,0)) as jmlizin,SUM(IF(status_izin="s",1,0)) as jmlsakit')
            ->selectRaw('
            COUNT(CASE WHEN status_presensi = "i" THEN 1 END) as jmlizin,
            SUM(CASE WHEN status_presensi = "s" THEN 1 ELSE 0 END) as jmlsakit
        ')
            ->where('pengajuan_izin.nik', $nik)
            ->whereRaw('MONTH(tgl_izin_dari)="' . $bulanini . '"')
            ->whereRaw('YEAR(tgl_izin_dari)="' . $tahunini . '"')
            ->where('status_approved', 1)
            ->first();

        $karyawansakit = DB::table('presensi')
            ->join('karyawan', 'presensi.nik', '=', 'karyawan.nik')
            ->select('karyawan.nama_lengkap', 'karyawan.nama_jabatan', 'presensi.status_presensi', 'presensi.tgl_presensi')
            // Filter untuk izin, ganti menjadi 's' untuk sakit
            ->whereIn('presensi.status_presensi', ['i', 'c', 's'])
            ->where('tgl_presensi', $hariini)
            ->get();




        return view("dashboard.dashboard", compact('presensihariini', 'historibulanini', 'namabulan', 'bulanini', 'tahunini', 'rekappresensi', 'leaderboard', 'rekapizin', 'karyawansakit'));
    }

    public function dashboardadmin(Request $request)
    {
        $hariini = date("Y-m-d");

        // Mengambil data presensi hari ini
        $rekappresensi = DB::table('presensi')
            ->selectRaw('
            COUNT(CASE WHEN status_presensi = "h" THEN 1 END) as jmlhadir,
            SUM(CASE WHEN status_presensi = "h" AND jam_in > "08:00:00" THEN 1 ELSE 0 END) as jmlterlambat
        ')
            ->where('tgl_presensi', $hariini)
            ->first();

        // Mengambil data izin hari ini
        $rekapizin = DB::table('pengajuan_izin')
            ->selectRaw('
            SUM(IF(status_izin="i",1,0)) as jmlizin,
            SUM(IF(status_izin="s",1,0)) as jmlsakit,
            SUM(IF(status_izin="c",1,0)) as jmlcuti
        ')
            ->where('tgl_izin_dari', $hariini)
            ->where('status_approved', 1)
            ->first();

        // Menghitung total karyawan
        $totalKaryawan = DB::table('karyawan')->count();

        // Mengambil data berdasarkan bulan dan tahun


        return view("dashboard.dashboardadmin", compact(
            'rekappresensi',
            'rekapizin',
            'totalKaryawan',


        ));
    }
    //dashboardadmin
    public function dashboardowner()
    {
        // Define date range

        // Mengambil data total gaji per bulan
        $data = DB::select("
        SELECT
            DATE_FORMAT(p.tgl_presensi, '%Y-%m') AS bulan_tahun,
            SUM(
                CAST(j.gaji_pokok AS DECIMAL) +
                COALESCE(CAST(j.tunjangan_tetap AS DECIMAL), 0) +
                COALESCE(CAST(j.tunjangan_tidak_tetap AS DECIMAL), 0)
            ) AS total_gaji
        FROM
            presensi p
        JOIN
            karyawan k ON p.nik = k.nik
        JOIN
            jabatan j ON k.nama_jabatan = j.nama_jabatan
        WHERE
            p.tgl_presensi IS NOT NULL
        GROUP BY
            DATE_FORMAT(p.tgl_presensi, '%Y-%m')
        ORDER BY
            bulan_tahun;
    ");

        // Mendapatkan daftar bulan
        $start = new \DateTime('first day of January this year');
        $end = new \DateTime('last day of December this year');
        $interval = \DateInterval::createFromDateString('1 month');
        $period = new \DatePeriod($start, $interval, $end);

        // Menyiapkan array bulan dengan nilai default 0
        $bulanLabels = [];
        $gajiPerBulan = [];
        foreach ($period as $dt) {
            $bulan = $dt->format('Y-m');
            $bulanLabels[] = $dt->format('F '); // Menggunakan nama bulan dan tahun
            $gajiPerBulan[$bulan] = 0;
        }

        // Mengisi data yang ada
        foreach ($data as $entry) {
            $bulan = $entry->bulan_tahun;
            $bulanLabels[array_search($bulan, array_keys($gajiPerBulan))] = (new \DateTime($bulan . '-01'))->format('F ');
            $gajiPerBulan[$bulan] = $entry->total_gaji;
        }

        // Mengubah array menjadi format yang dibutuhkan
        $gajiPerBulan = array_values($gajiPerBulan);
        // Pass data to the view

        return view('dashboard.dashboardowner', compact('bulanLabels', 'gajiPerBulan'));
    }




    // Implement this method to return the date range
    private function getRangeTanggal()
    {
        // Example implementation to return a range of dates
        return range(1, 31); // Adjust this based on your needs
    }

    public function getPendingCutiCount()
    {
        $pendingCutiCount = Pengajuanizin::where('status_approved', '0')->count();
        return response()->json(['count' => $pendingCutiCount]);
    }

    public function getPendingCutiList()
    {
        $pendingCutiList = Pengajuanizin::where('status_approved', '0')
            ->join('karyawan', 'pengajuan_izin.nik', '=', 'karyawan.nik')
            ->get(['pengajuan_izin.izin_id', 'pengajuan_izin.nik', 'karyawan.nama_lengkap', 'pengajuan_izin.tgl_izin_dari', 'pengajuan_izin.tgl_izin_sampai', 'pengajuan_izin.status_izin']);
        return response()->json($pendingCutiList);
    }
}
