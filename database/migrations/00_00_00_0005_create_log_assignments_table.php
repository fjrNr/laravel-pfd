<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_assignments', function (Blueprint $table) {
            $table->integer('logId')->unsigned()->primary();
            $table->foreign('logId')->references('id')->on('logs');
            $table->integer('boxId')->unsigned();
            $table->foreign('boxId')->references('id')->on('boxes');
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
        Schema::dropIfExists('log_assignments');
    }
}
