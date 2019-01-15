<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSegmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('segments', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->unsignedInteger('session_id');
            $table->unsignedInteger('activity_id');
            $table->unsignedInteger('glasses_id');
            $table->unsignedInteger('monitor_id');
            $table->unsignedInteger('seat_id');
            $table->unsignedInteger('eye_condition_id');
            $table->timestamps();

            $table->foreign('session_id')->references('id')->on('sessions')->onDelete('cascade');
            $table->foreign('activity_id')->references('id')->on('activities');
            $table->foreign('glasses_id')->references('id')->on('glasses');
            $table->foreign('monitor_id')->references('id')->on('monitors');
            $table->foreign('seat_id')->references('id')->on('seats');
            $table->foreign('eye_condition_id')->references('id')->on('eye_conditions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('segments');
    }
}
