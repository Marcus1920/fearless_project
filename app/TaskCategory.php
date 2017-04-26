<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class TaskCategory extends Eloquent
{
    protected $table    = 'tasks_categories';
    protected $fillable = ['name'];

    public function CaseTaskCategory()
    {
        return $this->belongsTo('App\CaseTask');
    }
}
