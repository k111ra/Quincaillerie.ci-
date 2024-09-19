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
    Schema::create('orders', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->constrained()->onDelete('cascade');  // ID de l'utilisateur
      $table->string('shipping_address');  // Adresse de livraison
      $table->string('shipping_method');   // Méthode de livraison (standard ou express)
      $table->decimal('total_amount', 10, 2);  // Montant total de la commande
      $table->string('status')->default('pending');  // Statut de la commande (ex: pending, processing, completed)
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
    Schema::dropIfExists('orders');
  }
};
