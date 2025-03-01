<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEventIdToScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('schedule', function (Blueprint $table) {
            $table->unsignedBigInteger('event_id')->after('id');
            $table->foreign('event_id')
                  ->references('id')
                  ->on('event')
                  ->onDelete('cascade');    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('schedule', function (Blueprint $table) {
            $table->dropForeign(['event_id']);
            $table->dropColumn('event_id');
        });
    }
}
