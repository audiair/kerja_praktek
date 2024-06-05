<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index(){
        $data['barangs'] = Barang::with('kategori')->get();
        return view('barang.index', $data);
    }

    public function create(){
        $data['kategoris'] = Kategori::pluck('kategori_barang','id');
        return view('barang.create' ,$data);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'kode_barang' => 'required',
            'nama_barang' => 'required|max:150',
            'id_kategori' => 'required',
            'stok' => 'required',
            'satuan' => 'required|max:10',
            'harga_satuan' => 'required',
        ]);

        Barang::create($validated);

        if($request->save == true) {
            return redirect()->route('barang');
        } else {
            return redirect()->route('barang.create');
        }
    }

    public function edit(string $id){
        $data['barangs'] = Barang::find($id);
        $data['kategoris'] = Kategori::pluck('kategori_barang', 'id');
        
        return view('barang.edit', $data);
    }

    public function update(Request $request, string $id){
        $barang = Barang::find($id);

        $validated = $request->validate([
            'kode_barang' => 'required',
            'nama_barang' => 'required|max:150',
            'id_kategori' => 'required',
            'stok' => 'required',
            'satuan' => 'required|max:10',
            'harga_satuan' => 'required',
        ]);
        
        Barang::where('id', $id)->update($validated);

        return redirect()->route('barang');
    }
  
    public function destroy(string $id){
        $barang = Barang::find($id);
        $barang->delete();

        return redirect()->route('barang');
    }

}
