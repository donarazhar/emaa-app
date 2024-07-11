<?php

use App\Models\Standard;
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
        Schema::create('marbots', function (Blueprint $table) {
            $table->id();
            $table->string('nip')->unique();
            $table->string('nama');
            $table->string('tlahir');
            $table->date('tgl_lahir');
            $table->string('jenkel');
            $table->string('goldar');
            $table->string('status_nikah');
            $table->string('status_pegawai');
            $table->string('alamat');
            $table->foreignId('standard_id')->nullable()->constrained('standards');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marbots');
    }
};
