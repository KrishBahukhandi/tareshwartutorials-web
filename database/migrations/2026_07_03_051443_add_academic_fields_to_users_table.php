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
        Schema::table('users', function (Blueprint $table) {
            $table->string('class_level', 5)->nullable()->after('years_of_experience');
            $table->string('board', 50)->nullable()->after('class_level');
            $table->string('stream', 50)->nullable()->after('board');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['class_level', 'board', 'stream']);
        });
    }
};
