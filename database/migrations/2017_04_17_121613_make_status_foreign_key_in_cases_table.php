<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeStatusForeignKeyInCasesTable extends Migration
{

    public function up()
    {

        Schema::table('cases',function(Blueprint $table){

            $table->integer('status')->unsigned()->change();
            $table->foreign('status')->references('id')->on('cases_statuses');
        });

    }


    public function down()
    {

        Schema::table('cases',function(Blueprint $table){

            $table->integer('status')->change();
            $table->dropForeign('cases_status_foreign');

        });

    }
}
