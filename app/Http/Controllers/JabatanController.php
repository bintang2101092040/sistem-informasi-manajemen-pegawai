<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class JabatanController extends Controller
{
    public function index()
    {
        $jabatan = DB::table('jabatan')->orderBy('nama_jabatan')->get();
        return view('jabatan.index', compact('jabatan'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_jabatan' => 'required|string|max:255',
            'gaji_pokok' => 'required|numeric',
            'tunjangan_tetap' => 'required|numeric',
            'tunjangan_tidak_tetap' => 'nullable|numeric',
            'gaji_bpjs_ketenagakerjaan' => 'required|numeric',
            'gaji_bpjs_kesehatan' => 'required|numeric',
        ], [
            'nama_jabatan.required' => 'Nama Jabatan wajib diisi.',
            'gaji_pokok.required' => 'Gaji Pokok wajib diisi.',
            'tunjangan_tetap.required' => 'Tunjangan Tetap wajib diisi.',
            'gaji_bpjs_ketenagakerjaan.required' => 'BPJS Ketenagakerjaan wajib diisi.',
            'gaji_bpjs_kesehatan.required' => 'BPJS Kesehatan wajib diisi.',
        ]);

        // Menghapus tanda titik dari input currency
        $nama_jabatan = $request->input('nama_jabatan');
        $gaji_pokok = str_replace('.', '', $request->input('gaji_pokok'));
        $tunjangan_tetap = str_replace('.', '', $request->input('tunjangan_tetap'));
        $tunjangan_tidak_tetap = str_replace('.', '', $request->input('tunjangan_tidak_tetap')) ?: 0;
        $gaji_bpjs_ketenagakerjaan = str_replace('.', '', $request->input('gaji_bpjs_ketenagakerjaan'));
        $gaji_bpjs_kesehatan = str_replace('.', '', $request->input('gaji_bpjs_kesehatan'));

        // Data yang akan disimpan
        $data = [
            'nama_jabatan' => $nama_jabatan,
            'gaji_pokok' => $gaji_pokok,
            'tunjangan_tetap' => $tunjangan_tetap,
            'tunjangan_tidak_tetap' => $tunjangan_tidak_tetap,
            'gaji_bpjs_ketenagakerjaan' => $gaji_bpjs_ketenagakerjaan,
            'gaji_bpjs_kesehatan' => $gaji_bpjs_kesehatan
        ];

        // Menyimpan data ke database
        try {
            DB::table('jabatan')->insert($data);
            return Redirect::back()->with('success', 'Data Berhasil Disimpan');
        } catch (\Exception $e) {
            return Redirect::back()->with('warning', 'Data Gagal Disimpan: ' . $e->getMessage());
        }
    }

    public function edit(Request $request)
    {
        $nama_jabatan = $request->nama_jabatan;
        $jabatan = DB::table('jabatan')->where('nama_jabatan', $nama_jabatan)->first();
        return view('jabatan.edit', compact('jabatan'));
    }
    public function update(Request $request, $nama_jabatan)
    {
        // Validasi input
        $request->validate([
            'gaji_pokok' => 'required|numeric',
            'tunjangan_tetap' => 'required|numeric',
            'tunjangan_tidak_tetap' => 'nullable|numeric',
            'gaji_bpjs_ketenagakerjaan' => 'required|numeric',
            'gaji_bpjs_kesehatan' => 'required|numeric',
        ], [
            'gaji_pokok.required' => 'Gaji Pokok wajib diisi.',
            'tunjangan_tetap.required' => 'Tunjangan Tetap wajib diisi.',
            'gaji_bpjs_ketenagakerjaan.required' => 'BPJS Ketenagakerjaan wajib diisi.',
            'gaji_bpjs_kesehatan.required' => 'BPJS Kesehatan wajib diisi.',
        ]);

        // Menghapus tanda titik dari input currency
        $gaji_pokok = str_replace('.', '', $request->gaji_pokok);
        $tunjangan_tetap = str_replace('.', '', $request->tunjangan_tetap);
        $tunjangan_tidak_tetap = str_replace('.', '', $request->tunjangan_tidak_tetap) ?: 0;
        $gaji_bpjs_ketenagakerjaan = str_replace('.', '', $request->gaji_bpjs_ketenagakerjaan);
        $gaji_bpjs_kesehatan = str_replace('.', '', $request->gaji_bpjs_kesehatan);

        // Data yang akan diupdate
        $data = [
            'gaji_pokok' => $gaji_pokok,
            'tunjangan_tetap' => $tunjangan_tetap,
            'tunjangan_tidak_tetap' => $tunjangan_tidak_tetap,
            'gaji_bpjs_ketenagakerjaan' => $gaji_bpjs_ketenagakerjaan,
            'gaji_bpjs_kesehatan' => $gaji_bpjs_kesehatan
        ];

        // Update data di database
        try {
            $update = DB::table('jabatan')
                ->where('nama_jabatan', $nama_jabatan)
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



    public function delete($nama_jabatan)
    {
        $delete = DB::table('jabatan')->where('nama_jabatan', $nama_jabatan)->delete();
        if ($delete) {
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
        }
    }
}
