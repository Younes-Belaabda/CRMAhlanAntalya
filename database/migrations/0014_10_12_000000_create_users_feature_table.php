<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersFeatureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_feature', function (Blueprint $table) {
            $table->id("users_feature_id")->autoIncrement();
            $table->unsignedBigInteger('user_id')->index();
            $table->string('background' , 255);
            $table->string('color' , 255);
            $table->string('size' , 255);
            $table->string('wight' , 255);
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
        Schema::dropIfExists('users_feature');
    }
}
