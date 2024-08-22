<?php

namespace App\Exports;

use App\Models\BarangKeluar;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanKeluarExport implements FromArray, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function array(): array
    {
        return BarangKeluar::getDataBarangKeluars();
    }

    public function headings(): array
    {
        return [
            'No',
            'Tanggal Keluar',
            'Barang',
            'Jumlah Keluar',
            'Total Harga',
            'Keterangan'
        ];
    }

    public function collection()
    {
        return BarangKeluar::with('barang')->get();
    }
}
