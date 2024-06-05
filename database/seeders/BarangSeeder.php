<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('barangs')->insert(
            [
                [
                    'kode_barang' => 'A-01',
                    'nama_barang'=>'Harnes',
                    'stok' => '0',
                    'satuan' => 'Pcs',
                    'harga_satuan' => '20000',
                    'created_at' => now(),
                    'updated_at' => now(),
                    'id_kategori'=> '2',
                ],
            ]
        );
    }
}
