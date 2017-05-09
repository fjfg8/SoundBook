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
            //$table->increments('id');
            $table->integer('user_id1')->unsigned();
            $table->foreign('user_id1')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('user_id2')->unsigned();
            $table->foreign('user_id2')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->primary(['user_id1','user_id2']);
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
