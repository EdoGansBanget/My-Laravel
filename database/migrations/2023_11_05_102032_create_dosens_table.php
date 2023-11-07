<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosensTable extends Migration {
    public function up(): void {
        Schema::create('dosen', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('mata_kuliah');
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('dosen');
    }
}