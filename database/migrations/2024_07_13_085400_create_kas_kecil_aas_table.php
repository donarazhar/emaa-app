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
        Schema::create('kas_kecil_aas', function (Blueprint $table) {
            $table->id();
            $table->string('kode_aas');
            $table->string('nama_aas');
            $table->enum('kategori', ['pembentukan', 'pengisian', 'pengeluaran']);
            $table->enum('status', ['debit', 'kredit']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kas_kecil_aas');
    }
};
