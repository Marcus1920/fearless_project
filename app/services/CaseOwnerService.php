<?php

namespace App\Services;
use App\CaseOwner;



class CaseOwnerService
{



    protected $responders;
    protected $activities;

    public function __construct(CaseResponderService $case_responder,CaseActivityService $case_activity)
    {

        $this->responders = $case_responder;
        $this->activities = $case_activity;

    }


    public  function get_case_owner($case_id,$user_id){

        $case_owner = CaseOwner::where('case_id',$case_id)->where('user',$user_id)->first();
        return $case_owner;
    }

    public function create_case_owner($data){

        $caseOwnerObj              = New CaseOwner();
        $caseOwnerObj->case_id     = $data['case_id'];
        $caseOwnerObj->user        = $data['user'];
        $caseOwnerObj->type        = $data['type'];
        $caseOwnerObj->addressbook = $data['addressbook'];
        $caseOwnerObj->save();

    }

    public function get_case_owners() {

        $cases = CaseOwner::with('CaseReport')->get();
        return $cases;
    }

    public function get_cases_with_no_activities(){

        $cases_owners = $this->get_case_owners();

        foreach ($cases_owners as $case_owner){

            //Get the case
            $case           = $this->cases->get_case($case_owner->case_id);

            //get responders
            $responders     = $this->responders->get_responders_by_sub_case_type_and_by_responder($case_owner->user,$case->case_sub_type);



        }



    }


}