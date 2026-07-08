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
        Schema::table('free_resources', function (Blueprint $table) {
            $table->enum('type', ['note', 'pyq', 'assignment'])->default('note')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('free_resources', function (Blueprint $table) {
            $table->enum('type', ['note', 'pyq'])->default('note')->change();
        });
    }
};
