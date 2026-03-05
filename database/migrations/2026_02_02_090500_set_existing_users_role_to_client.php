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
        // Set role = 'client' for users where role is NULL or empty
        DB::table('users')
            ->whereNull('role')
            ->orWhere('role', '')
            ->update(['role' => 'client']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert users previously set to 'client' back to NULL.
        // NOTE: This will set any user with role='client' to NULL — adapt if needed.
        DB::table('users')
            ->where('role', 'client')
            ->update(['role' => null]);
    }
};
