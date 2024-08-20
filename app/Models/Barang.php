<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Barang extends Model
{
    use HasFactory;

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    // public function barang_masuk(){
    //     return $this->hasMany(BarangMasuk::class);
    // }

    // public function barang_keluar(){
    //     return $this->hasMany(BarangKeluar::class);
    // }

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'id_kategori',
        'stok',
        'satuan',
        'harga_satuan',
    ];
}