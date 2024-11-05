<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Karyawan extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "karyawan";
    protected $primaryKey = "nik";

    protected $fillable = [
        'nik',
        'nama_lengkap',
        'jabatan',
        'no_hp',
        'foto', // Tambahkan 'foto' ke fillable karena diinput melalui form
        'kode_cabang', // Tambahkan 'foto' ke fillable karena diinput melalui form
        'jenis_kelamin', // Tambahkan 'jenis_kelamin' ke fillable
        'tempat_tgl_lahir', // Tambahkan 'tempat_tgl_lahir' ke fillable
        'no_kk', // Tambahkan 'no_kk' ke fillable
        'alamat_ktp', // Tambahkan 'alamat_ktp' ke fillable
        'alamat_domisili', // Tambahkan 'alamat_domisili' ke fillable
        'nik_karyawan', // Tambahkan 'nik_karyawan' ke fillable
        'tanggal_gabung', // Tambahkan 'tanggal_gabung' ke fillable
        'bpjs_kesehatan', // Tambahkan 'bpjs_kesehatan' ke fillable
        'bpjs_ketenagakerjaan', // Tambahkan 'bpjs_ketenagakerjaan' ke fillable
        'rek_mandiri', // Tambahkan 'rek_mandiri' ke fillable
        'email', // Tambahkan 'email' ke fillable
        'npwp', // Tambahkan 'npwp' ke fillable
        'golongan_darah', // Tambahkan 'golongan_darah' ke fillable
        'data_keluarga', // Tambahkan 'data_keluarga' ke fillable
        'status', // Tambahkan 'status' ke fillable
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
