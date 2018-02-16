<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFriendshipsTable extends Migration
{
    public function up()
    {
        Schema::create('friendships', function(Blueprint $table){
            $table->increments('id');
            $table->integer('user_id_A');
            $table->integer('user_id_B');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('friendships');
    }
}
