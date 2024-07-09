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
        Schema::create('surat_transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('no_transaksi_surat')->unique();
            $table->date('tgl_transaksi_surat');
            $table->string('perihal_transaksi_surat');
            $table->string('surat_dari_transaksi_surat');
            $table->string('disposisi_transaksi_surat');
            $table->string('status_transaksi_surat');
            $table->foreignId('kategori_surat_id')->constrained('surat_kategoris');
            $table->foreignId('asal_surat_id')->constrained('surat_asals');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_transaksis');
    }
};
