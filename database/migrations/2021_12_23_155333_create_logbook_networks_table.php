<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogbookNetworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logbook_networks', function (Blueprint $table) {
            $table->id();
            $table->string('area');
            $table->string('off_date');
            $table->string('off_time');
            $table->string('on_date')->nullable();
            $table->string('on_time')->nullable();
            $table->string('sites');
            $table->string('segment');
            $table->string('impact')->nullable();
            $table->string('description')->nullable();
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
        Schema::dropIfExists('logbook_networks');
    }
}
