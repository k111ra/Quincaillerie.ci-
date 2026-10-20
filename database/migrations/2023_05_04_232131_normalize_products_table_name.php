<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up()
  {
    if (Schema::hasTable('Products') && !Schema::hasTable('products')) {
      Schema::rename('Products', 'products');
    }
  }

  public function down()
  {
    if (Schema::hasTable('products') && !Schema::hasTable('Products')) {
      Schema::rename('products', 'Products');
    }
  }
};
