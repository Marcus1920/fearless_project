<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddResponderFieldInRespondersTable extends Migration
{

    public function up()
    {
        schema::table('responders',function(Blueprint $table){

            $table->integer('responder')->unsigned();
            $table->foreign('responder')->references('id')->on('users');

        });
    }

    public function down()
    {

        schema::table('responders',function(Blueprint $table){

            $table->dropColumn('responder');
            $table->integer('responder')->change();
            $table->dropForeign('responder_foreign');

        });


    }
}
