<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeCaseTypeForeignKeyInResponderTable extends Migration
{

    public function up()
    {
        schema::table('responders',function(Blueprint $table){

                $table->integer('case_type')->unsigned()->change();
                $table->foreign('case_type')->references('id')->on('cases_types');
        });
    }


    public function down()
    {

        schema::table('responders',function(Blueprint $table){

                $table->integer('case_type')->change();
                $table->dropForeign('case_type_type_foreign');
        });
    }
}
