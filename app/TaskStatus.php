<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class TaskStatus extends Eloquent
{
    protected $table    = 'tasks_statuses';
    protected $fillable = ['name'];

    public function CaseTaskStatus()
    {
        return $this->belongsTo('App\CaseTask');
    }
}
