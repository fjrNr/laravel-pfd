<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmissionBorrowingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submission_borrowing', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('borrowingId')->unsigned();
            $table->foreign('borrowingId')->references('id')->on('borrowings');
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
        Schema::dropIfExists('submission_borrowing');
    }
}
