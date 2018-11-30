<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill', function (Blueprint $table) {
            $table->increments('id');
            $table->char('id_bill',10);
            $table->integer('id_user');
            $table->integer('id_code')->nullable();
            $table->double('ship_cost')->default(0);
            $table->double('total_bill')->default(0);
            $table->string('recive_address')->nullable();
            $table->string('reciver')->nullable();
            $table->string('phone')->nullable();
            $table->integer('status_order')->default(1);
            $table->integer('id_shipper')->nullable();
            $table->date('date_order')->date('Y-m-d');
            $table->date('date_finish')->date('Y-m-d')->nullable();
            $table->timestamps();
        });
        DB::statement("ALTER TABLE bill AUTO_INCREMENT = 1001;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bill');
    }
}
