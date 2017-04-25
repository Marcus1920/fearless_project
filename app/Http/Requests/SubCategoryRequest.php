<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SubCategoryRequest extends Request
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [

            'name'     =>'required|unique:cases_sub_types',

        ];
    }
}
