<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'nama_paket' => '11 Diamond - Paket Pemula',
                'jumlah_diamond' => 11,
                'harga' => 3000,
                'status' => 'tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_paket' => '86 Diamond - Paket Standar',
                'jumlah_diamond' => 86,
                'harga' => 20000,
                'status' => 'tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_paket' => '172 Diamond - Paket Populer',
                'jumlah_diamond' => 172,
                'harga' => 40000,
                'status' => 'tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_paket' => '257 Diamond - Paket Hemat',
                'jumlah_diamond' => 257,
                'harga' => 60000,
                'status' => 'tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_paket' => '514 Diamond - Paket Pro',
                'jumlah_diamond' => 514,
                'harga' => 115000,
                'status' => 'tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_paket' => '706 Diamond - Paket Expert',
                'jumlah_diamond' => 706,
                'harga' => 150000,
                'status' => 'tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_paket' => '1069 Diamond - Paket Master',
                'jumlah_diamond' => 1069,
                'harga' => 225000,
                'status' => 'tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_paket' => '1412 Diamond - Paket Sultan',
                'jumlah_diamond' => 1412,
                'harga' => 300000,
                'status' => 'tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_paket' => 'Weekly Diamond Pass',
                'jumlah_diamond' => 220,
                'harga' => 28000,
                'status' => 'tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_paket' => 'Twilight Pass',
                'jumlah_diamond' => 0, // bisa disesuaikan
                'harga' => 140000,
                'status' => 'habis',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('products')->insert($products);
    }
}
