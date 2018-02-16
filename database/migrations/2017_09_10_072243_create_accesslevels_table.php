<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccesslevelsTable extends Migration
{
    public function up()
    {
        Schema::create('accesslevels', function(Blueprint $table){
            $table->increments('id');
            $table->string('accesslevel');
        });
    }

    public function down()
    {
         Schema::dropIfExists('accesslevels');
    }
}
