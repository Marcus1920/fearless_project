<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class CaseTask extends Eloquent
{
    protected $table    = 'cases_tasks';
    protected $fillable = ['case_id','user_id','status_id','priority_id','category_id','date_received','date_booked_out','commencement_date','last_activity_date_time','description','client_cellphone'];

    function CaseReport()
    {
        return $this->hasOne('App\CaseReport','id','case_id');
    }

    function TaskUser()
    {
        return $this->hasMany('App\UserNew','id','user_id');
    }

    function TaskStatus()
    {
        return $this->hasOne('App\TaskStatus','id','status_id');
    }

    function TaskNote()
    {
        return $this->belongsTo('App\TaskNote');
    }

    function TaskPriority()
    {
        return $this->hasOne('App\TaskPriority','id','priority_id');
    }

    function TaskCategory()
    {
        return $this->hasOne('App\TaskCategory','id','category_id');
    }

    function TaskFile()
    {
        return $this->belongsToMany('App\TaskFile');
    }

    function CaseSubTask()
    {
        return $this->belongsToMany('App\CaseSubTask');
    }
}
