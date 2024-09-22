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
      $table->foreignId('user_id')->constrained()->onDelete('cascade');
      $table->string('order_number')->unique();  // Numéro de commande unique
      $table->string('shipping_address');
      $table->string('shipping_method');
      $table->decimal('total_amount', 10, 2);
      $table->string('status')->default('pending');
      $table->timestamps();

      // Ajout d'index pour améliorer les performances
      $table->index('user_id');
      $table->index('status');
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
