<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTruckCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('truck_companies', function (Blueprint $table) {
            $table->increments('id');
			$table->string('reg_company_name');
			$table->string('company_trading_name');
			$table->string('company_reg_number');
			$table->string('company_tax_number');
			$table->string('physical_address');
			$table->string('postal_address');
			$table->string('contact_person');
			$table->string('contact_email')->unique();
			$table->string('contact_phone_number')->unique();
			$table->string('fax_number');
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
        Schema::drop('truck_companies');
    }
}
