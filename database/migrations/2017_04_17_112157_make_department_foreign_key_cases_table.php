<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeDepartmentForeignKeyCasesTable extends Migration
{

    public function up()
    {
        Schema::table('cases',function(Blueprint $table){

            $table->integer('department')->unsigned()->change();
            $table->foreign('department')->references('id')->on('departments');

        });
    }

    public function down()
    {

        Schema::table('cases',function(Blueprint $table){

            $table->integer('department')->change();
            $table->dropForeign('cases_department_foreign');

        });

    }
}
