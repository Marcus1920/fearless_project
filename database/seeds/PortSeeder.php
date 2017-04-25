<?php

use Illuminate\Database\Seeder;
use App\Port;

class PortSeeder extends Seeder
{

    public function run()
    {
        DB::table('ports')->truncate();
        Port::create(['id' => '1','name' => 'South Africa']);
        Port::create(['id' => '2','name' => 'Cape Town']);
        Port::create(['id' => '3','name' => 'Durban']);
        Port::create(['id' => '4','name' => 'Johannesburg']);
        Port::create(['id' => '5','name' => 'East London']);
        Port::create(['id' => '6','name' => 'Mossel Bay']);
        Port::create(['id' => '7','name' => 'Ngqura']);
        Port::create(['id' => '8','name' => 'Port Elizabeth']);
        Port::create(['id' => '9','name' => 'Richards Bay']);
        Port::create(['id' => '10','name' => 'Saldanha']);


    }
}
