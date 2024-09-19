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
    Schema::create('order_items', function (Blueprint $table) {
      $table->id();
      $table->foreignId('order_id')->constrained()->onDelete('cascade');  // Référence à la commande
      $table->foreignId('product_id')->constrained()->onDelete('cascade');  // Référence au produit
      $table->integer('quantity');  // Quantité du produit dans la commande
      $table->decimal('price', 10, 2);  // Prix du produit
      $table->timestamps();  // Timestamps: created_at et updated_at
    });
  }
  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('order_items');
  }
};
