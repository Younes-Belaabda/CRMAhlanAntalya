<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movement', function (Blueprint $table) {
            $table->id("movement_id")->autoIncrement();
            $table->string('customer' , 255);
            $table->dateTime('date')->nullable();
            $table->longtext('description' , 255);
            $table->string('price' , 255)->default('0');
            $table->string('price_type' , 255)->default('1');
            $table->string('net' , 255)->default('0');
            $table->string('revenue' , 255)->default('0');
            $table->string('commission' , 255)->default('0');
            $table->integer('type')->default('1');
            $table->integer('color')->nullable();
            $table->integer('paybyus')->default('0');
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('user_id')->index();
            $table->integer('status')->default('0');
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
        Schema::dropIfExists('movement');
    }
}
