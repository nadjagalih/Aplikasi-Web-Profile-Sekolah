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
        Schema::table('situses', function (Blueprint $table) {
            $table->renameColumn('nama_puskesmas', 'kecamatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('situses', function (Blueprint $table) {
            $table->renameColumn('kecamatan', 'nama_puskesmas');
        });
    }
};
