<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class KaryawanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('nama_karyawan');

        $query = Karyawan::query()
            ->leftJoin('cabang', 'karyawan.kode_cabang', '=', 'cabang.kode_cabang')
            ->select('karyawan.*', 'cabang.nama_cabang');

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'LIKE', '%' . $search . '%')
                    ->orWhere('nama_jabatan', 'LIKE', '%' . $search . '%');
            });
        }

        $query->orderByRaw("CASE WHEN nama_jabatan = 'Direktur' THEN 0 ELSE 1 END")
            ->orderBy('nama_jabatan');

        $karyawan = $query->paginate(5);
        $cabang = DB::table('cabang')->orderBy('kode_cabang')->get();
        $jabatan = DB::table('jabatan')->orderBy('nama_jabatan')->get();

        return view('karyawan.index', compact('karyawan', 'cabang', 'jabatan'));
    }
    public function indexpertanyaan(Request $request)
    {
        $search = $request->input('nama_karyawan');

        $query = Karyawan::query();

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'LIKE', '%' . $search . '%')
                    ->orWhere('nama_jabatan', 'LIKE', '%' . $search . '%');
            });
        }

        $karyawan = $query->paginate(5);

        return view('karyawan.pertanyaan', compact('karyawan'));
    }


    public function store(Request $request)
    {


        // Proses penyimpanan data seperti sebelumnya
        $nik = $request->nik;
        $nama_lengkap = $request->nama_lengkap;
        $nama_jabatan = $request->nama_jabatan;
        $no_hp = $request->no_hp;
        $kode_cabang = $request->kode_cabang;
        $password = Hash::make('12345');
        $jenis_kelamin = $request->jenis_kelamin;
        $tempat_tgl_lahir = $request->tempat_tgl_lahir;
        $no_kk = $request->no_kk;
        $alamat_ktp = $request->alamat_ktp;
        $alamat_domisili = $request->alamat_domisili;
        $nik_karyawan = $request->nik_karyawan;
        $tanggal_gabung = $request->tanggal_gabung;
        $bpjs_kesehatan = $request->bpjs_kesehatan;
        $bpjs_ketenagakerjaan = $request->bpjs_ketenagakerjaan;
        $rek_mandiri = $request->rek_mandiri;
        $email = $request->email;
        $npwp = $request->npwp;
        $golongan_darah = $request->golongan_darah;
        $data_keluarga = $request->data_keluarga;
        $status = $request->status;

        if ($request->hasFile('foto')) {
            $foto = $nik . "." . $request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = null;
        }

        try {
            $data = [
                'nik' => $nik,
                'nama_lengkap' => $nama_lengkap,
                'nama_jabatan' => $nama_jabatan,
                'no_hp' => $no_hp,
                'kode_cabang' => $kode_cabang,
                'jenis_kelamin' => $jenis_kelamin,
                'tempat_tgl_lahir' => $tempat_tgl_lahir,
                'no_kk' => $no_kk,
                'alamat_ktp' => $alamat_ktp,
                'alamat_domisili' => $alamat_domisili,
                'nik_karyawan' => $nik_karyawan,
                'tanggal_gabung' => $tanggal_gabung,
                'bpjs_kesehatan' => $bpjs_kesehatan,
                'bpjs_ketenagakerjaan' => $bpjs_ketenagakerjaan,
                'rek_mandiri' => $rek_mandiri,
                'email' => $email,
                'npwp' => $npwp,
                'golongan_darah' => $golongan_darah,
                'data_keluarga' => $data_keluarga,
                'status' => $status,
                'foto' => $foto,
                'password' => $password,
            ];

            $simpan = DB::table('karyawan')->insert($data);
            if ($simpan) {
                if ($request->hasFile('foto')) {
                    $folderPath = "public/uploads/karyawan/";
                    $request->file('foto')->storeAs($folderPath, $foto);
                }
                return Redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
            }
        } catch (\Exception $e) {
            if ($e->getCode() == 23000) {
                $message = "Data Dengan NIK " . $nik . " Sudah Ada";
            } else {
                $message = $e->getMessage();
            }
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan, ' . $message]);
        }
    }


    public function edit(Request $request)
    {
        $nik = $request->nik;
        $karyawan = DB::table('karyawan')->where('nik', $nik)->first();
        $cabang = DB::table('cabang')->orderBy('kode_cabang')->get();
        $jabatan = DB::table('jabatan')->orderBy('nama_jabatan')->get();





        return view('karyawan.edit', compact('karyawan', 'cabang', 'jabatan'));
    }
    public function view(Request $request)
    {
        $nik = $request->nik;
        $karyawan = DB::table('karyawan')->where('nik', $nik)->first();
        $cabang = DB::table('cabang')->orderBy('kode_cabang')->get();
        $jabatan = DB::table('jabatan')->orderBy('nama_jabatan')->get();

        return view('karyawan.view', compact('karyawan', 'cabang', 'jabatan'));
    }
    public function update(Request $request)
    {
        $nik = $request->nik;
        $nama_lengkap = $request->nama_lengkap;
        $nama_jabatan = $request->nama_jabatan;
        $no_hp = $request->no_hp;
        $kode_cabang = $request->kode_cabang;
        $jenis_kelamin = $request->jenis_kelamin;
        $tempat_tgl_lahir = $request->tempat_tgl_lahir;
        $no_kk = $request->no_kk;
        $alamat_ktp = $request->alamat_ktp;
        $alamat_domisili = $request->alamat_domisili;
        $nik_karyawan = $request->nik_karyawan;
        $tanggal_gabung = $request->tanggal_gabung;
        $bpjs_kesehatan = $request->bpjs_kesehatan;
        $bpjs_ketenagakerjaan = $request->bpjs_ketenagakerjaan;
        $rek_mandiri = $request->rek_mandiri;
        $email = $request->email;
        $npwp = $request->npwp;
        $golongan_darah = $request->golongan_darah;
        $data_keluarga = $request->data_keluarga;
        $status = $request->status;
        $old_foto = $request->old_foto;
        if ($request->hasFile('foto')) {
            $foto = $nik . "." . $request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = $old_foto;
        }

        try {
            $data = [
                'nik' => $nik,
                'nama_lengkap' => $nama_lengkap,
                'nama_jabatan' => $nama_jabatan,
                'no_hp' => $no_hp,
                'kode_cabang' => $kode_cabang,
                'jenis_kelamin' => $jenis_kelamin,
                'tempat_tgl_lahir' => $tempat_tgl_lahir,
                'no_kk' => $no_kk,
                'alamat_ktp' => $alamat_ktp,
                'alamat_domisili' => $alamat_domisili,
                'nik_karyawan' => $nik_karyawan,
                'tanggal_gabung' => $tanggal_gabung,
                'bpjs_kesehatan' => $bpjs_kesehatan,
                'bpjs_ketenagakerjaan' => $bpjs_ketenagakerjaan,
                'rek_mandiri' => $rek_mandiri,
                'email' => $email,
                'npwp' => $npwp,
                'golongan_darah' => $golongan_darah,
                'data_keluarga' => $data_keluarga,
                'status' => $status,
                'foto' => $foto,


            ];
            $update = DB::table('karyawan')->where('nik', $nik)->update($data);
            if ($update) {
                if ($request->hasFile('foto')) {
                    $folderPath = "public/uploads/karyawan/";
                    $folderPathOld = "public/uploads/karyawan/" . $old_foto;
                    Storage::delete($folderPathOld);
                    $request->file('foto')->storeAs($folderPath, $foto);
                }
                return Redirect::back()->with(['success' => 'Data Berhasil Diupdate']);
            }
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Data Gagal Diupdate']);
        }
    }

    public function delete($nik)
    {
        $delete = DB::table('karyawan')->where('nik', $nik)->delete();
        if ($delete) {
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
        }
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

    public function resetpassword($nik)
    {
        $nik = Crypt::decrypt($nik);
        $password = Hash::make('12345');

        $reset = DB::table('karyawan')->where('nik', $nik)->update([
            'password' => $password
        ]);

        if ($reset) {
            return Redirect::back()->with(['success' => 'Password Berhasil Di Reset']);
        } else {
            return Redirect::bback()->with(['warning' => 'Password Gagal Di Reset']);
        }
    }
}
