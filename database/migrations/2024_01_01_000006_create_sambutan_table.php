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
        Schema::create('sambutan', function (Blueprint $table) {
            $table->id();
            $table->string('jabatan')->default('Kepala Puskesmas');
            $table->string('nama');
            $table->text('isi_sambutan');
            $table->string('foto')->nullable();
            $table->string('tempat')->nullable();
            $table->date('tanggal')->nullable();
            $table->enum('status', ['Aktif', 'Tidak Aktif'])->default('Aktif');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sambutan');
    }
};
