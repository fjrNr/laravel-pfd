<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoxMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('box_movements', function (Blueprint $table) {
            $table->integer('boxId')->unsigned()->primary();
            $table->foreign('boxId')->references('id')->on('boxes');
            $table->integer('movementId')->unsigned();
            $table->foreign('movementId')->references('id')->on('movements');
            $table->string('barcodeNo')->unique()->nullable();
            $table->string('remark')->nullable();
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
        Schema::dropIfExists('box_movements');
    }
}
