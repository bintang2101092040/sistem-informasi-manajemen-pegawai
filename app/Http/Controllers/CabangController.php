<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CabangController extends Controller
{
    public function index()
    {
        $cabang = DB::table('cabang')->orderBy('kode_cabang')->get();
        return view('cabang.index', compact('cabang'));
    }

    public function store(Request $request)
    {
        $kode_cabang = $request->kode_cabang;
        $nama_cabang = $request->nama_cabang;
        $lokasi_cabang = $request->lokasi_cabang;
        $radius_cabang = $request->radius_cabang;

        try {
            $data = [
                'kode_cabang' => $kode_cabang,
                'nama_cabang' => $nama_cabang,
                'lokasi_cabang' => $lokasi_cabang,
                'radius_cabang' => $radius_cabang,
            ];
            DB::table('cabang')->insert($data);
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
        } catch (\Exception $e) {

            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan: ']);
        }
    }
    public function edit(Request $request)
    {
        $kode_cabang = $request->kode_cabang;
        $cabang = DB::table('cabang')->where('kode_cabang', $kode_cabang)->first();
        return view('cabang.edit', compact('cabang'));
    }
    public function update(Request $request, $kode_cabang)
    {
        // Validasi input
        $request->validate([
            'nama_cabang' => 'required|string',
            'lokasi_cabang' => 'required|string|',
            'radius_cabang' => 'required|string|max:6',
        ], [
            'nama_cabang.required' => 'Nama Cabang wajib diisi.',
            'lokasi_cabang.required' => 'Lokasi Cabang wajib diisi.',
            'radius_cabang.required' => 'Radius cabang wajib diisi.',
            'radius_cabang.max' => 'Radius Cabang terlalu panjang. Maksimal panjang karakter adalah :max karakter.',
        ]);

        // Data yang akan diupdate
        $data = [
            'nama_cabang' => $request->nama_cabang,
            'radius_cabang' => $request->radius_cabang,
            'lokasi_cabang' => $request->lokasi_cabang
        ];

        // Update data di database
        try {
            $update = DB::table('cabang')
                ->where('kode_cabang', $kode_cabang)
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


    public function delete($kode_cabang)
    {
        $delete = DB::table('cabang')->where('kode_cabang', $kode_cabang)->delete();
        if ($delete) {
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
        }
    }
}
