<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('free_resources', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('type', 20)->default('note');
            $table->string('class_level', 5); // '10', '11', '12'
            $table->string('subject', 100);   // 'Mathematics', 'Physics', etc.
            $table->string('chapter', 200)->nullable();
            $table->string('board', 50)->nullable()->default('NCERT');
            $table->smallInteger('year')->nullable(); // for PYQs
            $table->string('file_path');
            $table->string('thumbnail')->nullable();
            $table->unsignedInteger('download_count')->default(0);
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('free_resources');
    }
};
