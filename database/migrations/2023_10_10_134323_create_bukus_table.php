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
        Schema::create('buku', function (Blueprint $table) {
            $table->id();
            $table->string('gambar');
            $table->string('kode_buku')->unique();
            $table->string('judul_buku');
            $table->string('penulis');
            $table->string('penerbit');
            $table->string('kategori');
            $table->longtext('deskripsi');
            $table->date('tahun_terbit')-> nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};