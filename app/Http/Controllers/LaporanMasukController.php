<?php

namespace App\Http\Controllers;

use App\Exports\LaporanMasukExport;
use App\Models\BarangMasuk;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanMasukController extends Controller
{
    public function index(){
        $data['barang_masuks'] = BarangMasuk::with('barang')->get();
        return view('laporan_masuk.index',$data);
    }

    public function print(){
        $barang_masuk = BarangMasuk::all();

        $pdf = PDF::loadview('laporan_masuk.print', ['barang_masuks' => $barang_masuk]);
        return $pdf->download('laporan_masuk.pdf');
    }

    public function filter($tgl_awal, $tgl_akhir){
        // dd("Tanggal Awal :".$tgl_awal, "Tanggal Akhir :".$tgl_akhir);

        $barang_masuk = BarangMasuk::with('barang')->whereBetween('tgl_masuk',[$tgl_awal,$tgl_akhir])->get();
        $pdf = PDF::loadview('laporan_masuk.cetak_filter', ['barang_masuks' => $barang_masuk]);
        return $pdf->download('laporan_masuk_pertanggal.pdf');
    }

    public function export(){
        return Excel::download(new LaporanMasukExport, 'laporan_masuk.xlsx');
    }
}
