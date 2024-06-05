<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategoris')->insert(
            [
                [
                    'kode_kategori' => 'PH-01',
                    'kategori_barang'=>'Pakan Hewan',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'kode_kategori' => 'AH-01',
                    'kategori_barang'=>'Aksesoris Hewan',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'kode_kategori' => 'PH-02',
                    'kategori_barang'=>'Perlengkapan Hewan',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'kode_kategori' => 'MH-01',
                    'kategori_barang' => 'Mainan Hewan',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]
        );
    }
}
