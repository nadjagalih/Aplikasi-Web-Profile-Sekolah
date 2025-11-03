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
        Schema::create('alur_pelayanans', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->integer('urutan')->default(0);
            $table->text('deskripsi');
            $table->string('icon')->nullable(); // Icon atau gambar untuk setiap step
            $table->enum('status', ['Aktif', 'Non-Aktif'])->default('Aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alur_pelayanans');
    }
};
