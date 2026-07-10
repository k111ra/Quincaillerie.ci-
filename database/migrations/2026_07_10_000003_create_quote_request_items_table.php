<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('quote_request_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quote_request_id')->constrained('quote_requests')->cascadeOnDelete();

            // Ce que le client a demandé
            $table->string('product_name_raw');
            $table->decimal('quantity', 12, 2)->default(1);
            $table->string('unit')->default('unité');

            // Correspondances trouvées
            $table->foreignId('product_id')->nullable()->constrained('products')->nullOnDelete();
            $table->foreignId('fournisseur_id')->nullable()->constrained('fournisseurs')->nullOnDelete();
            $table->foreignId('supplier_product_id')->nullable()->constrained('supplier_products')->nullOnDelete();

            // Prix (le prix de vente = prix d'achat * (1 + marge))
            $table->decimal('purchase_price', 15, 2)->nullable(); // prix d'achat fournisseur
            $table->decimal('selling_price', 15, 2)->nullable();  // prix affiché au client

            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('quote_request_items');
    }
};
