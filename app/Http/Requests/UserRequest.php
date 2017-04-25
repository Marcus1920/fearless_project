<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserRequest extends Request
{

    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'role'          =>'required|not_in:0',
            'title'         =>'required|not_in:0',
            'name'          =>'required',
            'surname'       =>'required',
            'language'      =>'required|not_in:0',
            'cellphone'     =>'required|not_in:0|digits:10|unique:users,cellphone',
            'email'         =>'email|unique:users,email',
            'dob'           =>'required|olderThan:16'

        ];
    }
}
