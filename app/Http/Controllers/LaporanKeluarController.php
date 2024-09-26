<?php

namespace App\Http\Controllers;

use App\Exports\LaporanKeluarExport;
use App\Models\BarangKeluar;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class LaporanKeluarController extends Controller
{
    public function index(){
        $data['barang_keluars'] = BarangKeluar::with('barang')->get();
        return view('laporan_keluar.index',$data);
    }

    public function print(){
        $barang_keluar = BarangKeluar::all();

        // Ambil nama user yang sedang login
        $user = Auth::user()->name;

        // Atur locale ke Indonesia
        Carbon::setLocale('id');
        
        // Ambil waktu saat ini (hari dan tanggal cetak)
        $printDate = Carbon::now()->translatedFormat('l, d F Y'); // contoh format: "Monday, 26 September 2024"

        $pdf = PDF::loadview('laporan_keluar.print', [
            'barang_keluars' => $barang_keluar,
            'user' => $user,
            'printDate' => $printDate
        ]);
        return $pdf->download('laporan_brgkeluar.pdf');
    }

    public function filter($tgl_awal, $tgl_akhir){
        // Ambil nama user yang sedang login
        $user = Auth::user()->name;

        // Atur locale ke Indonesia
        Carbon::setLocale('id');
        
        // Ambil waktu saat ini (hari dan tanggal cetak)
        $printDate = Carbon::now()->translatedFormat('l, d F Y'); // contoh format: "Monday, 26 September 2024"

        $barang_keluar = BarangKeluar::with('barang')->whereBetween('tgl_keluar',[$tgl_awal,$tgl_akhir])->get();
        $pdf = PDF::loadview('laporan_keluar.cetak_filter', [
            'barang_keluars' => $barang_keluar,
            'user' => $user,
            'printDate' => $printDate
        ]);
        return $pdf->download('laporan_brgkeluar_pertanggal.pdf');
    }

    public function export(){
        return Excel::download(new LaporanKeluarExport, 'laporan_brgkeluar.xlsx');
    }
}
