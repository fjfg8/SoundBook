<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('user_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id1')->unsigned();
            $table->foreign('user_id1')->references('id')->on('users');
            $table->integer('user_id2')->unsigned();
            $table->foreign('user_id2')->references('id')->on('users');
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
        //
        Schema::dropIfExists('user_user');
    }
}
