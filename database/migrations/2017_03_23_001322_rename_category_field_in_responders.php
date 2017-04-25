<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameCategoryFieldInResponders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('responders',function(Blueprint $table){

            $table->renameColumn('category','case_type');
            $table->renameColumn('sub_category','case_sub_type');
            $table->renameColumn('sub_sub_category','case_sub_sub_type');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('responders',function(Blueprint $table){

            $table->renameColumn('case_type','category');
            $table->renameColumn('case_sub_type','sub_category');
            $table->renameColumn('case_sub_sub_type','sub_sub_category');

        });
    }
}
