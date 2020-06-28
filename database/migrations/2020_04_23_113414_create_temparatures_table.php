<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemparaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temparatures', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index('users');
            $table->integer('room_id')->unsigned()->index('rooms');
            $table->integer('people_id')->unsigned()->index('people');
            $table->integer('morning')->nullable();
            $table->integer('evenning')->nullable();
            $table->string('remark')->nullable();
            $table->timestamps();


            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('CASCADE');
            $table->foreign('people_id')->references('id')->on('people')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('temparatures');
    }
}
