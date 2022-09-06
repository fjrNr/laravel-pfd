<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_request', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('requestId')->unsigned();
            $table->foreign('requestId')->references('id')->on('requests');
            $table->integer('logId')->unsigned();
            $table->foreign('logId')->references('id')->on('logs');
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
        Schema::dropIfExists('log_request');
    }
}
