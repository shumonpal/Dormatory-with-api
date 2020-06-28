<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index('users');
            $table->integer('room_id')->unsigned()->index('rooms');
            $table->integer('company_id')->unsigned()->index('companies');
            $table->string('name');
            $table->string('indentity');
            $table->string('others')->nullable();
            $table->timestamps();


            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('CASCADE');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('people');
    }
}
