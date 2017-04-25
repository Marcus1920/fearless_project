<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriverVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_vehicles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Model');
            $table->string('Make');
            $table->string('Color');
            $table->string('VehicleRegNo');
            $table->integer('driver_id');
            $table->integer('company_id');
            $table->string('timeIn');
            $table->string('returned');
            $table->string('purpose');
            $table->string('gate');
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
        Schema::drop('driver_vehicles');
    }
}
