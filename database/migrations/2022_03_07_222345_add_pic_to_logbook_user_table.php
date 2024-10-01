<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPicToLogbookUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('logbook_users', function (Blueprint $table) {
            $table->string("follow_up_by")->nullable()->after('action');
            $table->string("status")->nullable()->after("follow_up_by");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('logbook_users', function (Blueprint $table) {
            if (Schema::hasColumn('corpnets', 'follow_up_by')) {
                $table->dropColumn('follow_up_by');
            }
            if (Schema::hasColumn('corpnets', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
}
