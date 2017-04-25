<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class GateTrackRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function wantsJson()
    {
        return true;
    }


    public function rules()
    {
        return [
            'DriverCompany.CompanyName'     =>'required',
        ];
    }
}
