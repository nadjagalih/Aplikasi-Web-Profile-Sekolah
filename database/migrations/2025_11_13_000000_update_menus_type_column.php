<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, alter the column to string to allow longer values
        DB::statement('ALTER TABLE menus MODIFY COLUMN type VARCHAR(20) DEFAULT "parent_only"');
        
        // Then update existing data
        DB::table('menus')->update(['type' => 'parent_only']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->enum('type', ['internal', 'external', 'custom'])->default('internal')->change();
        });
    }
};
