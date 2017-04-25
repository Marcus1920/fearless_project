<?php

namespace App\Services;
use App\CaseType;


class CaseTypeService
{

    public function getCaseTypes(){

        return CaseType::all();
    }

}