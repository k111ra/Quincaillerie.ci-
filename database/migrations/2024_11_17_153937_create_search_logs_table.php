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
    Schema::create('search_logs', function (Blueprint $table) {
      $table->id();
      $table->string('query'); // Requête de recherche
      $table->unsignedBigInteger('user_id')->nullable(); // Utilisateur connecté (si applicable)
      $table->ipAddress('ip_address'); // Adresse IP de l'utilisateur
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('search_logs');
  }
};
