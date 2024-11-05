<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    use HasFactory;

    // Jika nama tabel tidak sesuai konvensi (plural form)
    protected $table = 'cabang';

    // Primary key yang digunakan, jika berbeda dari 'id'
    protected $primaryKey = 'kode_cabang';

    // Untuk primary key bukan auto-increment
    public $incrementing = false;

    // Tipe primary key
    protected $keyType = 'string';

    // Atribut yang dapat diisi massal
    protected $fillable = [
        'kode_cabang',
        'nama_cabang',
        'alamat',
        'no_telp',
    ];
}
