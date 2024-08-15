<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use Illuminate\Http\Request;

class LaporanMasukController extends Controller
{
    public function index(){
        $data['barang_masuks'] = BarangMasuk::with('barang')->get();
        return view('laporan_masuk.index',$data);
    }

    public function print(){
        $data['barang_masuks'] = BarangMasuk::with('barang')->get();
        return view('laporan_masuk.print',$data);
    }

    public function filter(Request $request){
        $tgl_awal = $request->tgl_awal;
        $tgl_akhir = $request->tgl_akhir;

        $barang_masuk = BarangMasuk::whereDate('tgl_masuk', '>=', $tgl_awal)
                                    ->whereDate('tgl_masuk', '<=', $tgl_awal)
                                    ->get();

        return view('laporan_masuk.index', compact('barang_masuk'));
    }
}
