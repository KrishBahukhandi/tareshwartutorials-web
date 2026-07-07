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
            $table->enum('role', ['admin', 'teacher', 'student'])->default('student')->after('email');
            $table->string('phone', 20)->nullable()->after('role');
            $table->string('profile_photo')->nullable()->after('phone');
            $table->boolean('is_active')->default(true)->after('profile_photo');
            $table->string('department')->nullable()->after('is_active');
            $table->string('subject')->nullable()->after('department');
            $table->string('highest_degree')->nullable()->after('subject');
            $table->string('institution')->nullable()->after('highest_degree');
            $table->unsignedTinyInteger('years_of_experience')->nullable()->after('institution');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'role',
                'phone',
                'profile_photo',
                'is_active',
                'department',
                'subject',
                'highest_degree',
                'institution',
                'years_of_experience',
            ]);
        });
    }
};
