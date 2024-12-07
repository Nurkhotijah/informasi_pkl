<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('jurnal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('laporan_id'); // Relasi ke tabel laporan
            $table->text('kegiatan');
            $table->date('tanggal');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            $table->string('foto_kegiatan')->nullable();
            $table->timestamps();
        
            // Foreign key ke tabel users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        
            // Foreign key ke tabel laporan
            $table->foreign('laporan_id')->references('id')->on('laporan')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('jurnal');
    }
};
