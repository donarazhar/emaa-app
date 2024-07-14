<?php

use App\Models\Marbot;
use App\Models\RiwayatKepegawaian;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('riwayat_kepegawaians', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('foto_riwayatkepegawaian')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('jenis_riwayat')->index();
            $table->timestamps();
        });
        Schema::create('riwayat_kepegawaian_marbot', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Marbot::class);
            $table->foreignIdFor(RiwayatKepegawaian::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_kepegawaians');
        Schema::dropIfExists('riwayat_kepegawaian_marbot');
    }
};
