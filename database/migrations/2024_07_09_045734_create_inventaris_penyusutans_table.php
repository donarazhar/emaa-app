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
        Schema::create('inventaris_penyusutans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inventaris_transaksi_id')->constrained('inventaris_transaksis');
            $table->integer('nilai_awal');
            $table->integer('nilai_penyusutan');
            $table->integer('nilai_akhir');
            $table->date('tgl_penyusutan');
            $table->text('keterangan_penyusutan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventaris_penyusutans');
    }
};
