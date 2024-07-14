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
        Schema::create('kursus_penilaians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kursus_murid_id')->constrained('kursus_murids')->onDelete('cascade');
            $table->foreignId('kursus_kategori_id')->constrained('kursus_kategoris')->onDelete('cascade');
            $table->decimal('nilai', 5, 2);
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kursus_penilaians');
    }
};
