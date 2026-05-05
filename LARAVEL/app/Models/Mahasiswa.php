<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MataKuliah;

class Mahasiswa extends Model
{
    protected $fillable = [
        'nim',
        'nama',
        'email',
        'jurusan',
        'ipk',
        'semester',
        'aktif',
        'foto'
    ];

    protected $casts = [
        'aktif' => 'boolean',
        'ipk' => 'decimal:2'
    ];

    // local scope
    public function scopeAktif($query)
    {
        return $query->where('aktif', true);
    }

    public function mataKuliahs()
    {
        return $this->belongsToMany(MataKuliah::class, 'krs');
    }
}
