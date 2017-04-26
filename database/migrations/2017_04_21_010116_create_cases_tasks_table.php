<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCasesTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cases_tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('case_id');
            $table->integer('user_id');
            $table->integer('status_id');
            $table->integer('priority_id');
            $table->integer('category_id');
            $table->dateTime('date_received');
            $table->dateTime('date_booked_out');
            $table->dateTime('commencement_date');
            $table->dateTime('last_activity_date_time');
            $table->string('description');
            $table->string('client_cellphone');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cases_tasks');
    }
}
