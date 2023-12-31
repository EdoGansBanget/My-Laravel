<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('aktivitas', function (Blueprint $table) {
        $table->id();
        $table->string('judul');
        $table->text('deskripsi');
        $table->date('tanggal');
        $table->string('gambar')->nullable();
        $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('aktivitas');
    }
};