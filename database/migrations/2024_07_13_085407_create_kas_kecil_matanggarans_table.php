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
        Schema::create('kas_kecil_matanggarans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_matanggaran');
            $table->foreignId('aas_id')->constrained('kas_kecil_aas');
            $table->integer('saldo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kas_kecil_matanggarans');
    }
};
