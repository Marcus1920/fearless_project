<?php

use Illuminate\Database\Seeder;
use App\CaseSource;

class CaseSourseSeeder extends Seeder
{

    public function run()
    {


        DB::table('cases_sources')->truncate();

        $case_sources = [
            ['id' => '1','name' => 'sms','slug' => 'sms'],
            ['id' =>'2','name' => 'mobile','slug'=>'mobile'],
            ['id' =>'3','name' => 'computer','slug' => 'computer'],
            ['id' =>'4','name' => 'Gatetrack','slug' => 'Gatetrack']
        ];

        foreach ($case_sources as $case_source) {

            CaseSource::create($case_source);
        }
    }
}
