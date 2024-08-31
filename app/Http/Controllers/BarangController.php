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

        $notification = array(
            'message' => "Barang berhasil ditambahkan!",
            'alert-type' => 'success'
        );

        if($request->save == true) {
            return redirect()->route('barang')->with($notification);
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

        $notification = array(
            'message' => "Barang berhasil diupdate!",
            'alert-type' => 'success'
        );

        return redirect()->route('barang')->with($notification);
    }
  
    public function destroy(string $id){
        $barang = Barang::find($id);
        $barang->delete();

        
        $notification = array(
            'message' => "Barang berhasil dihapus!",
            'alert-type' => 'success'
        );

        return redirect()->route('barang')->with($notification);
    }

    public function search(Request $request){

        $search = $request->search;

        $barangs = Barang::where(function($query) use ($search){

            $query->where('kode_barang', 'like', "%$search%")
            ->orWhere('nama_barang', 'like', "%$search%")
            ->orWhere('stok', 'like', "%$search%")
            ->orWhere('satuan', 'like', "%$search%")
            ->orWhere('harga_satuan', 'like', "%$search%");
            })
        
            ->orWhereHas('kategori', function($query) use ($search){
                $query->where('kode_kategori', 'like', "%$search%")
                ->orWhere('kategori_barang', 'like', "%$search%");
            })->get();

        return view('barang.index', compact('barangs','search'));
    }

}
