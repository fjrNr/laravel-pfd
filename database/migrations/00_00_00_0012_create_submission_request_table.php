<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmissionRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submission_request', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('requestId')->unsigned();
            $table->foreign('requestId')->references('id')->on('requests');            
            $table->integer('submissionId')->unsigned();
            $table->foreign('submissionId')->references('id')->on('submissions');
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
        Schema::dropIfExists('submission_request');
    }
}
