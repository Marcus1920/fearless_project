<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class TaskFile extends Eloquent
{
    protected $table    = 'tasks_files';
    protected $fillable = ['task_id','file','file_note'];

    public function CaseTaskFile()
    {
        return $this->hasOne('App\CaseTask','id','task_id');
    }
}
