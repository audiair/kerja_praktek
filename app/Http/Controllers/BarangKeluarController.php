<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    public function index(){
        return view('barang_keluar.index');
    }

    public function create(){
        return view('barang_keluar.create');
    }
}
