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
        Schema::create('responden_skm', function (Blueprint $table) {
            $table->id();
            $table->foreignId('survei_id')->constrained('survei_kepuasan_masyarakat')->onDelete('cascade');
            $table->string('nama')->nullable();
            $table->foreignId('jenis_kelamin_id')->constrained('jenis_kelamins')->onDelete('cascade');
            $table->string('umur')->nullable();
            $table->enum('pendidikan', [
                'SD/Sederajat',
                'SMP/Sederajat', 
                'SMA/Sederajat',
                'D-I (Diploma 1)',
                'D-II (Diploma 2)',
                'D-III (Diploma 3)',
                'S1/D-IV (Sarjana)',
                'S2 (Magister)',
                'S3 (Doktor)'
            ]);
            $table->foreignId('pekerjaan_id')->constrained('pekerjaans')->onDelete('cascade');
            $table->text('komentar')->nullable();
            $table->integer('nilai_1')->default(0); // Persyaratan
            $table->integer('nilai_2')->default(0); // Prosedur
            $table->integer('nilai_3')->default(0); // Waktu pelayanan
            $table->integer('nilai_4')->default(0); // Biaya/tarif
            $table->integer('nilai_5')->default(0); // Produk layanan
            $table->integer('nilai_6')->default(0); // Kompetensi pelaksana
            $table->integer('nilai_7')->default(0); // Perilaku pelaksana
            $table->integer('nilai_8')->default(0); // Penanganan pengaduan
            $table->integer('nilai_9')->default(0); // Sarana prasarana
            $table->decimal('nilai_rata_rata', 5, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('responden_skm');
    }
};
