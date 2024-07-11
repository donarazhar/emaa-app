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
        Schema::create('layanan_transaksi_pengislamen', function (Blueprint $table) {
            $table->id();
            $table->string('no_urut');
            $table->string('kategori');
            $table->date('tgl');
            $table->time('jam');
            $table->string('hari');
            $table->string('nama');
            $table->string('jenkel');
            $table->string('no_hp');
            $table->string('email')->nullable();
            $table->string('tlahir');
            $table->date('tgllahir');
            $table->string('agama_semula');
            $table->string('pekerjaan');
            $table->string('alamat1');
            $table->string('alamat2')->nullable();
            $table->string('nama_baru');
            $table->string('tgl_hijriah');
            $table->string('tahun_hijriah');
            $table->string('saksi1');
            $table->string('saksi2');
            $table->string('saksi3')->nullable();
            $table->text('alasan');
            $table->foreignId('imam_id')->constrained('layanan_imams')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanan_transaksi_pengislamen');
    }
};
