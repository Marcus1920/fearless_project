<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\ResponderType;

class ResponderTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('responder_types')->truncate();
        ResponderType::create(['id' => '1','name' => 'First Responder']);
        ResponderType::create(['id' => '2','name' => 'Second Responder']);
        ResponderType::create(['id' => '3','name' => 'Third Responder']);
		ResponderType::create(['id' => '4','name' => 'Siyaleader First Responder']);
		ResponderType::create(['id' => '5','name' => 'Siyaleader Second Responder']);	
    }
}
