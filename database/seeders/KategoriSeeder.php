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
                    'kategori_barang'=>'Pakan Hewan',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'kategori_barang'=>'Aksesoris Hewan',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'kategori_barang'=>'Perlengkapan Hewan',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'kategori_barang' => 'Mainan Hewan',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]
        );
    }
}
