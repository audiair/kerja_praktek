<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

class LaporanMasukController extends Controller
{
    public function index(){
        $data['barang_masuks'] = BarangMasuk::with('barang')->get();
        return view('laporan_masuk.index',$data);
    }

    public function print(){
        $data['barang_masuks'] = BarangMasuk::with('barang')->get();
        $pdf = PDF::loadview('barang_masuk.print', ['barang_masuks' => $data]);
        return $pdf->download('data_buku.pdf');

        return view('laporan_masuk.print',$data);
    }

    public function filter($tgl_awal, $tgl_akhir){
        // dd("Tanggal Awal :".$tgl_awal, "Tanggal Akhir :".$tgl_akhir);

        $barang_masuks = BarangMasuk::with('barang')->whereBetween('tgl_masuk',[$tgl_awal,$tgl_akhir])->get();
        return view('laporan_masuk.cetak_filter', compact('barang_masuks'));
    }
}
