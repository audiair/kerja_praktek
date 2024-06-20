<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barang_keluars', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_keluar');
            $table->integer('jml_keluar');
            $table->integer('total_harga');
            $table->enum('keterangan', ['Terjual', 'Terpakai', 'Kadaluarsa', 'Rusak']);
            $table->timestamps();

            $table->foreignId('id_barang')
            ->references('id')
            ->on('barangs')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_keluars');
    }
};
