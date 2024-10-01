<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogbookUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logbook_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("customer_id");
            $table->date("off_date");
            $table->string("off_time");
            $table->string("location_site");
            $table->string("source_problem");
            $table->string("link")->nullable();
            $table->string("segment_isp")->default("None");
            $table->string("segment_user")->nullable();
            $table->date("on_date")->nullable();
            $table->string("on_time")->nullable();
            $table->string("impact")->nullable();
            $table->string("description")->nullable();
            $table->string("action")->nullable();
            $table->string("solved_by")->nullable();
            $table->timestamps();


            $table->foreign("customer_id")->references("id")->on('corpnets')->onDelete("cascade")->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logbook_users');
    }
}
