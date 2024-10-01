<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogbookUpstreamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logbook_upstreams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('upstream_id');
            $table->string('off_date');
            $table->string('off_time');
            $table->string('location_site');
            $table->string('link');
            $table->string('segment');
            $table->string('on_date')->nullable();
            $table->string('on_time')->nullable();
            $table->string('impact')->nullable();
            $table->string('description')->nullable();
            $table->string('tiket_id')->nullable();
            $table->timestamps();

            $table->foreign('upstream_id')->references('id')->on('user_upstreams')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logbook_upstreams');
    }
}
