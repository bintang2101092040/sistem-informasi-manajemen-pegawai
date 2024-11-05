<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CutiController extends Controller
{
    public function index()
    {
        $cuti = DB::table('master_cuti')->orderBy('kode_cuti', 'asc')->get();
        return view('cuti.index', compact('cuti'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'kode_cuti' => 'required|string|max:3',
            'nama_cuti' => 'required|string',
            'jml_hari' => 'required|integer',
        ], [
            'kode_cuti.required' => 'Kode cuti wajib diisi.',
            'kode_cuti.max' => 'Kode cuti terlalu panjang. Maksimal panjang karakter adalah :max karakter.',
            'nama_cuti.required' => 'Nama Cuti wajib diisi.',
            'jml_hari.required' => 'Jumlah Hari wajib diisi.',
            'jml_hari.integer' => 'Jumlah Hari wajib angka.',
        ]);

        // Ambil data input
        $data = $request->only(['kode_cuti', 'nama_cuti', 'jml_hari']);

        // Periksa apakah data sudah ada
        $cek = DB::table('master_cuti')->where('kode_cuti', $data['kode_cuti'])->count(); // Perbaiki kondisi pengecekan

        if ($cek > 0) {
            return redirect()->back()->with('warning', 'Data cuti sudah ada');
        }

        // Simpan data
        try {
            $simpan = DB::table('master_cuti')->insert($data);
            if ($simpan) {
                return redirect()->back()->with('success', 'Data berhasil disimpan');
            } else {
                return redirect()->back()->with('warning', 'Data gagal disimpan, mungkin kode cuti tidak ditemukan');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('warning', 'Data gagal disimpan: ' . $e->getMessage());
        }
    }

    public function edit(Request $request)
    {
        $kode_cuti = $request->kode_cuti;
        $cuti = DB::table('master_cuti')->where('kode_cuti', $kode_cuti)->first();
        return view('cuti.edit', compact('cuti'));
    }

    public function update(Request $request, $kode_cuti)
    {
        // Validasi input
        $request->validate([
            'nama_cuti' => 'required|string',
            'jml_hari' => 'required|integer',
        ], [
            'nama_cuti.required' => 'Nama cuti wajib diisi.',
            'jml_hari.required' => 'Jumlah hari wajib diisi.',
            'jml_hari.integer' => 'Jumlah hari wajib angka.',
        ]);

        $data = [
            'nama_cuti' => $request->nama_cuti,
            'jml_hari' => $request->jml_hari,
        ];

        // Update data di database
        try {
            $update = DB::table('master_cuti')
                ->where('kode_cuti', $kode_cuti)
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



    public function delete($kode_cuti)
    {
        $delete = DB::table('master_cuti')->where('kode_cuti', $kode_cuti)->delete();
        if ($delete) {
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
        }
    }
}
