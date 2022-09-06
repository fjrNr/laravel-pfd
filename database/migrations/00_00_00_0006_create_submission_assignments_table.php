<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmissionAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submission_assignments', function (Blueprint $table) {
            $table->integer('submissionId')->unsigned()->primary();
            $table->foreign('submissionId')->references('id')->on('submissions');
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
        Schema::dropIfExists('submission_assignments');
    }
}
