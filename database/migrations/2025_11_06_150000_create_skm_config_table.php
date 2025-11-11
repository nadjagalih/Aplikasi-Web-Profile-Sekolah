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
        Schema::create('skm_config', function (Blueprint $table) {
            $table->id();
            $table->string('nama_puskesmas');
            $table->string('api_url');
            $table->string('kode_organisasi');
            $table->enum('status', ['Aktif', 'Tidak Aktif'])->default('Aktif');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skm_config');
    }
};
