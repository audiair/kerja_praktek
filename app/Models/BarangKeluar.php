<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BarangKeluar extends Model
{
    use HasFactory;

    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    protected $fillable = [
        'tgl_keluar',
        'id_barang',
        'jml_keluar',
        'total_harga',
        'keterangan',
    ];

    public static function getDataBarangKeluars()
    {
        $barang_keluars = BarangKeluar::with('barang')->get();
        $barang_keluars_filter = [];

        $no = 1;
        for ($i=0; $i < $barang_keluars->count(); $i++) { 
            $barang_keluars_filter[$i]['no'] = $no++;
            $barang_keluars_filter[$i]['tgl_keluar'] = $barang_keluars[$i]->tgl_keluar;
            $barang_keluars_filter[$i]['id_barang'] = $barang_keluars[$i]->id_barang;
            $barang_keluars_filter[$i]['jml_keluar'] = $barang_keluars[$i]->jml_keluar;
            $barang_keluars_filter[$i]['total_harga'] = $barang_keluars[$i]->total_harga;
            $barang_keluars_filter[$i]['keterangan'] = $barang_keluars[$i]->keterangan;
        } 
        return $barang_keluars_filter;
    }
}
