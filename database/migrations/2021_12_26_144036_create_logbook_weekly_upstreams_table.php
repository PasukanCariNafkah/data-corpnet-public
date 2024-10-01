<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogbookWeeklyUpstreamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logbook_weekly_upstreams', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->bigInteger('parent_id')->unsigned()->nullable();
            $table->foreign('parent_id')->on('logbook_weekly_upstreams')->references('id')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('logbook_weekly_upstreams');
    }
}
