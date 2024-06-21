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
        $data['barangs'] = Barang::select('id', 'nama_barang', 'stok')->get();
        return view('barang_masuk.create', $data);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'tgl_masuk' => 'required',
            'id_barang' => 'required',
            'jml_masuk' => 'required',
            'total_harga' => 'required',
        ]);

        BarangMasuk::create($validated);

        if($request->save == true) {
            return redirect()->route('barang_masuk');
        } else {
            return redirect()->route('barang_masuk.create');
        }
    }

    public function edit(string $id){
        $data['barang_masuks'] = BarangMasuk::find($id);
        $data['barangs'] = Barang::select('id', 'nama_barang', 'stok')->get();
        
        return view('barang_masuk.edit', $data);
    }

    public function update(Request $request, string $id){
        $barang_masuk = BarangMasuk::find($id);

        $validated = $request->validate([
            'tgl_masuk' => 'required',
            'id_barang' => 'required',
            'jml_masuk' => 'required',
            'total_harga' => 'required',
        ]);
        
        BarangMasuk::where('id', $id)->update($validated);

        return redirect()->route('barang_masuk');
    }

    public function destroy(string $id){
        $barang_masuk = BarangMasuk::find($id);
        $barang_masuk->delete();

        return redirect()->route('barang_masuk');
    }
}
