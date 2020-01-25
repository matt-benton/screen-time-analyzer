<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOnDeleteCascadeToSegmentSymptom extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('segment_symptom', function (Blueprint $table) {
            $table->dropForeign('segment_symptom_segment_id_foreign');
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
        Schema::table('segment_symptom', function (Blueprint $table) {
            $table->dropForeign('segment_symptom_segment_id_foreign');
            $table->foreign('segment_id')->references('id')->on('segments')->change();
        });
    }
}
