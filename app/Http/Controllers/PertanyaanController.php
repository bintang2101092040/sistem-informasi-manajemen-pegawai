<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Pertanyaan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class PertanyaanController extends Controller
{
    public function index(Request $request)
    {

        $query = Pertanyaan::query();
        $query->select('pertanyaan.*', 'nama_kategori');
        $query->join('kategori_pertanyaan', 'pertanyaan.kode_kategori', '=', 'kategori_pertanyaan.kode_kategori');
        $query->orderBy('pertanyaan.kode_kategori');
        if (!empty($request->kode_kategori)) {
            $query->where('pertanyaan.kode_kategori', $request->kode_kategori);
        }
        $pertanyaan = $query->paginate(5);



        $kategori = DB::table('kategori_pertanyaan')->orderBy('kode_kategori')->get();
        return view('pertanyaan.index', compact('pertanyaan', 'kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pertanyaan' => 'required|string|max:255',
            'kode_kategori' => 'required|string|max:10',
        ]);

        DB::table('pertanyaan')->insert([
            'pertanyaan' => $request->pertanyaan,
            'kode_kategori' => $request->kode_kategori,
        ]);

        return redirect('/pertanyaan')->with('success', 'Data pertanyaan berhasil ditambahkan.');
    }

    public function edit(Request $request)
    {
        $pertanyaan_id = $request->pertanyaan_id;

        // Menggunakan Query Builder untuk mengambil data pertanyaan
        $pertanyaan = DB::table('pertanyaan')
            ->where('pertanyaan_id', $pertanyaan_id)
            ->first();

        $kategori = DB::table('kategori_pertanyaan')->get();

        // Mengembalikan view untuk modal edit dengan data pertanyaan
        return view('pertanyaan.edit', compact('pertanyaan', 'kategori'));
    }

    public function update(Request $request, $pertanyaan_id)
    {
        $request->validate([
            'pertanyaan' => 'required|string|max:255',
            'kode_kategori' => 'required|string|max:10',
        ]);

        DB::table('pertanyaan')
            ->where('pertanyaan_id', $pertanyaan_id)
            ->update([
                'pertanyaan' => $request->pertanyaan,
                'kode_kategori' => $request->kode_kategori,
            ]);

        return redirect('/pertanyaan')->with('success', 'Data pertanyaan berhasil diperbarui.');
    }

    public function delete($pertanyaan_id)
    {
        DB::table('pertanyaan')
            ->where('pertanyaan_id', $pertanyaan_id)
            ->delete();

        return redirect('/pertanyaan')->with('warning', 'Data pertanyaan berhasil dihapus.');
    }
}
