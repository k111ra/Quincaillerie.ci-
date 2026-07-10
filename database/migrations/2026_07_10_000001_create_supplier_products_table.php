<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('supplier_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fournisseur_id')->constrained('fournisseurs')->cascadeOnDelete();
            $table->foreignId('product_id')->nullable()->constrained('products')->nullOnDelete();
            $table->string('product_name'); // nom du produit chez le fournisseur
            $table->decimal('purchase_price', 15, 2); // prix d'achat (FCFA)
            $table->string('unit')->default('unité'); // unité (sac, carton, pièce...)
            $table->string('purchase_link')->nullable(); // lien d'achat en ligne si dispo
            $table->text('notes')->nullable();
            $table->timestamp('price_updated_at')->nullable();
            $table->timestamps();

            $table->index('product_name');
        });
    }

    public function down()
    {
        Schema::dropIfExists('supplier_products');
    }
};
