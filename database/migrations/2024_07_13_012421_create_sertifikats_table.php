<?php

use App\Models\Marbot;
use App\Models\Sertifikat;
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
        Schema::create('sertifikats', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('deskripsi');
            $table->timestamps();
        });
        Schema::create('sertifikat_marbot', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Marbot::class)->index();
            $table->foreignIdFor(Sertifikat::class)->index();
            $table->string('deskripsi');
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sertifikats');
        Schema::dropIfExists('sertifikat_marbot');
    }
};
