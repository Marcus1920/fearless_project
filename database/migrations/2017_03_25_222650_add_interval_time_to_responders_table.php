<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIntervalTimeToRespondersTable extends Migration
{

    public function up()
    {
        schema::table('responders',function(Blueprint $table){

            $table->integer('interval_time');
        });
    }


    public function down()
    {

        schema::table('responders',function(Blueprint $table){

            $table->dropColumn('interval_time');
        });

    }
}
