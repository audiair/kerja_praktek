<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriBarangController extends Controller
{
    public function index()
    {
        $data['kategoris'] = Kategori::all();
        return view('kategori.index', $data);
    }

    public function create(){
        return view('kategori.create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'kode_kategori' => 'required',
            'kategori_barang' => 'required|max:150',
        ]);

        Kategori::create($validated);

        $notification = array(
            'message' => "Kategori barang berhasil ditambahkan!",
            'alert-type' => 'success'
        );

        if($request->save == true) {
            return redirect()->route('kategori')->with($notification);
        } else {
            return redirect()->route('kategori.create');
        }
    }

    public function edit(string $id){
        $data['kategoris'] = Kategori::find($id);
        return view('kategori.edit', $data);
    }

    public function update(Request $request, string $id){
        $kategori = Kategori::find($id);

        $validated = $request->validate([
            'kode_kategori' => 'required',
            'kategori_barang' => 'required|max:150',
        ]);
        
        Kategori::where('id', $id)->update($validated);

        $notification = array(
            'message' => "Kategori barang berhasil diupdate!",
            'alert-type' => 'success'
        );

        return redirect()->route('kategori')->with($notification);
    }

    public function destroy(string $id){
        $kategori = Kategori::find($id);
        $kategori->delete();

        $notification = array(
            'message' => "Kategori barang berhasil dihapus!",
            'alert-type' => 'success'
        );

        return redirect()->route('kategori')->with($notification);
    }

    public function search(Request $request){

        $search = $request->search;

        $kategoris = Kategori::where(function($query) use ($search){

            $query->where('kode_kategori', 'like', "%$search%")
            ->orWhere('kategori_barang', 'like', "%$search%");
            })->get();

        return view('kategori.index', compact('kategoris','search'));
    }

}
