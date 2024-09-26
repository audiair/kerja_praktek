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

        // Cek apakah nama_barang sudah ada di database
        $existingBarang = Barang::where('nama_barang', $request->nama_barang)->first();

         // Jika nama barang sudah ada, kembalikan pesan error
        if ($existingBarang) {
            $notification = array(
                'message' => "Nama Barang sudah ada! Silakan gunakan nama yang berbeda.",
                'alert-type' => 'error'
            );
            return redirect()->route('barang.create')->with($notification)->withInput();
        }

        Barang::create($validated);

        $notification = array(
            'message' => "Data Barang berhasil ditambahkan!",
            'alert-type' => 'success'
        );

        $notifications = array(
            'message' => "Data Barang gagal ditambahkan!",
            'alert-type' => 'success'
        );

        if($request->save == true) {
            return redirect()->route('barang')->with($notification);
        } else {
            return redirect()->route('barang.create')->with($notifications);
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
            'message' => "Data Barang berhasil diperbaharui!",
            'alert-type' => 'success'
        );

        $notifications = array(
            'message' => "Data Barang gagal diperbaharui!",
            'alert-type' => 'error'
        );

        if($request->save == true) {
            return redirect()->route('barang')->with($notification);
        } else {
            return redirect()->route('barang.edit')->with($notifications);
        }
    }
  
    public function destroy(string $id){
        $barang = Barang::find($id);
        $barang->delete();

        $notification = array(
            'message' => "Data Barang berhasil dihapus!",
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
