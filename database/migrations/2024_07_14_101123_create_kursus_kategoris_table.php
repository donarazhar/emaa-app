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
        Schema::create('kursus_kategoris', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kursus');
            $table->text('deskripsi');
            $table->string('durasi');
            $table->integer('biaya');
            $table->enum('jenis_kursus', ['reguler', 'private']); // Menambahkan kolom jenis_kursus
            $table->foreignId('kursus_guru_id')->constrained('kursus_gurus')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kursus_kategoris');
    }
};
