<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportWeekliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_weeklies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('logbook_id')->nullable();
            $table->date('tanggal')->nullable();
            $table->integer('jumlah_komplain')->nullable();
            $table->timestamps();

            $table->foreign('logbook_id')->references('id')->on('logbook_weekly_users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('report_weeklies');
    }
}
