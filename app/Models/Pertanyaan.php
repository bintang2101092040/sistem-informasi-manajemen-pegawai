<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    protected $table = 'pertanyaan';
    public function kategori_pertanyaan()
    {
        return $this->belongsTo(Kategori::class);
    }
}
