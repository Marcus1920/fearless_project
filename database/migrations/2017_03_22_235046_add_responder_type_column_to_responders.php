<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddResponderTypeColumnToResponders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('responders',function(Blueprint $table){

            $table->integer('responder_type');
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

            $table->dropColumn('responder_type');

        });
    }
}
