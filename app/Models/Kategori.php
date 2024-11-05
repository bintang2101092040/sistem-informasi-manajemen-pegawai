<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'kategori_pertanyaan';

    public function pertanyaan()
    {
        return $this->hasMany(Pertanyaan::class);
    }
}
