<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class TaskPriority extends Eloquent
{
    protected $table    = 'tasks_priorities';
    protected $fillable = ['name'];

    public function CaseTaskPriority()
    {
        return $this->belongsTo('App\CaseTask');
    }
}
