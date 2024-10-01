<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportWeeklyUpstreamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_weekly_upstreams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('logbook_id')->nullable();
            $table->unsignedBigInteger('upstream_id')->nullable();
            $table->date('tanggal')->nullable();
            $table->integer('jumlah_komplain')->nullable();
            $table->foreign('logbook_id')->references('id')->on('logbook_weekly_upstreams')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('upstream_id')->references('id')->on('user_upstreams')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('report_weekly_upstreams');
    }
}
