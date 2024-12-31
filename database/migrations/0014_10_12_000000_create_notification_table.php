<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification', function (Blueprint $table) {
            $table->id("notification_id")->autoIncrement();
            $table->longtext('text');
            $table->integer('type')->default('1');
            $table->unsignedBigInteger('movement_id')->index();
            $table->unsignedBigInteger('from_user_id')->index();
            $table->unsignedBigInteger('to_user_id')->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->integer('status')->default('1');
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
        Schema::dropIfExists('notification');
    }
}
