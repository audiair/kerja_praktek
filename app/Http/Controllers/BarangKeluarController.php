<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    public function index(){
        $data['barang_keluars'] = BarangKeluar::with('barang')->get();
        return view('barang_keluar.index', $data);
    }

    public function create(){
        $data['barangs'] = Barang::select('id', 'nama_barang', 'stok', 'harga_satuan')->get();
        return view('barang_keluar.create', $data);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'tgl_keluar' => 'required',
            'id_barang' => 'required',
            'jml_keluar' => 'required',
            'total_harga' => 'required',
            'keterangan' => 'required',
        ]);
        
        $total_stok = $request->total_stok;
        $id_barang = $request->id_barang;

        BarangKeluar::create($validated);
        Barang::where('id', $id_barang)->update(['stok' => $total_stok]);

        if($request->save == true) {
            return redirect()->route('barang_keluar');
        } else {
            return redirect()->route('barang_keluar.create');
        }
    }

    public function edit(string $id){
        $data['barang_keluars'] = BarangKeluar::find($id);
        $data['barangs'] = Barang::select('id', 'nama_barang', 'stok', 'harga_satuan')->get();
        
        return view('barang_keluar.edit', $data);
    }

    public function update(Request $request, string $id){
        $barang_keluar = BarangKeluar::find($id);

        $validated = $request->validate([
            'tgl_keluar' => 'required',
            'id_barang' => 'required',
            'jml_keluar' => 'required',
            'total_harga' => 'required',
            'keterangan' => 'required',
        ]);
             
        $id_barang = $request->id_barang;
        $total_stok = $request->total_stok;
        BarangKeluar::where('id', $id)->update($validated);
        Barang::where('id', $id_barang)->update(['stok' => $total_stok]);

        return redirect()->route('barang_keluar');
    }

    public function destroy(string $id){
        $barang_keluar = BarangKeluar::find($id);
        $barang_keluar->delete();

        return redirect()->route('barang_keluar');
    }

}
