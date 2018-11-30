<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
      public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->char('id_product',10);
            $table->string('name');
            $table->integer('id_type');
            $table->integer('gender');
            $table->string('description');
            $table->double('import_price')->default(0);
            $table->double('price')->default(0);
            $table->double('promotion_price')->default(0);
            $table->string('image')->default('');
            $table->integer('new')->default(0);
            $table->integer('hot')->default(0);
            $table->string('id_manufacturer');
            $table->timestamps();
        });
         DB::statement("ALTER TABLE products AUTO_INCREMENT = 1001;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
