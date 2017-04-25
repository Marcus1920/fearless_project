<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropRespondersFieldsInRespondersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('responders',function(Blueprint $table){

            $table->dropColumn(['first_responder', 'second_responder', 'third_responder']);
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

            $table->integer('first_responder');
            $table->integer('second_responder');
            $table->integer('third_responder');

        });
    }
}
