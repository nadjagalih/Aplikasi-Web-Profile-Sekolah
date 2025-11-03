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
        Schema::create('tenaga_medis', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nip')->unique();
            $table->enum('jenis', ['Dokter', 'Perawat', 'Bidan', 'Apoteker', 'Analis', 'Nutrisionis', 'Lainnya']);
            $table->string('spesialisasi')->nullable();
            $table->foreignId('poliklinik_id')->nullable()->constrained('poliklinik')->onDelete('set null');
            $table->string('pendidikan')->nullable();
            $table->text('alamat')->nullable();
            $table->string('telepon')->nullable();
            $table->string('email')->nullable();
            $table->string('foto')->nullable();
            $table->enum('status', ['Aktif', 'Tidak Aktif'])->default('Aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenaga_medis');
    }
};
