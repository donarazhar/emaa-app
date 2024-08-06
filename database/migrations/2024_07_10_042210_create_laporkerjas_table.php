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
        Schema::create('laporkerjas', function (Blueprint $table) {
            $table->id();
            $table->date('tgl');
            $table->string('judul');
            $table->text('isi');
            $table->text('foto_laporkerja')->nullable();
            $table->string('email_user')->nullable();
            $table->foreign('email_user')->references('email')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporkerjas');
    }
};
