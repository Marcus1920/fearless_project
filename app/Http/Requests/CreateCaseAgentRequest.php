<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateCaseAgentRequest extends Request
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
       return [

            'case_type'      =>'required|not_in:0',
            'case_sub_type'  =>'required|not_in:0',
            'due_date'       =>'required|after:yesterday',
            'estimatedDate'  =>'required|before_or_equal:due_date'


            
        ];
    }
}
