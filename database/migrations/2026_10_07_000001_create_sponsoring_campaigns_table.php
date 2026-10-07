<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('sponsoring_campaigns')) {
            Schema::create('sponsoring_campaigns', function (Blueprint $table) {
                $table->id();
                $table->string('reference')->unique();
                $table->string('plan_code');
                $table->string('plan_name');
                $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
                $table->string('partner_phone', 30)->nullable();
                $table->decimal('amount', 10, 2);
                $table->unsignedInteger('duration_days');
                $table->enum('status', ['pending', 'active', 'expired'])->default('pending');
                $table->timestamp('starts_at')->nullable();
                $table->timestamp('expires_at')->nullable();
                $table->timestamps();

                $table->index(['status', 'expires_at']);
            });
        }

        if (!Schema::hasTable('sponsoring_campaign_products')) {
            Schema::create('sponsoring_campaign_products', function (Blueprint $table) {
                $table->id();
                $table->foreignId('sponsoring_campaign_id')
                    ->constrained('sponsoring_campaigns')
                    ->cascadeOnDelete();
                $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
                $table->timestamps();

                $table->unique(
                    ['sponsoring_campaign_id', 'product_id'],
                    'sponsor_campaign_product_unique'
                );
            });
        } elseif (!DB::selectOne(
            'SHOW INDEX FROM sponsoring_campaign_products WHERE Key_name = ?',
            ['sponsor_campaign_product_unique']
        )) {
            $hasDuplicateProducts = DB::table('sponsoring_campaign_products')
                ->select('sponsoring_campaign_id', 'product_id')
                ->groupBy('sponsoring_campaign_id', 'product_id')
                ->havingRaw('COUNT(*) > 1')
                ->exists();

            if ($hasDuplicateProducts) {
                throw new RuntimeException(
                    'Cannot add the sponsoring campaign product unique index because duplicate campaign/product pairs exist.'
                );
            }

            Schema::table('sponsoring_campaign_products', function (Blueprint $table) {
                $table->unique(
                    ['sponsoring_campaign_id', 'product_id'],
                    'sponsor_campaign_product_unique'
                );
            });
        }

        if (!Schema::hasColumn('product_sponsorings', 'campaign_id')) {
            Schema::table('product_sponsorings', function (Blueprint $table) {
                $table->foreignId('campaign_id')
                    ->nullable()
                    ->after('user_id')
                    ->constrained('sponsoring_campaigns')
                    ->nullOnDelete();
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('product_sponsorings', 'campaign_id')) {
            Schema::table('product_sponsorings', function (Blueprint $table) {
                $table->dropConstrainedForeignId('campaign_id');
            });
        }

        Schema::dropIfExists('sponsoring_campaign_products');
        Schema::dropIfExists('sponsoring_campaigns');
    }
};
