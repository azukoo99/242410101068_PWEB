<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Mahasiswa;

class MataKuliah extends Model
{
    protected $fillable = ['nama']; // ⬅️ INI YANG PENTING

    public function mahasiswas()
    {
        return $this->belongsToMany(Mahasiswa::class, 'krs');
    }
}
