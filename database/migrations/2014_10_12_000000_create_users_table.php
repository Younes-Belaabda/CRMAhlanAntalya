<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('user_name',255)->unique();
            $table->string('email',255)->unique();
            $table->string('password',255);
            $table->string('full_name',255)->nullable();
            $table->string('background',255)->default("#fff");
            $table->string('color',255)->default("#000");
            $table->integer('type')->default('1');
            $table->integer('status')->default('1');
            $table->longText('token')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
