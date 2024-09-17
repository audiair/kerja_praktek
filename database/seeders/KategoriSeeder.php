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
                    'kode_kategori' => 'KTG01',
                    'kategori_barang'=>'Pakan Hewan',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]
        );
    }
}
