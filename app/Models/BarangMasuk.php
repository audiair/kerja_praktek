<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BarangMasuk extends Model
{
    use HasFactory;

    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    } 
    protected $fillable = [
        'tgl_masuk',
        'id_barang',
        'jml_masuk',
        'total_harga',
    ];

    public static function getDataBarangMasuks()
    {
        $barang_masuks = BarangMasuk::with('barang')->get();
        $barang_masuks_filter = [];

        $no = 1;
        for ($i=0; $i < $barang_masuks->count(); $i++) { 
            $barang_masuks_filter[$i]['no'] = $no++;
            $barang_masuks_filter[$i]['tgl_masuk'] = $barang_masuks[$i]->tgl_masuk;
            $barang_masuks_filter[$i]['barang'] = $barang_masuks[$i]->barang->nama_barang;
            $barang_masuks_filter[$i]['jml_masuk'] = $barang_masuks[$i]->jml_masuk;
            $barang_masuks_filter[$i]['total_harga'] = $barang_masuks[$i]->total_harga;
        } 
        return $barang_masuks_filter;
    }

}
