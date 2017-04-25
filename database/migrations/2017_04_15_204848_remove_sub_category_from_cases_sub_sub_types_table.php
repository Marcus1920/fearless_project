<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveSubCategoryFromCasesSubSubTypesTable extends Migration
{

    public function up()
    {
       Schema::table('cases_sub_sub_types',function(Blueprint $table){

           $table->dropColumn('sub_category');
       });
    }


    public function down()
    {
        Schema::table('cases_sub_sub_types',function(Blueprint $table){

            $table->integer('sub_category');
        });

    }
}
