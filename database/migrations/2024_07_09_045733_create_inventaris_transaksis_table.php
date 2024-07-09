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
        Schema::create('inventaris_transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_data_inventaris');
            $table->string('jenis_data_inventaris');
            $table->integer('stok_data_inventaris');
            $table->text('keterangan_data_inventaris')->nullable();
            $table->date('tgl_data_inventaris');
            $table->string('foto_data_inventaris')->nullable();
            $table->foreignId('kategori_id')->constrained('inventaris_kategoris');
            $table->foreignId('merk_id')->constrained('inventaris_merks');
            $table->foreignId('satuan_id')->constrained('inventaris_satuans');
            $table->foreignId('bagian_id')->constrained('inventaris_bagians');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventaris_transaksis');
    }
};
