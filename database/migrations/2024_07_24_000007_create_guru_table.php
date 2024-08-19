<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('guru', function (Blueprint $table) {
            $table->id();
            $table->string('nuptk')->unique();
            $table->string('image');
            $table->string('nama');
            $table->string('agama');
            $table->string('jenis_kelamin');
            $table->string('phone');
            $table->string('email');
            // $table->unsignedBigInteger('id_jurusan');
            $table->timestamps();
            // $table->foreign('id_jurusan')->references('id_jurusan')->on('tb_jurusan')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guru');
    }
};
