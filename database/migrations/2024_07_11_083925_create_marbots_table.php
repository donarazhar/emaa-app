<?php

use App\Models\Standard;
use App\Models\User;
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
            $table->string('tlahir')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('jenkel')->nullable();
            $table->string('goldar')->nullable();
            $table->string('posisi')->nullable();
            $table->string('status_nikah')->nullable();
            $table->string('status_pegawai')->nullable();
            $table->string('phone')->nullable();
            $table->string('alamat')->nullable();
            $table->text('foto')->nullable();
            $table->string('email_user')->nullable();
            $table->foreign('email_user')->references('email')->on('users')->onDelete('cascade');
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
