<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanKeluarController extends Controller
{
    public function index(){
        $data['barang_keluars'] = BarangKeluar::with('barang')->get();
        return view('laporan_keluar.index',$data);
    }

    public function print(){
        $barang_keluar = BarangKeluar::all();

        $pdf = PDF::loadview('laporan_keluar.print', ['barang_keluars' => $barang_keluar]);
        return $pdf->download('laporan_keluar.pdf');
    }

    public function filter($tgl_awal, $tgl_akhir){
        $barang_keluar = BarangKeluar::with('barang')->whereBetween('tgl_keluar',[$tgl_awal,$tgl_akhir])->get();
        $pdf = PDF::loadview('laporan_keluar.cetak_filter', ['barang_keluars' => $barang_keluar]);
        return $pdf->download('laporan_keluar_pertanggal.pdf');
    }
}
