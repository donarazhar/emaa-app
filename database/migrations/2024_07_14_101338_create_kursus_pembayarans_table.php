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
        Schema::create('kursus_pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kursus_pendaftaran_id')->constrained('kursus_pendaftarans')->onDelete('cascade');
            $table->date('tanggal_pembayaran');
            $table->decimal('jumlah', 10, 2);
            $table->string('metode_pembayaran');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kursus_pembayarans');
    }
};
