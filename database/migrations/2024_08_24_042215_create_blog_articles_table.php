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
        Schema::create('blog_articles', function (Blueprint $table) {
            $table->id();
            $table->string('judul')->nullable();
            $table->longText('isi')->nullable();
            $table->string('thumbnail')->nullable();
            $table->dateTime('tanggal_jam')->nullable();
            $table->foreignId('blog_article_kategori_id')->nullable()->constrained('blog_article_kategoris')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_articles');
    }
};