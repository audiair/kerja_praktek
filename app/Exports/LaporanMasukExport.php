<?php

namespace App\Exports;

use App\Models\BarangMasuk;
use App\Models\LaporanMasuk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanMasukExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function array(): array
    {
        return BarangMasuk::getDataBarang_masuks();
    }

    public function headings(): array
    {
        return [
            'No',
            'Tanggal Masuk',
            'Barang',
            'Jumlah Masuk',
            'Total Harga'
        ];
    }

    public function collection()
    {
        return BarangMasuk::with('barang')->get();
    }
}
