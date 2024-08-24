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
        Schema::create('blog_giat_masjids', function (Blueprint $table) {
            $table->id();
            $table->string('judul')->nullable();
            $table->string('thumbnail')->nullable();
            $table->longText('isi')->nullable();
            $table->dateTime('tanggal_jam')->nullable();
            $table->foreignId('blog_giat_masjid_kategori_id')->nullable()->constrained('blog_giat_masjid_kategoris')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_giat_masjids');
    }
};
