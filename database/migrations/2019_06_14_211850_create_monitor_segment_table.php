<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonitorSegmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monitor_segment', function (Blueprint $table) {
       		$table->increments('id');
            $table->unsignedInteger('monitor_id');
            $table->unsignedInteger('segment_id');
            $table->timestamps();

            $table->foreign('monitor_id')->references('id')->on('monitors');
            $table->foreign('segment_id')->references('id')->on('segments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('monitor_segment');
    }
}
