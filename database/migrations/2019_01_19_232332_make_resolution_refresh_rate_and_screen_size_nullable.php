<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeResolutionRefreshRateAndScreenSizeNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('monitors', function (Blueprint $table) {
            $table->string('screen_size')->nullable()->change();
            $table->string('resolution')->nullable()->change();
            $table->string('refresh_rate')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('monitors', function (Blueprint $table) {
            $table->string('screen_size')->change();
            $table->string('resolution')->change();
            $table->string('refresh_rate')->change();
        });
    }
}
