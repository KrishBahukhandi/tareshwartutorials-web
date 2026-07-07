<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('batches', function (Blueprint $table) {
            $table->string('meeting_link')->nullable()->after('is_active');
            $table->string('meeting_title')->nullable()->after('meeting_link');
            $table->dateTime('meeting_scheduled_at')->nullable()->after('meeting_title');
        });
    }

    public function down(): void
    {
        Schema::table('batches', function (Blueprint $table) {
            $table->dropColumn(['meeting_link', 'meeting_title', 'meeting_scheduled_at']);
        });
    }
};
