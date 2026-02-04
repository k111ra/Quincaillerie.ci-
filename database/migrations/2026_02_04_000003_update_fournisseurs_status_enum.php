<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE fournisseurs MODIFY status ENUM('pending_approval','approved','rejected','active','inactive') DEFAULT 'pending_approval'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE fournisseurs MODIFY status ENUM('active','inactive','pending_approval') DEFAULT 'pending_approval'");
    }
};
