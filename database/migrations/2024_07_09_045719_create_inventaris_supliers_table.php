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
        Schema::create('inventaris_supliers', function (Blueprint $table) {
            $table->id();
            $table->string('nama_suplier');
            $table->string('alamat_suplier')->nullable();
            $table->string('kontak_suplier')->nullable();
            $table->string('email_suplier')->nullable();
            $table->text('keterangan_suplier')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventaris_supliers');
    }
};
