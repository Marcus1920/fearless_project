<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDepartmentForeignKeyCaseTypesTable extends Migration
{

    public function up()
    {
        Schema::table('cases_types',function(Blueprint $table){

            $table->integer('department')->unsigned()->change();
            $table->foreign('department')->references('id')->on('departments');

        });
    }


    public function down()
    {
        Schema::table('cases_types',function(Blueprint $table){

            $table->integer('department')->change();
            $table->dropForeign('department_foreign');

        });

    }
}
