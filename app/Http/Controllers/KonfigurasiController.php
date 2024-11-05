<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class KonfigurasiController extends Controller
{
    public function lokasikantor()
    {
        $lok_kantor = DB::table('konfigurasi_lokasi')->where('id', 1)->first();
        return view('konfigurasi.lokasikantor', compact('lok_kantor'));
    }
    public function updatelokasikantor(Request $request)
    {
        // Validasi input
        $request->validate([
            'lokasi_kantor' => 'required|string',
            'radius' => 'required|numeric',
        ], [
            'lokasi_kantor.required' => 'Lokasi kantor wajib diisi.',
            'lokasi_kantor.string' => 'Lokasi kantor harus berupa teks.',
            'radius.required' => 'Radius wajib diisi.',
            'radius.numeric' => 'Radius harus berupa angka.',
        ]);

        // Ambil data input
        $lokasi_kantor = $request->lokasi_kantor;
        $radius = $request->radius;

        // Update data di database
        try {
            $update = DB::table('konfigurasi_lokasi')->where('id', 1)->update([
                'lokasi_kantor' => $lokasi_kantor,
                'radius' => $radius
            ]);

            if ($update) {
                return redirect()->back()->with('success', 'Data berhasil diubah');
            } else {
                return redirect()->back()->with('warning', 'Data gagal diubah');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('warning', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
