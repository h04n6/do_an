<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title');
            $table->text('company_name')->nullable();
            $table->text('description')->nullable();
            $table->text('keywords')->nullable();
            $table->text('working_hours')->nullable();
            $table->text('address')->nullable();
            $table->text('geo_address')->nullable();
            $table->integer('hotline')->nullable();
            $table->integer('mobile')->nullable();
            $table->text('email')->nullable();
            $table->text('facebook')->nullable();
            $table->text('google_plus')->nullable();
            $table->text('twitter')->nullable();
            $table->text('youtube_channel')->nullable();
            $table->text('image')->nullable();
            $table->text('favicon')->nullable();
            $table->text('icon')->nullable();
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
        Schema::dropIfExists('config');
    }
}
