<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    public function index(){
        $data['barang_masuks'] = BarangMasuk::with('barang')->get();
        return view('barang_masuk.index', $data);
    }

    public function create(){
        $data['barangs'] = Barang::pluck('nama_barang','id');
        return view('barang_masuk.create',$data);
    }
}
