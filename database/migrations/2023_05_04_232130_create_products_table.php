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
    if (!Schema::hasTable('products')) {
      Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('nom');
        $table->text('description');
        $table->decimal('prix', 8, 2);
        $table->integer('quantite');
        $table->string('slug');
        $table->unsignedBigInteger('categorie_id');
        $table->foreign('categorie_id')->references('id')->on('categories')->onDelete('cascade');
        $table->timestamps();
        $table->text('images')->nullable();
      });
    }
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('products');
    Schema::dropIfExists('Products');
  }
};
