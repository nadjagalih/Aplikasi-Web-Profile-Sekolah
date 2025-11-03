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
        Schema::create('pasien', function (Blueprint $table) {
            $table->id();
            $table->string('no_rm')->unique(); // Nomor Rekam Medis
            $table->string('nik')->unique();
            $table->string('nama');
            $table->date('tanggal_lahir');
            $table->foreignId('jenis_kelamin_id')->constrained('jenis_kelamins')->onDelete('cascade');
            $table->text('alamat');
            $table->string('telepon')->nullable();
            $table->foreignId('agama_id')->constrained('agamas')->onDelete('cascade');
            $table->foreignId('pekerjaan_id')->constrained('pekerjaans')->onDelete('cascade');
            $table->string('golongan_darah')->nullable();
            $table->enum('status', ['Aktif', 'Tidak Aktif'])->default('Aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasien');
    }
};
