<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPortToUsersTable extends Migration
{

    public function up()
    {
        schema::table('users',function(Blueprint $table){

            $table->integer('port_id');

        });
    }

    public function down()
    {
        schema::table('users',function(Blueprint $table){

            $table->dropColumn('port_id');

        });
    }
}
