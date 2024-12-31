<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('income', function (Blueprint $table) {
            $table->id("income_id")->autoIncrement();
            $table->string('price' , 255);
            $table->string('price_type' , 255)->default('1');
            $table->datetime('date');
            $table->string('note' , 255)->nullable();
            $table->integer('for_id')->nullable();;
            $table->integer('type')->default('1');
            $table->integer('status')->default('1');
            $table->unsignedBigInteger('user_id')->index();
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
        Schema::dropIfExists('income');
    }
}
