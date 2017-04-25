<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrucksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trucks', function (Blueprint $table) {
            $table->increments('id');
			$table->string('company');
			$table->string('registration_number');
			$table->string('reference_number');
			$table->string('vin_number');
			$table->string('chassis_number');
			$table->string('engine_number');
			$table->string('registration_year');
			$table->string('make');
			$table->string('model');
			$table->string('colour');
			$table->string('speed_limit');
			$table->string('date_inactive');
			$table->integer('created_by');
			$table->integer('updated_by');
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
        Schema::drop('trucks');
    }
}
