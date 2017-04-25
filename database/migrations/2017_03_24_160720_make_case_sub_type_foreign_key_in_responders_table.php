<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeCaseSubTypeForeignKeyInRespondersTable extends Migration
{

    public function up()
    {
        schema::table('responders',function(Blueprint $table){

            $table->integer('case_sub_type')->unsigned()->change();
            $table->foreign('case_sub_type')->references('id')->on('cases_sub_types');
        });

    }

    public function down()
    {

        schema::table('responders',function(Blueprint $table){

            $table->integer('case_sub_type')->change();
            $table->dropForeign('case_sub_type_foreign');

        });

    }
}
