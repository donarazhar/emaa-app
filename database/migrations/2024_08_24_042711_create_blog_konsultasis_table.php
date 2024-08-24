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
        Schema::create('blog_konsultasis', function (Blueprint $table) {
            $table->id();
            $table->string('judul')->nullable();
            $table->longText('pertanyaan')->nullable();
            $table->longText('jawaban')->nullable();
            $table->dateTime('tanggal_jam')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_konsultasis');
    }
};
