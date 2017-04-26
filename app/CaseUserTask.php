<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class CaseUserTask extends Eloquent
{
    protected $table    = 'cases_users_tasks';
    protected $fillable = ['user_id','task_id'];

    public function TaskUser()
    {
        return $this->hasOne('App\UserNew','id','user_id');
    }

    public function CaseTask()
    {
        return $this->hasMany('App\CaseTask','id','task_id');
    }
}
