<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakePortIdForeignKeyInUsersTable extends Migration
{

    public function up()
    {
       Schema::table('users',function(Blueprint $table){
           $table->integer('port_id')->unsigned()->change();
           $table->foreign('port_id')->references('id')->on('ports');
       });
    }

    public function down()
    {
        Schema::table('users',function(Blueprint $table){

            $table->dropForeign('users_port_id_foreign');
            $table->integer('port_id')->change();

        });
    }
}
