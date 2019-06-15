<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOnDeleteCascadeToMonitorSegment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('monitor_segment', function (Blueprint $table) {
            $table->dropForeign('monitor_segment_segment_id_foreign');
            $table->foreign('segment_id')->references('id')->on('segments')->onDelete('cascade')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('monitor_segment', function (Blueprint $table) {
            $table->dropForeign('monitor_segment_segment_id_foreign');
            $table->foreign('segment_id')->references('id')->on('segments')->change();    
        });
    }
}
