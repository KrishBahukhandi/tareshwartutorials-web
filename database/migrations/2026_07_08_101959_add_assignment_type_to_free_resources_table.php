<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * No-op: free_resources.type is a plain string column (not a DB-level
     * enum), so it already accepts 'assignment' without a schema change.
     * Kept as a file since it's already been applied to existing databases.
     */
    public function up(): void
    {
        //
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
