<?php

use App\Models\Marbot;
use App\Models\MarbotKesehatan;
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
        Schema::create('marbot_kesehatans', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_riwayat')->index();
            $table->string('nama');
            $table->string('keterangan')->nullable();
            $table->string('foto_kesehatan')->nullable();
            $table->timestamps();
        });

        Schema::create('marbot_has_kesehatans', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Marbot::class);
            $table->foreignIdFor(MarbotKesehatan::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marbot_kesehatans');
        Schema::dropIfExists('marbot_has_kesehatans');
    }
};
