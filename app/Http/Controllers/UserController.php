<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $role = DB::table('roles')->orderBy('id')->get();
        $query = User::query();

        $query->select('users.*', 'roles.name as role');
        $query->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id');
        $query->join('roles', 'model_has_roles.role_id', '=', 'roles.id');
        if (!empty($request->name)) {
            $query->where('users.name', 'like', '%' . $request->name . '%');
        }
        $users =  $query->paginate(10);
        return view('users.index', compact('users', 'role'));
    }

    public function store(Request $request)
    {
        $nama_user = $request->nama_user;
        $email = $request->email;
        $password = bcrypt($request->password);
        $role = $request->role;

        // Validasi untuk memastikan email unik
        $request->validate([
            'email' => 'required|email|unique:users,email',
        ], [
            'email.unique' => 'Email sudah terdaftar. Silakan gunakan email lain.',
        ]);

        DB::beginTransaction();

        try {
            // Simpan data user dengan role
            $user = User::create([
                'name' => $nama_user,
                'email' => $email,
                'password' => $password,
            ]);

            $user->assignRole($role);

            DB::commit();

            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
        } catch (\Exception $e) {
            DB::rollBack();
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan']);
        }
    }


    public function edit(Request $request)
    {
        $id_user = $request->id_user;
        $role = DB::table('roles')->orderBy('id')->get();
        $user = DB::table('users')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->where('id', $id_user)
            ->first();
        return view('users.edit', compact('role', 'user'));
    }

    public function update(Request $request, $id_user)
    {

        $nama_user = $request->nama_user;
        $email = $request->email;
        $password = bcrypt($request->password);
        $role = $request->role;

        if (isset($request->password)) {
            $data = [
                'name' => $nama_user,
                'email' => $email,
                'password' => $password,
            ];
        } else {
            $data = [
                'name' => $nama_user,
                'email' => $email,
            ];
        }

        DB::beginTransaction();





        // Validasi input
        // $request->validate([
        //     'nama_kategori' => 'required|string',
        // ], [
        //     'nama_kategori.required' => 'Nama kategori wajib diisi.',
        // ]);

        // Data yang akan diupdate
        // $data = [
        //     'nama_kategori' => $request->nama_kategori,
        // ];

        // Update data di database
        try {
            DB::table('users')
                ->where('id', $id_user)
                ->update($data);


            DB::table('model_has_roles')
                ->where('model_id', $id_user)
                ->update([
                    'role_id' => $role
                ]);

            DB::commit();


            return redirect()->back()->with('success', 'Data Berhasil Diupdate');
        } catch (\Exception $e) {

            return redirect()->back()->with('warning', 'Data Gagal Diupdate: ' . $e->getMessage());
        }
    }


    public function delete($id_user)
    {
        $delete = DB::table('users')->where('id', $id_user)->delete();
        if ($delete) {
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
        }
    }
}
