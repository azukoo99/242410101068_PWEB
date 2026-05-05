<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;

class MahasiswaSeeder extends Seeder
{
    public function run()
    {
        Mahasiswa::insert([
            [
                'nim' => '001',
                'nama' => 'Budi',
                'email' => 'budi@mail.com',
                'jurusan' => 'TI',
                'ipk' => 3.50,
                'semester' => 5,
                'aktif' => true,
                'foto' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nim' => '002',
                'nama' => 'Siti',
                'email' => 'siti@mail.com',
                'jurusan' => 'SI',
                'ipk' => 3.70,
                'semester' => 4,
                'aktif' => true,
                'foto' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nim' => '003',
                'nama' => 'Andi',
                'email' => 'andi@mail.com',
                'jurusan' => 'TI',
                'ipk' => 3.20,
                'semester' => 6,
                'aktif' => false,
                'foto' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nim' => '004',
                'nama' => 'Rina',
                'email' => 'rina@mail.com',
                'jurusan' => 'SI',
                'ipk' => 3.80,
                'semester' => 3,
                'aktif' => true,
                'foto' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nim' => '005',
                'nama' => 'Dika',
                'email' => 'dika@mail.com',
                'jurusan' => 'TI',
                'ipk' => 3.40,
                'semester' => 2,
                'aktif' => true,
                'foto' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
