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
        
        $notification = array(
            'message' => "Data Barang Keluar berhasil ditambahkan!",
            'alert-type' => 'success'
        );

        $notifications = array(
            'message' => "Data Barang Keluar gagal ditambahkan!",
            'alert-type' => 'error'
        );

        if($request->save == true) {
            return redirect()->route('barang_keluar')->with($notification);
        } else {
            return redirect()->route('barang_keluar.create')->with($notifications);
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

        $notification = array(
            'message' => "Data Barang Keluar berhasil diperbaharui!",
            'alert-type' => 'success'
        );

        $notifications = array(
            'message' => "Data Barang Keluar gagal diperbaharui!",
            'alert-type' => 'error'
        );

        if($request->save == true) {
            return redirect()->route('barang_keluar')->with($notification);
        } else {
            return redirect()->route('barang_keluar.edit')->with($notifications);
        }
    }

    public function destroy(string $id){
        $barang_keluar = BarangKeluar::find($id);
        $barang_keluar->delete();

        $notification = array(
            'message' => "Data Barang Keluar berhasil dihapus!",
            'alert-type' => 'success'
        );

        return redirect()->route('barang_keluar')->with($notification);
    }

    public function search(Request $request){

        $search = $request->search;

        $barang_keluars = BarangKeluar::where(function($query) use ($search){

            $query->where('tgl_keluar', 'like', "%$search%")
            ->orWhere('jml_keluar', 'like', "%$search%")
            ->orWhere('total_harga', 'like', "%$search%")
            ->orWhere('keterangan', 'like', "%$search%");
            })
        
            ->orWhereHas('barang', function($query) use ($search){
                $query->where('kode_barang', 'like', "%$search%")
                ->orWhere('nama_barang', 'like', "%$search%");
            })->get();

        return view('barang_keluar.index', compact('barang_keluars','search'));
    }

}
