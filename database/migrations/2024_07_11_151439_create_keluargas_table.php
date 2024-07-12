<?php

use App\Models\Keluarga;
use App\Models\Marbot;
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
        Schema::create('keluargas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('no_kontak');
            $table->string('tipe_hubungan')->index();
            $table->timestamps();
        });
        Schema::create('keluarga_marbot', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Marbot::class);
            $table->foreignIdFor(Keluarga::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keluargas');
        Schema::dropIfExists('keluarga_marbot');
    }
};
