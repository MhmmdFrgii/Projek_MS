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
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nis')->unique();
            $table->string('image')->nullable();
            $table->string('nama');
            $table->string('jenis_kelamin');
            $table->string('agama');
            $table->string('phone');
            $table->string('email');
            $table->unsignedBigInteger('id_kelas');
            $table->unsignedBigInteger('id_jurusan');
            $table->unsignedBigInteger('id_organisasi')->nullable();
            $table->unsignedBigInteger('id_ekskul')->nullable();
            $table->text('alamat');
            $table->timestamps();

            $table->foreign('id_kelas')->references('id_kelas')->on('tb_kelas')->onDelete('restrict');
            $table->foreign('id_jurusan')->references('id_jurusan')->on('tb_jurusan')->onDelete('restrict');
            $table->foreign('id_organisasi')->references('id_organisasi')->on('tb_organisasi')->onDelete('restrict');
            $table->foreign('id_ekskul')->references('id_ekskul')->on('tb_ekskul')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
