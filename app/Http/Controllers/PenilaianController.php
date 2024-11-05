<?php

namespace App\Http\Controllers;

use App\Models\Kate;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class PenilaianController extends Controller
{
    public function indexkategori(Request $request)
    {
        $nama_kategori = $request->nama_kategori;
        $query = Kategori::query();
        $query->select('*');
        if (!empty($nama_kategori)) {
            $query->where('nama_kategori', 'like', '%' . $nama_kategori . '%');
        }

        $kategori = $query->get();
        return view('kategori.index', compact('kategori'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'kode_kategori' => 'required|string|max:4',
            'nama_kategori' => 'required|string',
        ], [
            'kode_kategori.required' => 'Kode kategori wajib diisi.',
            'kode_kategori.max' => 'Kode kategori terlalu panjang. Maksimal panjang karakter adalah :max karakter.',
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
        ]);

        // Ambil data input
        $data = $request->only(['kode_kategori', 'nama_kategori']);

        // Periksa apakah data sudah ada
        $cek = DB::table('kategori_pertanyaan')
            ->where('kode_kategori', $data['kode_kategori'])
            ->count(); // Pastikan menggunakan kondisi where yang benar

        if ($cek > 0) {
            return redirect()->back()->with('warning', 'Data Kategori Sudah Ada');
        }

        // Simpan data
        try {
            DB::table('kategori_pertanyaan')->insert($data);
            return redirect()->back()->with('success', 'Data Berhasil Disimpan');
        } catch (\Exception $e) {
            return redirect()->back()->with('warning', 'Data Gagal Disimpan: ' . $e->getMessage());
        }
    }


    public function edit(Request $request)
    {
        $kode_kategori = $request->kode_kategori;
        $kategori = DB::table('kategori_pertanyaan')->where('kode_kategori', $kode_kategori)->first();
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $kode_kategori)
    {
        // Validasi input
        $request->validate([
            'nama_kategori' => 'required|string',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
        ]);

        // Data yang akan diupdate
        $data = [
            'nama_kategori' => $request->nama_kategori,
        ];

        // Update data di database
        try {
            $update = DB::table('kategori_pertanyaan')
                ->where('kode_kategori', $kode_kategori)
                ->update($data);

            if ($update) {
                return redirect()->back()->with('success', 'Data Berhasil Diupdate');
            } else {
                return redirect()->back()->with('warning', 'Data tidak ditemukan atau tidak ada perubahan pada data.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('warning', 'Data Gagal Diupdate: ' . $e->getMessage());
        }
    }


    public function delete($kode_kategori)
    {
        $delete = DB::table('kategori_pertanyaan')->where('kode_kategori', $kode_kategori)->delete();
        if ($delete) {
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
        }
    }






    public function index(Request $request)
    {
        $bulan = $request->input('bulan', date('m')); // Default to current month if not provided
        $tahun = $request->input('tahun', date('Y'));

        // Query karyawan dan filter berdasarkan bulan dan tahun
        $karyawan = DB::table('karyawan')
            ->leftJoin('jawaban', function ($join) use ($bulan, $tahun) {
                $join->on('karyawan.nik', '=', 'jawaban.nik');
            })
            ->select(
                'karyawan.nik',
                'karyawan.nama_lengkap',
                DB::raw('COALESCE(SUM(CASE WHEN MONTH(jawaban.created_at) = ? AND YEAR(jawaban.created_at) = ? THEN jawaban.nilai ELSE 0 END), 0) as total_nilai'),
                DB::raw('COUNT(CASE WHEN MONTH(jawaban.created_at) = ? AND YEAR(jawaban.created_at) = ? THEN jawaban.nilai ELSE NULL END) as evaluation_count')
            )
            ->groupBy('karyawan.nik', 'karyawan.nama_lengkap')
            ->setBindings([$bulan, $tahun, $bulan, $tahun])
            ->paginate(10)
            ->appends(['bulan' => $bulan, 'tahun' => $tahun]);

        // Menghitung status karyawan
        foreach ($karyawan as $employee) {
            $totalScore = $employee->total_nilai;
            $numberOfEvaluations = $employee->evaluation_count;
            $averageScore = $numberOfEvaluations > 0 ? ($totalScore / $numberOfEvaluations) : 0;

            if ($numberOfEvaluations == 0) {
                $employee->status = 'Belum dinilai';
            } elseif ($averageScore >= 4.25) {
                $employee->status = 'Perpanjang PKWT';
            } elseif ($averageScore >= 3.75) {
                $employee->status = 'Perpanjang PKWT';
            } elseif ($averageScore >= 3.0) {
                $employee->status = 'Perpanjang PKWT dengan Catatan';
            } else {
                $employee->status = 'Tidak Perpanjang PKWT';
            }
        }

        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

        return view('evaluations.index', compact('karyawan', 'namabulan', 'bulan', 'tahun'));
    }





    public function create(Request $request, $nik)
    {
        $bulan = $request->query('bulan');
        $tahun = $request->query('tahun');
        $kategori = DB::table('kategori_pertanyaan')->get();
        $pertanyaan = DB::table('pertanyaan')->get();
        $karyawan = DB::table('karyawan')->where('nik', $nik)->first();

        return view('evaluations.create', compact('nik', 'kategori', 'pertanyaan', 'karyawan'));
    }

    public function storenilai(Request $request, $nik)
    {

        $questions = $request->input('questions', []);
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        foreach ($questions as $questionId => $score) {
            DB::table('jawaban')->insert([
                'nik' => $nik,

                'pertanyaan_id' => $questionId,
                'nilai' => $score,
                'created_at' => "$tahun-$bulan-01", // Menggunakan tanggal hari ini

            ]);
        }

        return redirect()->route('evaluations.index')->with('success', 'Penilaian berhasil disimpan!');
    }


    public function show(Request $request, $nik)
    {
        $bulan = (int) $request->input('bulan');
        $tahun = (int) $request->input('tahun');

        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

        // Validasi input bulan
        if ($bulan < 1 || $bulan > 12) {
            return redirect()->back()->withErrors(['bulan' => 'Bulan tidak valid']);
        }

        // Ambil kategori pertanyaan beserta pertanyaannya
        $evaluations = DB::table('jawaban')
            ->join('pertanyaan', 'jawaban.pertanyaan_id', '=', 'pertanyaan.pertanyaan_id')
            ->join('kategori_pertanyaan', 'pertanyaan.kode_kategori', '=', 'kategori_pertanyaan.kode_kategori')
            ->select('kategori_pertanyaan.nama_kategori as kategori', 'pertanyaan.pertanyaan', 'jawaban.nilai')
            ->where('jawaban.nik', $nik)
            ->when($bulan, function ($query, $bulan) {
                return $query->whereRaw('MONTH(jawaban.created_at) = ?', [$bulan]);
            })
            ->when($tahun, function ($query, $tahun) {
                return $query->whereRaw('YEAR(jawaban.created_at) = ?', [$tahun]);
            })
            ->orderBy('kategori_pertanyaan.nama_kategori')
            ->get();

        // Menghitung total nilai dan rata-rata nilai
        $totalNilai = $evaluations->sum('nilai');
        $numberOfEvaluations = $evaluations->count();
        $averageScore = $numberOfEvaluations > 0 ? ($totalNilai / $numberOfEvaluations) : 0;

        // Menentukan status berdasarkan rata-rata nilai
        if ($averageScore >= 4.25) {
            $status = 'Perpanjang PKWT';
        } elseif ($averageScore >= 3.75) {
            $status = 'Perpanjang PKWT';
        } elseif ($averageScore >= 3.0) {
            $status = 'Perpanjang PKWT dengan Catatan';
        } elseif ($averageScore == 0) {
            $status = 'Belum dinilai';
        } else {
            $status = 'Tidak Perpanjang PKWT';
        }

        $karyawan = DB::table('karyawan')->where('nik', $nik)->first();

        return view('evaluations.show', compact('evaluations', 'karyawan', 'bulan', 'tahun', 'namabulan', 'totalNilai', 'status'));
    }




    public function calculate($nik)
    {
        // Menghitung total skor dan rata-rata
        $totalScores = DB::table('jawaban')
            ->select(DB::raw('SUM(nilai) as total_score, COUNT(DISTINCT pertanyaan_id) as total_questions'))
            ->where('nik', $nik)
            ->first();

        $averageScore = ($totalScores->total_score / $totalScores->total_questions) * 5;

        // Klasifikasi nilai
        $status = '';
        if ($averageScore >= 85) {
            $status = 'Perpanjang PKWT';
        } elseif ($averageScore >= 75) {
            $status = 'Perpanjang PKWT';
        } elseif ($averageScore >= 60) {
            $status = 'Perpanjang PKWT dengan Catatan';
        } else {
            $status = 'Tidak Perpanjang PKWT';
        }

        return response()->json(['average_score' => $averageScore, 'status' => $status]);
    }
}
