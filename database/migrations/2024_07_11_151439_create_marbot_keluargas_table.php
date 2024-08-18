<?php

use App\Models\Marbot;
use App\Models\MarbotKeluarga;
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
        Schema::create('marbot_keluargas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('tlahir');
            $table->date('tgl_lahir');
            $table->string('jenkel');
            $table->string('no_kontak');
            $table->string('foto_keluarga')->nullable();
            $table->string('tipe_hubungan')->index();
            $table->string('keterangan');
            $table->timestamps();
        });
        Schema::create('marbot_has_keluargas', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Marbot::class);
            $table->foreignIdFor(MarbotKeluarga::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marbot_keluargas');
        Schema::dropIfExists('marbot_has_keluargas');
    }
};
