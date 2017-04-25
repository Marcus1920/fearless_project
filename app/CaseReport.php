<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class CaseReport extends Eloquent
{


    protected $table    = 'cases';
    protected $fillable = ['description','user','department','case_type','case_sub_type','sub_sub_category','priority','status','gps_lat','gps_lng','img_url','active','severity','source'];

    function department(){

        return $this->hasOne('App\Department','id','department');

    }


    function status() {

        return $this->hasOne('App\CaseStatus','id','status');
    }


}
