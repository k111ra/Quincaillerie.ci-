<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            if (!Schema::hasColumn('services', 'status')) {
                $table->enum('status', ['pending_approval', 'approved', 'rejected'])
                    ->default('pending_approval')
                    ->after('user_id');
            }
            if (!Schema::hasColumn('services', 'approved_at')) {
                $table->timestamp('approved_at')->nullable()->after('status');
            }
            if (!Schema::hasColumn('services', 'approved_by')) {
                $table->unsignedBigInteger('approved_by')->nullable()->after('approved_at');
            }
        });

        // Marquer les services existants comme approuvés pour éviter de les masquer côté client
        if (Schema::hasColumn('services', 'status')) {
            DB::table('services')->update([
                'status' => 'approved',
                'approved_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            if (Schema::hasColumn('services', 'approved_by')) {
                $table->dropColumn('approved_by');
            }
            if (Schema::hasColumn('services', 'approved_at')) {
                $table->dropColumn('approved_at');
            }
            if (Schema::hasColumn('services', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};
