<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fournisseurs', function (Blueprint $table) {
            if (!Schema::hasColumn('fournisseurs', 'user_id')) {
                $table->foreignId('user_id')->nullable()->unique()->after('id')->constrained('users')->onDelete('cascade');
            }
            if (!Schema::hasColumn('fournisseurs', 'status')) {
                $table->enum('status', ['active', 'inactive', 'pending_approval'])->default('pending_approval')->after('email');
            }
            if (!Schema::hasColumn('fournisseurs', 'phone_primary')) {
                $table->string('phone_primary')->nullable()->after('telephone');
            }
            if (!Schema::hasColumn('fournisseurs', 'phone_secondary')) {
                $table->string('phone_secondary')->nullable()->after('phone_primary');
            }
            if (!Schema::hasColumn('fournisseurs', 'email_primary')) {
                $table->string('email_primary')->nullable()->after('email');
            }
            if (!Schema::hasColumn('fournisseurs', 'email_secondary')) {
                $table->string('email_secondary')->nullable()->after('email_primary');
            }
            if (!Schema::hasColumn('fournisseurs', 'whatsapp_number')) {
                $table->string('whatsapp_number')->nullable()->after('email_secondary');
            }
            if (!Schema::hasColumn('fournisseurs', 'website')) {
                $table->string('website')->nullable()->after('whatsapp_number');
            }
            if (!Schema::hasColumn('fournisseurs', 'description')) {
                $table->longText('description')->nullable()->after('website');
            }
            if (!Schema::hasColumn('fournisseurs', 'approved_at')) {
                $table->timestamp('approved_at')->nullable()->after('description');
            }
            if (!Schema::hasColumn('fournisseurs', 'approved_by')) {
                $table->foreignId('approved_by')->nullable()->after('approved_at')->constrained('users')->onDelete('set null');
            }
            if (!Schema::hasColumn('fournisseurs', 'notification_preferences')) {
                $table->json('notification_preferences')->nullable()->after('approved_by');
            }
            if (!Schema::hasColumn('fournisseurs', 'deleted_at')) {
                $table->softDeletes()->after('notification_preferences');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fournisseurs', function (Blueprint $table) {
            if (Schema::hasColumn('fournisseurs', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }
            if (Schema::hasColumn('fournisseurs', 'status')) {
                $table->dropColumn('status');
            }
            if (Schema::hasColumn('fournisseurs', 'phone_primary')) {
                $table->dropColumn('phone_primary');
            }
            if (Schema::hasColumn('fournisseurs', 'phone_secondary')) {
                $table->dropColumn('phone_secondary');
            }
            if (Schema::hasColumn('fournisseurs', 'email_primary')) {
                $table->dropColumn('email_primary');
            }
            if (Schema::hasColumn('fournisseurs', 'email_secondary')) {
                $table->dropColumn('email_secondary');
            }
            if (Schema::hasColumn('fournisseurs', 'whatsapp_number')) {
                $table->dropColumn('whatsapp_number');
            }
            if (Schema::hasColumn('fournisseurs', 'website')) {
                $table->dropColumn('website');
            }
            if (Schema::hasColumn('fournisseurs', 'description')) {
                $table->dropColumn('description');
            }
            if (Schema::hasColumn('fournisseurs', 'approved_at')) {
                $table->dropColumn('approved_at');
            }
            if (Schema::hasColumn('fournisseurs', 'approved_by')) {
                $table->dropForeign(['approved_by']);
                $table->dropColumn('approved_by');
            }
            if (Schema::hasColumn('fournisseurs', 'notification_preferences')) {
                $table->dropColumn('notification_preferences');
            }
            if (Schema::hasColumn('fournisseurs', 'deleted_at')) {
                $table->dropColumn('deleted_at');
            }
        });
    }
};
