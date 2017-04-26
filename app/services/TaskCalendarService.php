<?php

namespace App\Services;
use App\CaseTask;

class TaskCalendarService {
	public function getTasks(){
		return CaseTask::all();
	}
	
	public function getOverdueTasks(){
		return CaseTask::where('status_id','=',2)->get();
	}
}
