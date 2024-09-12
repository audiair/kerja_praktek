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
        $data['barangs'] = Barang::select('id', 'nama_barang', 'stok', 'harga_satuan')->get();
        return view('barang_masuk.create', $data);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'tgl_masuk' => 'required',
            'id_barang' => 'required',
            'jml_masuk' => 'required',
            'total_harga' => 'required',
        ]);

        $total_stok = $request->total_stok;
        $id_barang = $request->id_barang;
        BarangMasuk::create($validated);
        Barang::where('id', $id_barang)->update(['stok' => $total_stok]);

        $notification = array(
            'message' => "Data Barang Masuk berhasil ditambahkan!",
            'alert-type' => 'success'
        );

        $notifications = array(
            'message' => "Data Barang Masuk gagal ditambahkan!",
            'alert-type' => 'error'
        );
        
        if($request->save == true) {
            return redirect()->route('barang_masuk')->with($notification);
        } else {
            return redirect()->route('barang_masuk.create')->with($notifications);
        }
    }

    public function edit(string $id){
        $data['barang_masuks'] = BarangMasuk::find($id);
        $data['barangs'] = Barang::select('id', 'nama_barang', 'stok', 'harga_satuan')->get();
        
        return view('barang_masuk.edit', $data);
    }

    public function update(Request $request, string $id){
        $validated = $request->validate([
            'tgl_masuk' => 'required',
            'id_barang' => 'required',
            'jml_masuk' => 'required',
            'total_harga' => 'required',
        ]);
        
        $id_barang = $request->id_barang;
        $total_stok = $request->total_stok;
        BarangMasuk::where('id', $id)->update($validated);
        Barang::where('id', $id_barang)->update(['stok' => $total_stok]);

        $notification = array(
            'message' => "Data Barang Masuk berhasil diperbaharui!",
            'alert-type' => 'success'
        );

        $notifications = array(
            'message' => "Data Barang Masuk gagal diperbaharui!",
            'alert-type' => 'error'
        );

        if($request->save == true) {
            return redirect()->route('barang_masuk')->with($notification);
        } else {
            return redirect()->route('barang_masuk.edit')->with($notifications);
        }
    }

    public function destroy(string $id){
        $barang_masuk = BarangMasuk::find($id);
        $barang_masuk->delete();

        $notification = array(
            'message' => "Data Barang Masuk berhasil dihapus!",
            'alert-type' => 'success'
        );

        return redirect()->route('barang_masuk')->with($notification);
    }

    public function search(Request $request){

        $search = $request->search;

        $barang_masuks = BarangMasuk::where(function($query) use ($search){

            $query->where('tgl_masuk', 'like', "%$search%")
            ->orWhere('jml_masuk', 'like', "%$search%")
            ->orWhere('total_harga', 'like', "%$search%");
            })
        
            ->orWhereHas('barang', function($query) use ($search){
                $query->where('kode_barang', 'like', "%$search%")
                ->orWhere('nama_barang', 'like', "%$search%");
            })->get();

        return view('barang_masuk.index', compact('barang_masuks','search'));
    }
}
