<?php

use App\Models\Marbot;
use Illuminate\Support\Facades\Schema;
use App\Models\MarbotRiwayatKepegawaian;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('marbot_riwayat_kepegawaians', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('foto_riwayatkepegawaian')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('jenis_riwayat')->index();
            $table->timestamps();
        });
        Schema::create('marbot_has_riwayat_kepegawaians', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Marbot::class);
            $table->foreignIdFor(MarbotRiwayatKepegawaian::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marbot_riwayat_kepegawaians');
        Schema::dropIfExists('marbot_has_riwayat_kepegawaians');
    }
};
