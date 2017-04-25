<?php

use Illuminate\Database\Seeder;
use App\CaseType;

class CaseTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        # =========================================================================
        # USERS SEEDS
        # =========================================================================

        DB::table('cases_types')->delete();

        $case_types = [
            ['name' => 'speed','slug' => 'speed'],
            ['name' => 'overstay','slug'=>'overstay'],
            ['name' => 'out_of_boundary','slug' => 'out_of_boundary']
        ];

        foreach ($case_types as $case_type) {

            CaseType::create($case_type);
        }

    }
}
