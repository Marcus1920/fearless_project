<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameCategoriesToCaseTypesInCasesTable extends Migration
{

    public function up()
    {
        Schema::table('cases',function(Blueprint $table){

            $table->dropColumn('category');
            $table->dropColumn('sub_category');
            $table->dropColumn('sub_sub_category');

        });
    }

    public function down()
    {
        Schema::table('cases',function(Blueprint $table){

            $table->integer('category');
            $table->integer('sub_category');
            $table->integer('sub_sub_category');

        });
    }
}
