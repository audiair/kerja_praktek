<?php

namespace App\Http\Controllers;

use App\Exports\LaporanMasukExport;
use App\Models\BarangMasuk;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class LaporanMasukController extends Controller
{
    public function index(){
        $data['barang_masuks'] = BarangMasuk::with('barang')->get();
        return view('laporan_masuk.index',$data);
    }

    public function print(){
        $barang_masuk = BarangMasuk::all();
        
        // Ambil nama user yang sedang login
        $user = Auth::user()->name;

        // Atur locale ke Indonesia
        Carbon::setLocale('id');
        
        // Ambil waktu saat ini (hari dan tanggal cetak)
        $printDate = Carbon::now()->translatedFormat('l, d F Y'); // contoh format: "Monday, 26 September 2024"

        $pdf = PDF::loadview('laporan_masuk.print', [
            'barang_masuks' => $barang_masuk,
            'user' => $user,
            'printDate' => $printDate
        ]);
        return $pdf->download('laporan_brgmasuk.pdf');
    }

    public function filter($tgl_awal, $tgl_akhir){
        // dd("Tanggal Awal :".$tgl_awal, "Tanggal Akhir :".$tgl_akhir);

        $user = Auth::user()->name;

        // Atur locale ke Indonesia
        Carbon::setLocale('id');

        // Ambil waktu saat ini (hari dan tanggal cetak)
        $printDate = Carbon::now()->translatedFormat('l, d F Y'); // contoh format: "Monday, 26 September 2024"

        $barang_masuk = BarangMasuk::with('barang')->whereBetween('tgl_masuk',[$tgl_awal,$tgl_akhir])->get();
        $pdf = PDF::loadview('laporan_masuk.cetak_filter', [
            'barang_masuks' => $barang_masuk,
            'user' => $user,
            'printDate' => $printDate
        ]);
        return $pdf->download('laporan_brgmasuk_pertanggal.pdf');
    }

    public function export(){
        return Excel::download(new LaporanMasukExport, 'laporan_brgmasuk.xlsx');
    }
}
