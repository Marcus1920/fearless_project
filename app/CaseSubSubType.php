<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class CaseSubSubType extends Eloquent
{


    protected $table    = 'cases_sub_sub_types';
    protected $fillable = ['name','slug','active'];

}
