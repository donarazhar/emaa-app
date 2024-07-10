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
        Schema::create('layanan_transaksi_konsultasis', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_booking');
            $table->time('jam_booking');
            $table->string('nama_jamaah');
            $table->string('jenkel_jamaah');
            $table->string('tempat_lahir_jamaah');
            $table->date('tgl_lahir_jamaah');
            $table->text('alamat');
            $table->string('no_hp');
            $table->string('pendidikan');
            $table->string('pekerjaan');
            $table->string('email');
            $table->text('deskripsi_masalah');
            $table->unsignedBigInteger('imam_id');
            $table->unsignedBigInteger('jeniskonsultasi_id');
            $table->timestamps();

            $table->foreign('imam_id')->references('id')->on('layanan_imams')->onDelete('cascade');
            $table->foreign('jeniskonsultasi_id')->references('id')->on('layanan_jenis_konsultasis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanan_transaksi_konsultasis');
    }
};
