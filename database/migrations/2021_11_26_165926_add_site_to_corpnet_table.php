<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSiteToCorpnetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('corpnets', function (Blueprint $table) {
            $table->string("site")->default("Bandung")->after("alamat");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('corpnets', function (Blueprint $table) {
            if (Schema::hasColumn('corpnets', 'site')) {
                $table->dropColumn('site');
            }
        });
    }
}
