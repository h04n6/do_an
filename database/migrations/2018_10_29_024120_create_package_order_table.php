<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackageOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_order', function (Blueprint $table) {
            $table->increments('id');
            $table->char('id_bill',10);
            $table->integer('id_user');
            $table->double('ship_cost')->default(0);
            $table->double('total_bill');
            $table->integer('quantity')->default(0);
            $table->integer('package_staff')->nullable();
            $table->integer('export_staff')->nullable();;
            $table->integer('shipper')->nullable();;
            $table->integer('payment_method')->default(1);
            $table->integer('status');
            $table->date('date_package')->date('Y-m-d');
            $table->date('date_export')->date('Y-m-d')->nullable();
            $table->date('date_finish')->date('Y-m-d')->nullable();
            $table->date('date_cancel')->date('Y-m-d')->nullable();
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
        Schema::dropIfExists('package_order');
    }
}
