<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeResponderTypeForeignKeyInRespondersTable extends Migration
{
    public function up()
    {
        schema::table('responders',function(Blueprint $table){

            $table->integer('responder_type')->unsigned()->change();
            $table->foreign('responder_type')->references('id')->on('responder_types');
        });
    }


    public function down()
    {
        schema::table('responders',function(Blueprint $table){

            $table->integer('responder_type')->change();
            $table->dropForeign('responder_type_foreign');
        });

    }
}
