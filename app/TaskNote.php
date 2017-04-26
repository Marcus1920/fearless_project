<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class TaskNote extends Eloquent
{
    protected $table    = 'tasks_notes';
    protected $fillable = ['task_id','name'];

    public function CaseTask()
    {
        return $this->hasOne('App\CaseTask','id','task_id');
    }
}
