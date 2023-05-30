<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogTables extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('image')->nullable();
            $table->timestamps();
        });


        Schema::create('post_category', function (Blueprint $table) {
            $table->foreignId('post_id')->constrained('posts');
            $table->foreignId('categorie_id')->constrained('categories');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('post_category');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('posts');
    }
};

