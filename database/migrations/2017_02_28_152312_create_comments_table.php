<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('comment');
            $table->integer('likes');
            $table->integer('admin_id')->unsigned();
            $table->foreign('admin_id')->references('id')->on('admins'); 
            $table->integer('mormal_id')->unsigned();
            $table->foreign('normal_id')->references('id')->on('normals'); 
            $table->integer('song_id')->unsigned();
            $table->foreign('song_id')->references('id')->on('songs');
            $table->integer('group_id')->unsigned();
            $table->foreign('group_id')->references('id')->on('groups'); 
            
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
        Schema::dropIfExists('comments');
    }
}
