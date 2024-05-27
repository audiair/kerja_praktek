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
                    'kode_kategori'=> 'ABC01',
                    'kategori_barang'=>'Pakan Kucing',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'kode_kategori'=> 'ABC02',
                    'kategori_barang'=>'Pakan Sapi',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'kode_kategori'=> 'ABC03',
                    'kategori_barang'=>'Pakan Ikan',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'kode_kategori'=> 'ABC04',
                    'kategori_barang' => 'Aksesoris Hewan',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]
        );
    }
}
