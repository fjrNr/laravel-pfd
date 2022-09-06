<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogBorrowingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_borrowing', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('borrowingId')->unsigned();
            $table->foreign('borrowingId')->references('id')->on('borrowings');
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
        Schema::dropIfExists('log_borrowing');
    }
}
