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
        Schema::create('kursus_absensis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kursus_murid_id')->constrained('kursus_murids')->onDelete('cascade');
            $table->foreignId('kursus_jadwal_id')->constrained('kursus_jadwals')->onDelete('cascade');
            $table->string('status_kehadiran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kursus_absensis');
    }
};
