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
        Schema::create('kas_kecil_transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('perincian');
            $table->integer('jumlah');
            $table->enum('kategori', ['pembentukan', 'pengisian', 'pengeluaran']);
            $table->date('tgl_transaksi');
            $table->foreignId('matanggaran_id')->constrained('kas_kecil_matanggaran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kas_kecil_transaksis');
    }
};
