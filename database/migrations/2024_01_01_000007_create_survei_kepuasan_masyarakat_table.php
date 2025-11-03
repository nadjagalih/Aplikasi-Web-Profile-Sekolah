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
        Schema::create('survei_kepuasan_masyarakat', function (Blueprint $table) {
            $table->id();
            $table->string('nama_survei');
            $table->string('periode'); // Contoh: Triwulan 1 Tahun 2025
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->decimal('nilai_skm', 5, 2)->default(0); // Nilai SKM 0-100
            $table->string('predikat')->nullable(); // A, B, C, D
            $table->text('keterangan')->nullable();
            $table->integer('total_responden')->default(0);
            $table->enum('status', ['Aktif', 'Selesai', 'Draft'])->default('Aktif');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survei_kepuasan_masyarakat');
    }
};
