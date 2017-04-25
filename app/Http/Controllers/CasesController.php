<?php

namespace App\Http\Controllers;

use App\CaseSubType;
use App\CaseType;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CaseRequest;
use App\Http\Requests\CaseRequestH;
use App\Http\Requests\CreateCaseRequest;
use App\Http\Requests\CreateCaseAgentRequest;
use App\Http\Controllers\Controller;
use App\CaseReport;
use App\CaseStatus;
use App\CaseOwner;
use App\User;
use App\UserRole;
use App\addressbook;
use App\CaseEscalator;
use App\CaseActivity;
use App\Department;
use App\Category;
use App\SubCategory;
use App\SubSubCategory;
use App\CaseResponder;
use App\CriticalTeam;
use App\Language;
use App\Province;
use App\District;
use App\Municipality;
use App\Ward;
use App\CasePriority;
use App\Title;
use App\CaseRelated;
use App\CasePoi;
use App\Poi;
use App\PoiAssociate;
use App\UserNew;
use Validator;
use App\Messagenotifications;
use App\Driver;
use App\DriverCompany;
use App\DriverVehicle;
use App\Services\CaseOwnerService;
use App\Services\CaseResponderService;
use App\Services\CaseActivityService;





class CasesController extends Controller
{


    protected $case_responders;
    protected $case_owners;
    protected $case_activities;

    public function __construct(CaseResponderService $responder_service,CaseOwnerService $case_owner_service,CaseActivityService $case_activity_service) {

        $this->case_responders   = $responder_service;
        $this->case_owners       = $case_owner_service;
        $this->case_activities   = $case_activity_service;

    }



    public function index($id)
    {

        $myCases = CaseOwner::where('user', '=', \Auth::user()->id)
            ->get();

        $otherCases = CaseReport::where('user', '=', \Auth::user()->id)
            ->get();
        $caseIds = array();


        foreach ($myCases as $case) {

            $caseIds[] = $case->case_id;
        }

        foreach ($otherCases as $caseOld) {

            $caseIds[] = $caseOld->id;
        }

        $caseIds = array_unique($caseIds);
        $userRoleObj = UserRole::find(\Auth::user()->role);

		$user = User::where('name','=',$id)->first();

        if ($userRoleObj->id == 1) {
           $cases = \DB::table('cases')
                ->join('cases_owners', 'cases.id', '=', 'cases_owners.case_id')
                ->join('cases_statuses', 'cases.status', '=', 'cases_statuses.id')
                ->join('cases_sources', 'cases.source', '=', 'cases_sources.id')
                ->join('cases_priorities', 'cases.priority', '=', 'cases_priorities.id')
				->join('cases_escalations', 'cases.id', '=', 'cases_escalations.case_id')
			   ->join('departments','cases.department','=','departments.id')
               ->where('cases_statuses.name', '=', 'Allocated')
               ->orWhere('cases_statuses.name', '=', 'Referred')
               ->select(
                    \DB::raw("
                                        cases.id,
                                        cases.created_at,
                                        cases.description,
                                        cases_priorities.name as CasePriority,
                                        cases_statuses.name as CaseStatus,
										cases_owners.accept,
										cases_sources.name as source,
                                        departments.name as department,
										cases_escalations.due_date as due_date,
										cases.gps_lat,
										cases_owners.type
                                        "
                    )
                )
                ->groupBy('cases.id');


        } else {

            if ($userRoleObj->id !== 1) {


               $cases = \DB::table('cases')
                ->join('cases_owners', 'cases.id', '=', 'cases_owners.case_id')
                ->join('cases_statuses', 'cases.status', '=', 'cases_statuses.id')
                ->join('cases_sources', 'cases.source', '=', 'cases_sources.id')
				->join('cases_escalations', 'cases.id', '=', 'cases_escalations.case_id')
                   ->join('cases_priorities', 'cases.priority', '=', 'cases_priorities.id')
			   ->join('departments','cases.department','=','departments.id')
                ->where('cases_statuses.id', '=', 4)
               ->where('cases_escalations.to', '=', \Auth::user()->id)

                ->select(
                    \DB::raw("
                                        cases.id,
                                        cases.created_at,
                                        cases.description,
                                        cases_statuses.name as CaseStatus,
                                        cases_priorities.name as CasePriority,
										cases_owners.accept,
										cases_sources.name as source,
										departments.name as department,
                                        cases.gps_lat,
										cases_escalations.due_date as due_date,
										cases_owners.type
                                        "
                    )
                )
                ->groupBy('cases.id');

            } else {
				$cases = \DB::table('cases')
                ->join('cases_owners', 'cases.id', '=', 'cases_owners.case_id')
                ->join('cases_statuses', 'cases.status', '=', 'cases_statuses.id')
                ->join('cases_sources', 'cases.source', '=', 'cases_sources.id')
				->join('cases_escalations', 'cases.id', '=', 'cases_escalations.case_id')
                    ->join('cases_priorities', 'cases.priority', '=', 'cases_priorities.id')
			   ->join('departments','cases.department','=','departments.id')
                ->where('cases_statuses.id', '=', 4)
                ->where('cases_escalations.to', '=', $user->id)
                ->select(
                    \DB::raw("
                                        cases.id,
                                        cases.created_at,
                                        cases.gps_lat,
                                        cases.description,
                                         cases_priorities.name as CasePriority,
                                        cases_statuses.name as CaseStatus,
										cases_owners.accept,
										cases_sources.name as source,
										departments.name as department,
										cases_escalations.due_date as due_date,
										cases_owners.type
                                        "
                    )
                )
                ->groupBy('cases.id');


            }

        }

//die("WtF!? \$cases <pre>".print_r($cases->get(),1)."</pre>");
        return \Datatables::of($cases)

            ->addColumn('actions', '<a class="btn btn-xs btn-alt" data-toggle="modal" onClick="launchCaseModal({{$id}},1)" data-target=".modalCase">View</a>

                                                   <!-- <a class="btn btn-xs btn-alt" data-toggle="modal" href="view-case-poi-associates/{{ $id }}" target="_blank">View POI association chart</a>-->

                                                    @if(!empty($gps_lat))<a class="btn btn-xs btn-alt" data-toggle="modal" href="case_map/{{ $id }}" target="_blank">Map</a>@endif




                                ')
            ->make(true);
    }



    public function casemap($id) {


        $case            = CaseReport::find($id);
        $marker_status   = $this->get_case_marker_status($case->status);
        $marker_category = $this->get_case_marker_category($case->category);
        $markerName      = $marker_category.$marker_status;

        return view('cases.map',compact('case','markerName'));
    }


    public function get_case_marker_status($status){

        switch ($status) {

            case 1:
                $imageStatus = "_pen.png";//Pending
            case 7:
                $imageStatus = "_all.png";//Allocated
            case 4:
                $imageStatus = "_ref.png";//Referred
            case 2:
                $imageStatus = "_clo.png";//Pending Closure
            case 3:
                $imageStatus = "_res.png";//Pending Closure
            default :
                $imageStatus = "_pen.png";//Pending


        }

        return $imageStatus;
    }

    public function get_case_marker_category($category) {


        switch ($category) {

            case 1:
                $imageCategory          = "mc";

            default :
                $imageCategory          = "mc";


        }

        return $imageCategory;

    }




	    public function requestCaseClosureList()
    {


        $userRoleObj = UserRole::find(\Auth::user()->role);


        if ($userRoleObj->id == 1) {


            $cases = \DB::table('cases')
                ->join('cases_statuses', 'cases.status', '=', 'cases_statuses.id')
                ->join('cases_sources', 'cases.source', '=', 'cases_sources.id')
                ->join('cases_priorities', 'cases.priority', '=', 'cases_priorities.id')
                ->where('cases_statuses.name', '=', 'Pending Closure')
                ->select(
                    \DB::raw("

                                    cases.id,
                                    cases.created_at,
                                    cases.description,
                                    cases_sources.name as source,
                                     cases_priorities.name as CasePriority,
                                    cases_statuses.name as status"
                    )
                );


            return \Datatables::of($cases)
                ->addColumn('actions', '<a class="btn btn-xs btn-alt" data-toggle="modal" onClick="launchCaseModal({{$id}},1);" data-target=".modalCase">View</a>
                                                 <!--  <a class="btn btn-xs btn-alt" data-toggle="modal" href="view-case-poi-associates/{{ $id }}" target="_blank">View POI association chart</a>-->
                                                    ')
                ->make(true);
        } else {

            $cases = \DB::table('cases')
                ->join('cases_statuses', 'cases.status', '=', 'cases_statuses.id')
                ->join('cases_sources', 'cases.source', '=', 'cases_sources.id')
                ->where('cases_statuses.name', '=', 'Pending Closure')
                ->where('user', '=', \Auth::user()->id)
                ->select(
                    \DB::raw("

                                    cases.id,
                                    cases.created_at,
                                    cases.description,
                                    cases_sources.name as source,
                                    cases_statuses.name as status"
                    )
                );


            return \Datatables::of($cases)
                ->addColumn('actions', '<a class="btn btn-xs btn-alt" data-toggle="modal" onClick="launchCaseModal({{$id}},1);" data-target=".modalCase">View</a>
                                                 <!--  <a class="btn btn-xs btn-alt" data-toggle="modal" href="view-case-poi-associates/{{ $id }}" target="_blank">View POI association chart</a>-->
                                                    ')
                ->make(true);

        }


    }

	public function calendarList(){

       $events    = CaseEscalator::select('id','title','start','end','color')->get();
       echo json_encode($events);
	}

	public function calendarListPerUser($id)
    {


	$user = User::where('name','=',$id)->first();

       $events    = CaseEscalator::select('id','title','start','end','color')->where('to','=',$user->id)->get();
       echo json_encode($events);

    }


	public function mobilecalendarListPerUser()
    {
		$api_key  = \Input::get('api_key');

		$user  = User::where('api_key','=',$api_key )->first();

     //  $events    = CaseEscalator::select('id','title','start','end','color', 'description' 'department' '' 'investigation_note'  'message' )->where('to','=',$user->id)->get();
        $events = \DB::table('cases_escalations')
						->join('departments','cases_escalations.department','=','departments.id')
						->join('categories','cases_escalations.category','=','categories.id')
						->join('cases_statuses', 'cases_escalations.status', '=', 'cases_statuses.id')

					    ->join('sub_categories', 'cases_escalations.sub_category', '=', 'sub_categories.id')

                        ->select(\DB::raw( "
                                    cases_escalations.id,
                                    cases_escalations.title,
                                    cases_escalations.start,
                                    cases_escalations.end,
									cases_escalations.color,
									cases_escalations.description,
									cases_escalations.message,
									cases_escalations.investigation_note,
                                    departments.name  as department,
									cases_statuses.name  as status,

									categories.name as category,
									sub_categories.name as sub_category
									")
									)->get() ;




	   echo json_encode($events);

    }



    public function resolvedCasesList()
    {

        $userRoleObj = UserRole::find(\Auth::user()->role);

        if ($userRoleObj->id == 1) {

            $cases = \DB::table('cases')
                ->join('cases_statuses', 'cases.status', '=', 'cases_statuses.id')
                ->join('cases_sources', 'cases.source', '=', 'cases_sources.id')
                ->join('cases_priorities', 'cases.priority', '=', 'cases_priorities.id')

                ->where('cases_statuses.name', '=', 'Resolved')
                ->select(
                    \DB::raw("

                                    cases.id,
                                    cases.created_at,
                                    cases.description,
                                    cases_sources.name as source,
                                    cases_priorities.name as CasePriority,
                                    cases_statuses.name as status"
                    )
                );

            return \Datatables::of($cases)
                ->addColumn('actions', '<a class="btn btn-xs btn-alt" data-toggle="modal" onClick="launchCaseModal({{$id}},1);" data-target=".modalCase">View</a>

                                    <!-- <a class="btn btn-xs btn-alt" data-toggle="modal" href="view-case-poi-associates/{{ $id }}" target="_blank">View POI association chart</a>')

                ->make(true);
        } else {


            $cases = \DB::table('cases')
                ->join('cases_statuses', 'cases.status', '=', 'cases_statuses.id')
                ->join('cases_sources', 'cases.source', '=', 'cases_sources.id')
                ->where('cases_statuses.name', '=', 'Resolved')
                ->where('user', '=', \Auth::user()->id)
                ->select(
                    \DB::raw("

                                    cases.id,
                                    cases.created_at,
                                    cases.description,
                                    cases_sources.name as source,
                                    cases_statuses.name as status"
                    )
                );


            return \Datatables::of($cases)
                ->addColumn('actions', '<a class="btn btn-xs btn-alt" data-toggle="modal" onClick="launchCaseModal({{$id}},1);" data-target=".modalCase">View</a>

                                            <!--   <a class="btn btn-xs btn-alt" data-toggle="modal" href="view-case-poi-associates/{{ $id }}" target="_blank">View POI association chart</a>

                                                    ')
                ->make(true);

        }
    }

    public function pendingReferralCasesList()
    {


        $userRoleObj = UserRole::find(\Auth::user()->role);

        if ($userRoleObj->id == 1) {


            $cases = \DB::table('cases')
                ->join('cases_statuses', 'cases.status', '=', 'cases_statuses.id')
                ->join('cases_priorities', 'cases.priority', '=', 'cases_priorities.id')
                ->join('cases_sources', 'cases.source', '=', 'cases_sources.id')
                ->where('cases_statuses.name', '=', 'Pending')
                ->select(
                    \DB::raw("

                                    cases.id,
                                    cases.created_at,
                                    cases.description,
                                    cases_sources.name as source,
                                     cases_priorities.name as CasePriority,
                                    cases_statuses.name as CaseStatus"
                    )
                );


        } else {

 // its  doent  pick   up  the  first  condition
            $cases = \DB::table('cases')
                ->join('cases_statuses', 'cases.status', '=', 'cases_statuses.id')
                ->join('cases_sources', 'cases.source', '=', 'cases_sources.id')
                ->join('cases_priorities', 'cases.priority', '=', 'cases_priorities.id')
                ->where('cases_statuses.name', '=', 'Pending')
                ->select(
                    \DB::raw("

                                            cases.id,
                                            cases.created_at,
                                            cases.description,
                                            cases_sources.name as source,
                                            cases_priorities.name as CasePriority,
                                            cases_statuses.name as CaseStatus"
                    )
                );


        }


        return \Datatables::of($cases)
            ->addColumn('actions', '<a class="btn btn-xs btn-alt" data-toggle="modal" onClick="launchCaseModal({{$id}},1);" data-target=".modalCase">View</a>

                                                  <!-- <a class="btn btn-xs btn-alt" data-toggle="modal" href="view-case-poi-associates/{{ $id }}" target="_blank">View POI association chart</a>-->
                                                    ')
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function acceptCase($id)
    {

         $caseOwnerObj = CaseOwner::where("case_id",'=',$id)
                                   ->where("user",'=',\Auth::user()->id)
                                   ->first();

         $numberCases   = CaseReport::where('user','=',\Auth::user()->id)->get();



        if (sizeof($caseOwnerObj) > 0)
        {
            $caseOwnerObj->accept = 1;
            $caseOwnerObj->save();
            $caseActivity              = New CaseActivity();
            $caseActivity->case_id      = $id;
            $caseActivity->user        = \Auth::user()->id;
            $caseActivity->addressbook = 0;
            $caseActivity->note        = "Case Accepted by ".\Auth::user()->name.' '.\Auth::user()->surname;
            $caseActivity->save();

            $case = CaseReport::find($id);
            if($case->status == "Pending") {
                $case->status      = "Actioned";
                $case->accepted_at = \Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString();
                $case->save();
            }

            $caseOwners = CaseOwner::where("case_id",'=',$id)
                                     ->where("user","<>",\Auth::user()->id)
                                     ->get();

            foreach ($caseOwners as $owner) {

                if ($owner->addressbook == 1) {

                    $user = AddressBook::find($owner->user);

                }
                else {

                    $user = User::find($owner->user);


                }

                $data = array(
                                    'name'   =>$user->name,
                                    'caseID' =>$id,
                                    'acceptedBy' => \Auth::user()->name.' '.\Auth::user()->surname,
                                );


                \Mail::send('emails.acceptCase',$data, function($message) use ($user)
                {
                    $message->from('info@siyaleader.net', 'Siyaleader');
                    $message->to($user->email)->subject("Siyaleader Notification - New Case Accepted: ");

               });

            }



        }

            return "ok";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function captureCase(Request $request)
    {


      $repId       = 0;
      $addressbook = 0;

        if(!$request['repID']){


                $user                              = new User();
                $user->role                        = 5;
                $user->title                       = 1;
                $user->language                    = 1;
                $user->gender                      = 1;
                $user->name                        = $request['name'];
                $user->surname                     = $request['surname'];
                $user->cellphone                   = $request['mobile'];
                $user->email                       = $request['mobile']."siyaleader.net";
                $user->active                      = 2;
                $user->province                    = $request['province'];
                $user->district                    = $request['district'];
                $user->municipality                = $request['municipality'];
                $user->ward                        = $request['ward'];
                $user->position                    = 3;
                $password                          = rand(1000,99999);
                $user->password                    = \Hash::make($password);
                $user->area                        = $request['area'];
                $user->api_key                     = uniqid();
                $user->created_by                  = \Auth::user()->id;


                $user->save();

                $repId = $user->id;





        } else {

             $repId  = $request['repID'];

        }


        $description = preg_replace("/[^ \w]+/", "", $request['description']);

        $gps                               = explode(",",$request['GPS']);
        $case                              = new CaseReport();
        $case->description                 = $description;
        $case->user                        = "";
        $case->status                      = 1;
        $case->gps_lat                     = $gps[0];
        $case->gps_lng                     = $gps[1];
        $case->addressbook                 = 0;
        $case->reporter                    = $repId;
        $case->source                      = 3;
        $case->active                      = 1;
        $case->house_holder_id             = 1;
        $case->case_type                   = $request['case_type'];
        $case->case_sub_type               = $request['case_sub_type'];
        $case->saps_case_number            = "scscs";
        $case->client_reference_number     = "test";
        $case->street_number               = $request['street_number'];
        $case->route                       = $request['route'];
        $case->locality                    = $request['locality'];
        $case->administrative_area_level_1 = $request['administrative_area_level_1'];
        $case->postal_code                 = $request['postal_code'];
        $case->country                     = $request['country'];
        $case->save();








               return redirect()->back();

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function escalate(Request $request)
    {

        $addresses     = explode(',',$request['addresses']);
        $caseOwners    = CaseOwner::where('case_id','=',$request['caseID'])->get();
        $typeMessage   = ($request['modalType'] == 'Allocate')? 'allocated' : 'referred';
        $typeStatus    = ($request['modalType'] == 'Allocate')? 'Allocated' : 'Referred';

		$dueDate = $request['dueDate'];
		$dueTime = $request['dueTime'];


        foreach ($caseOwners as $caseOwner) {

            $user =  User::find($caseOwner->user);
            $data = array(

                'name'          => $user->name,
                'caseID'        => $request['caseID'],
                'content'       => $request['message'],
                'executor'      => \Auth::user()->name.' '.\Auth::user()->surname,
            );


            \Mail::send('emails.caseEscalation',$data, function($message) use ($user)
            {
                $message->from('info@siyaleader.net', 'Siyaleader');
                $message->to($user->email)->subject("Siyaleader Notification - Case Referred: " );

            });

        }


        foreach ($addresses as $address) {

            $user = User::where('email','=',$address)->first();

            if(sizeof($user) <= 0 )
            {
                 $userAddressbook = addressbook::where('email','=',$address)->first();
            }

            $name        = (sizeof($user) <= 0)? $userAddressbook->first_name:$user->name;
            $surname     = (sizeof($user) <= 0)? $userAddressbook->surname:$user->surname;
            $to          = (sizeof($user) <= 0)? $userAddressbook->id:$user->id;
            $type        = (sizeof($user) <= 0)? 1:0;
            $addressbook = (sizeof($user) <= 0)? 1:0;
            $cellphone   = (sizeof($user) <= 0)? $userAddressbook->surname:$user->cellphone;

            $data = array(
                'name'       => $name,
                'caseID'     => $request['caseID'],
                'content'    => $request['message'],
                'typeStatus' => $request['typeStatus']
            );


            $caseActivity              = New CaseActivity();
            $caseActivity->case_id     = $request['caseID'];
            $caseActivity->user        = $to;
            $caseActivity->addressbook = $addressbook;
            $caseActivity->note        = "Case ".$typeMessage." to ".$name ." ".$surname." by ".\Auth::user()->name.' '.\Auth::user()->surname;
            $caseActivity->save();

            $caseEscalationObj          = New CaseEscalator();
            $caseEscalationObj->case_id = $request['caseID'];
            $caseEscalationObj->from    = \Auth::user()->id;
            $caseEscalationObj->to      = $to;
            $caseEscalationObj->type    = $type;
            $caseEscalationObj->message = $request['message'];
			$caseEscalationObj->due_date = $dueDate." ".$dueTime;
			$caseEscalationObj->title    = "Case ID: " . $request['caseID'];
			$caseEscalationObj->start    = date("Y-m-d");
			$caseEscalationObj->end      = $dueDate;
			$caseEscalationObj->color    = "#4caf50";
            $caseEscalationObj->save();

            $caseOwnerObj              = New CaseOwner();
            $caseOwnerObj->case_id     = $request['caseID'];
            $caseOwnerObj->user        = $to;
            $caseOwnerObj->type        = 4 ;
            $caseOwnerObj->addressbook = $addressbook;
            $caseOwnerObj->save();

            if ($typeStatus == 'Allocated') {

                $objCase                   = CaseReport::find($request['caseID']);
                $objCaseStatus             = CaseStatus::where('name','=',$typeStatus)->first();
                $objCase->allocated_at     = \Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString();
                $objCase->status           = $objCaseStatus->id;
                $objCase->save();

            } else {

                $objCase                   = CaseReport::find($request['caseID']);
                $objCaseStatus             = CaseStatus::where('name','=',$typeStatus)->first();
                $objCase->referred_at      = \Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString();
                $objCase->status           = $objCaseStatus->id;
                $objCase->save();


            }


            \Mail::send('emails.caseEscalated',$data, function($message) use ($address,$typeStatus)
            {
                $message->from('info@siyaleader.net', 'Siyaleader');
                $message->to($address)->subject("Siyaleader Notification - Case $typeStatus: " );

            });

            \Mail::send('emails.caseEscalatedSMS',$data, function($message) use ($cellphone) {
                $message->from('info@siyaleader.net', 'Siyaleader');
                $message->to('cooluma@siyaleader.net')->subject("REFER: $cellphone" );

            });




        }

        return response()->json(['status' => 'ok', 'typeStatus' => $typeStatus]);
        //return "ok";

    }


    public function addCasePoi(Request $request)
    {

        $contacts     = explode(',',$request['pois']);
        foreach ($contacts as $contact) {

            $poi = Poi::where('email','=',$contact)->first();


            $casepoi              = New CasePoi();
            $casepoi->case_id     = $request['caseID'];
            $casepoi->poi_id      = $poi->id;
            $casepoi->save();

        }

        return response()->json(['status' => 'ok']);

    }

     public function addAssociatePoi(Request $request)
    {


        $checking_one = PoiAssociate::where("poi_id",$request['poiID'])->where("associate_id",$request['poi_associate'])->first();
        $checking_two = PoiAssociate::where("poi_id",$request['poi_associate'])->where("associate_id",$request['poiID'])->first();


        if(sizeof($checking_one) == 0 && sizeof($checking_two) == 0) {


            if($request['poi_associate'] != "" ) {

                    if($request['poi_associate'] != $request['poiID'] ) {

                        $assocatepoi                       = New PoiAssociate();
                        $assocatepoi->associate_id         = $request['poi_associate'];
                        $assocatepoi->poi_id               = $request['poiID'];
                        $assocatepoi->association_type     = $request['poi_association_type'];
                        $assocatepoi->created_by           = \Auth::user()->id;
                        $assocatepoi->save();

                        return response()->json(['status' => 'ok']);

                    }

            }



        }








    }


    public function addCaseAssociatePoi(Request $request)
    {


        $checking_one = CasePoi::where("poi_id",$request['poi_associate'])->where("case_id",$request['caseID'])->first();

        if(sizeof($checking_one) == 0) {

            if($request['poi_associate'] != "" ) {

                    if($request['poi_associate'] != $request['poiID'] ) {

                        $assocatepoi                   = New CasePoi();
                        $assocatepoi->case_id          = $request['caseID'];
                        $assocatepoi->poi_id           = $request['poi_associate'];
                        $assocatepoi->created_by       = \Auth::user()->id;
                        $assocatepoi->save();

                        return response()->json(['status' => 'ok']);

                    }

            }

        }


    }

    public function addCaseAssociatePoiCase(Request $request)
    {


        $checking_one = CasePoi::where("case_id",$request['add_case_search'])->where("poi_id",$request['poiID'])->first();

        if(sizeof($checking_one) == 0) {

            if($request['add_case_search'] != "" ) {



                        $assocatepoi                   = New CasePoi();
                        $assocatepoi->case_id          = $request['add_case_search'];
                        $assocatepoi->poi_id           = $request['poiID'];
                        $assocatepoi->created_by       = \Auth::user()->id;
                        $assocatepoi->save();

                        return response()->json(['status' => 'ok']);



            }

        }


    }

    public function list_case_poi($id)
    {



        $casePois = \DB::table('cases_poi')->where('case_id','=',$id)
                        ->join('poi','poi.id','=','cases_poi.poi_id')
                        ->select(array('poi.id','poi.name','poi.surname'));

        return \Datatables::of($casePois)->addColumn('actions','<a target="_blank" class="btn btn-xs btn-alt" href="edit-poi-user/{{$id}}" >View / Edit</a>
                                                   <a target="_blank" class="btn btn-xs btn-alt" href="view-poi-associates/{{$id}}" >View / Add Associates</a>

                                        '
                                )->make(true);
    }

					 public function ak_img_resize($target, $newcopy, $w, $h, $ext)
           { list($w_orig, $h_orig) = getimagesize($target); $scale_ratio = $w_orig / $h_orig; if (($w / $h) > $scale_ratio) { $w = $h * $scale_ratio; } else { $h = $w / $scale_ratio; } $img = ""; $ext = strtolower($ext); if ($ext == "gif"){ $img = imagecreatefromgif($target); } else if($ext =="png"){ $img = imagecreatefrompng($target); } else { $img = imagecreatefromjpeg($target); } $tci = imagecreatetruecolor($w, $h); // imagecopyresampled(dst_img, src_img, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h)
           imagecopyresampled($tci, $img, 0, 0, 0, 0, $w, $h, $w_orig, $h_orig); imagejpeg($tci, $newcopy, 80); }


	 public function mobilerallocate(Request $request){

		 $api_key           = \Input::get('api_key');
		 $fileNote         = \Input::get('fileNote');
		  $file            = \Input::get('file');
		  $case_id         = \Input::get('caseID');
		  $name            = \Input::get('name');

		  $email           = \Input::get('email');
		  $cellphone       = \Input::get('cellphone');
		  $duedate         = \Input::get('duedate');
		  $duetime         = \Input::get('duetime');
		  $etimatdate      = \Input::get('etimatdate');
		  $etimatime       = \Input::get('etimatime');
		  $depart          = \Input::get('depart');
		  $cat             = \Input::get('cat');

		  $subcat          = \Input::get('subcat');
		  $message         = \Input::get('message');
		  $description     = \Input::get('description');
		  $to              = $request['responders'];



		$Fromuser  = UserNew::where('api_key','=',$api_key )->first();

        $responders     = $request['responders'];
        $department     = $request['depart'];


        $category       = $request['cat'];
        $subCategory    = $request['subcat'];


        $subSubCategory = $request['sub_sub_category'];



        $dep_internal = Department::where('name','=',$department)->first();
		$cat_internal = Category::where('name','=',$category)->first();
	    $sub_cat_internal = SubCategory::where('name','=',$subCategory)->first();





            $caseOwner          = new CaseOwner();
            $caseOwner->case_id = $case_id;
            $caseOwner->user    = $responders;
            $caseOwner->type    = 1;
            $caseOwner->save();

            $user  = User::find($responders);

            $caseActivity              = New CaseActivity();
            $caseActivity->case_id     =  $case_id;
            $caseActivity->user        = $user->id;
            $caseActivity->addressbook = 0;
            $caseActivity->note        = "Case Referred to ".$user->name ." ".$user->surname." by ".$Fromuser->name.' '.$Fromuser->surname;



				$caseActivity->case_id = $case_id;
				$caseActivity->from    = $Fromuser->id ;
				$caseActivity->to      = $to;
				//$caseEscalationObj->type    = $type;
				$caseActivity->message ="Case Referred to ".$user->name ." ".$user->surname." by ".$Fromuser->name.' '.$Fromuser->surname;

				$caseActivity->color    = "#4caf50";




			    $caseActivity->created_at              = \Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString();

                $caseActivity->reporter                 = $Fromuser->id;

                $caseActivity->description               = $description ;
				$caseActivity->department		        = $dep_internal->id ;
				$caseActivity->category				    = $cat_internal->id ;
				$caseActivity->sub_category		        = $sub_cat_internal->id;
		        $caseActivity->case_type                = $sub_cat_internal->id;



                $caseActivity->investigation_officer    =  $name ;
                $caseActivity->investigation_cell    =  $cellphone ;
                $caseActivity->investigation_email   =  $email;
                $caseActivity->investigation_note    =  $fileNote ;

                $caseActivity->status          = 4;
                $caseActivity->addressbook     = 0;
                $caseActivity->source          = 2; //Mobile
                $caseActivity->active          = 1;


			    $caseActivity->save();


            $email     = $user->email;
            $cellphone = $user->cellphone;
            $case  = CaseReport::find($case_id);

            $data = array(
                'name'    => $user->name,
                'caseID'  =>  $case_id,
                'content' => $case->description,
            );

            \Mail::send('emails.caseEscalated',$data, function($message) use ($email) {
                $message->from('info@siyaleader.net', 'Siyaleader');
                $message->to($email)->subject("Siyaleader Notification - Case Referred: " );

            });

            \Mail::send('emails.caseEscalatedSMS',$data, function($message) use ($cellphone) {
                $message->from('info@siyaleader.net', 'Siyaleader');
                $message->to('cooluma@siyaleader.net')->subject("REFER: $cellphone" );

            });




        $objDept      = Department::where('slug','=',$department)->first();
        $objCat       = Category::where('slug','=',$category)->first();
        $objSubCat    = SubCategory::where('slug','=',$subCategory)->first();


         if (strlen($subSubCategory) > 1) {
            $objSubSubCat   = SubSubCategory::where('slug','=',$subSubCategory)->first();
            $objSubSubCatId = $objSubSubCat->id;
         }
         else {
            $objSubSubCatId = 0;
         }

        $objCase                   = CaseReport::find($request['caseID']);
        $objCaseStatus             = CaseStatus::where('name','=','Referred')->first();
        $objCase->status           =4;
        //$objCase->department       = $objDept->id;
       // $objCase->category         = $objCat->id;
      // $objCase->sub_category     = $objSubCat->id;
      //  $objCase->sub_sub_category = $objSubSubCatId;
        $objCase->referred_at      = \Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString();
       // $objCase->updated_by       =$Fromuser->id;
        $objCase->save();

                       $response  =  array();
                   //   $response["error"]   = FALSE;
                      $response["massage"] ="case Caase successfully  Refere to " ;


	/*	 if (\Input::file('file')->isValid()) {
      $destinationPath = 'uploads'; // upload path
      $extension = Input::file('file')->getClientOriginalExtension(); // getting image extension
      $fileName = rand(11111,99999).'.'.$extension; // renameing image
      Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
      // sending back with message
      dd("B");
    }

	else {

		dd("f");
	}
		**/

					  // methode   to  save   file  of  case
	     $files            = $file ;
         $name             = "mmm";
         $temp             = explode(".",$file);
         $name             = $name . '.' .end($temp);


        if (file_exists("uploads/" . $name)) {
        //  echo $_FILES["file"]["name"] . " already exists. ";
        } else {
          move_uploaded_file($file,
          "uploads/" . $name);
       //   echo "Stored in: " . "uploads/" . $name;
          $img_url = "uploads/" . $name;
        }
	//	dd("h");


		 $destinationFolder = 'files/case_'.$request['caseID'];

        if(!\File::exists($destinationFolder)) {
             $createDir         = \File::makeDirectory($destinationFolder,0777,true);
        }







 		// $fileName          =    \Input::get('file')->getClientOriginalName() . '.' . $request->get('file')->getClientOriginalExtension();

     //   $fileName          = $request->file('caseFile')->getClientOriginalName();



      //  $fileFullPath      = $destinationFolder.'/'.$fileName;


/**
        if(!\File::exists($fileFullPath)) {

      //      $file->move($destinationFolder,$fileName);
            $caseOwners = CaseOwner::where('case_id','=',$request['caseID'])->get();
            $author     = User::find($Fromuser->id);

            $caseFile           = new CaseFile();
            $caseFile->file     = $fileName;
            $caseFile->img_url  = $fileFullPath;
            $caseFile->user     = $Fromuser->id;
            $caseFile->case_id  = $request['caseID'];
            $caseFile->file_note = $request['fileNote'];
            $caseFile->save();

            $caseActivity              = New CaseActivity();
            $caseActivity->case_id      = $request['caseID'];
            $caseActivity->user        = $Fromuser->id ;
            $caseActivity->addressbook = 0;
            $caseActivity->note        = "New Case File Added by ".$author->name ." ".$author->surname;
            $caseActivity->save();

            foreach ($caseOwners as $caseOwner) {

                $user = User::find($caseOwner->user);

                $data = array(
                                'name'          => $user->name,
                                'caseID'        => $request['caseID'],
                                'caseNote'      => $fileName,
                                'caseFileDesc'  =>  $request['fileNote'],
                                'author'   => $author->name .' '.$author->surname
                            );

                \Mail::send('casefiles.email',$data, function($message) use ($user)
                {
                    $message->from('info@siyaleader.net', 'Siyaleader');
                    $message->to($user->email)->subject("Siyaleader Notification - New Case File Uploaded: ");

                });

            }

				 return \Response::json($response,201);
		} **/
		  $response["massage"] =" Case successfully  Refere" ;
		 return \Response::json($response,201);
    }

    /**
     * Mobile  case   allocation.
     *
     * @param  int  $id
     * @return Response
     */
    public function allocate(Request $request){

        $responders     = $request['responders'];
        $department     = $request['department'];
        $category       = $request['category'];
        $subCategory    = $request['sub_category'];
        $subSubCategory = $request['sub_sub_category'];

        foreach ($responders as $responder) {

            $caseOwner          = new CaseOwner();
            $caseOwner->case_id = $request['caseID'];
            $caseOwner->user    = $responder;
            $caseOwner->type    = 1;
            $caseOwner->save();

            $user  = User::find($responder);

            $caseActivity              = New CaseActivity();
            $caseActivity->case_id     = $request['caseID'];
            $caseActivity->user        = $user->id;
            $caseActivity->addressbook = 0;
            $caseActivity->note        = "Case Referred to ".$user->name ." ".$user->surname." by ".\Auth::user()->name.' '.\Auth::user()->surname;
            $caseActivity->save();


            $email     = $user->email;
            $cellphone = $user->cellphone;
            $case  = CaseReport::find($request['caseID']);

            $data = array(
                'name'    => $user->name,
                'caseID'  => $request['caseID'],
                'content' => $case->description
            );

            \Mail::send('emails.caseEscalated',$data, function($message) use ($email) {
                $message->from('info@siyaleader.net', 'Siyaleader');
                $message->to($email)->subject("Siyaleader Notification - Case Referred: " );

            });

            \Mail::send('emails.caseEscalatedSMS',$data, function($message) use ($cellphone) {
                $message->from('info@siyaleader.net', 'Siyaleader');
                $message->to('cooluma@siyaleader.net')->subject("REFER: $cellphone" );

            });


        }

        $objDept      = Department::where('slug','=',$department)->first();
        $objCat       = Category::where('slug','=',$category)->first();
        $objSubCat    = SubCategory::where('slug','=',$subCategory)->first();


         if (strlen($subSubCategory) > 1) {
            $objSubSubCat   = SubSubCategory::where('slug','=',$subSubCategory)->first();
            $objSubSubCatId = $objSubSubCat->id;
         }
         else {
            $objSubSubCatId = 0;
         }

        $objCase                   = CaseReport::find($request['caseID']);
        $objCaseStatus             = CaseStatus::where('name','=','Referred')->first();
        $objCase->status           = $objCaseStatus->id;
        $objCase->department       = $objDept->id;
        $objCase->category         = $objCat->id;
        $objCase->sub_category     = $objSubCat->id;
        $objCase->sub_sub_category = $objSubSubCatId;
        $objCase->referred_at      = \Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString();
        $objCase->updated_by       = \Auth::user()->id;
        $objCase->save();


        return 'ok';

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function closeCase($id)
    {

      $case = CaseReport::find($id);
      $case->status      = 3;
      $case->resolved_at = \Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString();
      $case->save();

	/*  $caseEscalate          = CaseEscalator::where('case_id','=',$id)->first();
	  $caseEscalate->color   = '#3385ff';
	  $caseEscalate->save();*/

      $caseActivity              = New CaseActivity();
      $caseActivity->case_id      = $id;
      $caseActivity->user        = \Auth::user()->id;
      $caseActivity->addressbook = 0;
      $caseActivity->note        = \Auth::user()->name.' '.\Auth::user()->surname ." closed case";
      $caseActivity->save();

      $data = array (
                            'name'      => \Auth::user()->name,
                            'caseID'    => $id,
                            'content'   => $case->description,
                            'executor'  => \Auth::user()->name.' '.\Auth::user()->surname,
                    );

      $user   = User::find($case->reporter);

       if(sizeof($user) <= 0 ) {

           $userAddressbook = addressbook::where('id','=',$case->reporter)->first();
       }

       $email  = (sizeof($user) <= 0)? $userAddressbook->email : $user->email;

      \Mail::send('emails.caseClosed',$data, function($message) use ($email) {

            $message->from('info@siyaleader.net', 'Siyaleader');
            $message->to($email)->subject("Siyaleader Notification - Case Closed: " );

        });

       return "ok";

    }


    public function requestCaseClosure(Request $request)
    {
        $case_status = CaseStatus::where('name','Pending Closure')->first();
        $case = CaseReport::find($request['caseID']);
        $case->status = $case_status->id;
        $case->save();

        $caseActivity              = New CaseActivity();
        $caseActivity->case_id      = $request['caseID'];
        $caseActivity->user        = \Auth::user()->id;
        $caseActivity->addressbook = 0;
        $caseActivity->note        = \Auth::user()->name.' '.\Auth::user()->surname ." requested case closure";
        $caseActivity->save();

        $caseAdministrators    = User::where('role','=',1)
                                    ->orWhere('role','=',3)
                                    ->get();


        foreach ($caseAdministrators as $caseAdmin) {


             $data = array(
                            'name'      => $caseAdmin->name,
                            'caseID'    => $case->id,
                            'content'   => $case->description,
                            'note'      => $request['caseNote'],
                            'requestor' => \Auth::user()->name.' '.\Auth::user()->surname,
                            );


            \Mail::send('emails.requestCaseClosure',$data, function($message) use ($caseAdmin) {

                $message->from('info@siyaleader.net', 'Siyaleader');
                $message->to($caseAdmin->email)->subject("Siyaleader Notification - Request for Case Closure: " );

            });

        }


        return "Case Closed";
    }


    public function edit($id)
    {

        $destinationFolder = 'files/case_'.$id;
        if(!\File::exists($destinationFolder)) {

            \File::makeDirectory($destinationFolder,0777,true);
        }

        $case = CaseReport::with('department')->with('status')->where('id',$id)->first();

        if($case->case_type > 0) {
            $case_type       = CaseType::find($case->case_type);
            $case->case_type = $case_type->name;
            $case_types      = ['speed','overstay','out_of_boundary'];

            if(in_array($case_type->name,$case_types)){

                if($case->gatetrack_id > 0) {

                    $driverVehicle          = DriverVehicle::find($case->gatetrack_id);
                    $driver                 = Driver::find($driverVehicle->driver_id);
                    $driverCompany          = DriverCompany::find($driverVehicle->company_id);
                    $case->vehicleReg       = $driverVehicle->VehicleRegNo;
                    $case->vehicleModel     = $driverVehicle->Model;
                    $case->vehicleColor     = $driverVehicle->Color;
                    $case->vehiclePurpose   = $driverVehicle->purpose;
                    $case->vehicleTimeIn    = $driverVehicle->timeIn;
                    $case->vehicleDriver    = $driver->FirstName.''.$driver->LastName;
                    $case->vehicleCompany   = $driverCompany->CompanyName;

                }
            }

            if($case->case_sub_type > 0) {

                $case_sub_type           = CaseSubType::find($case->case_sub_type);
                $case->case_sub_type     = $case_sub_type->name;

            }
        }

        if($case->addressbook > 0){

            $user_reporter_address_book  = addressbook::find($case->reporter);
            $user_household_address_book = addressbook::find($case->house_holder_id);
            $reporter                    = $user_reporter_address_book->first_name ." ".$user_reporter_address_book->surname;
            $reporterCell                = $user_reporter_address_book->cellphone;
            $household                   = $user_household_address_book->first_name ." ".$user_household_address_book->surname;
            $householdCell               = $user_household_address_book->cellphone;
        } else {

            $householdCell = "";
            $household     = "";

            $user_reporter          = User::find($case->reporter);
            $reporter               = $user_reporter->name ." ".$user_reporter->surname;
            $reporterCell           = $user_reporter->cellphone;
            if(!is_null($case->house_holder_id)){
                $user_household    = User::find($case->house_holder_id);
                $household         = $user_household->name ." ".$user_household->surname;
                $householdCell     = $user_household->cellphone;
            }

        }
        $case->reporter        = $reporter;
        $case->reporterCell    = $reporterCell;
        $case->householdCell   = $householdCell;
        $case->household       = $household;

        $case_last_activity   = $this->case_activities->get_last_activity_by_case($case->id);
        if(!is_null($case_last_activity)){

            $case->last_at        = $case_last_activity->created_at;
        }

        return $case;
    }


    public function captureCaseUpdate(CaseRequest $request)
    {

        $userRole           = UserRole::where('name','=','House Holder')->first();
        $user               = New User();
        $user->role         = $userRole->id;
        $user->name         = $request['name'];
        $user->surname      = $request['surname'];
        $user->cellphone    = $request['cellphone'];
        $user->id_number    = $request['id_number'];
        $user->position     = $request['position'];
        $title              = Title::where('slug','=',$request['title'])->first();
        $user->title        = $title->id;
        $user->gender       = $request['gender'];
        $user->dob          = $request['dob'];
        $user->house_number = $request['house_number'];
        $user->email        = $request['cellphone']."@siyaleader.net";
        $user->created_by   = \Auth::user()->id;
        $language           = Language::where('slug','=',$request['language'])->first();
        $user->language     = $language->id;
        $province           = Province::where('slug','=',$request['province'])->first();
        $user->province     = $province->id;
        $district           = District::where('slug','=',$request['district'])->first();
        $user->district     = $district->id;
        $municipality       = Municipality::where('slug','=',$request['municipality'])->first();
        $user->municipality = $municipality->id;
        $ward               = Ward::where('slug','=',$request['ward'])->first();
        $user->ward         = $ward->id;
        $user->save();
        $casePriority          = CasePriority::where('slug','=',$request['priority'])->first();
        $case                  = CaseReport::find($request['caseID']);
        $case->description     = $request['description'];
        $case->priority        = $casePriority->id;
        $case->province        = $user->province;
        $case->district        = $user->district;
        $case->municipality    = $user->municipality;
        $case->ward            = $user->ward;
        $case->area            = $user->area;
        $case->house_holder_id = $user->id;
        $case->updated_by      = \Auth::user()->id;
        $case->updated_at      = \Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString();
        $case->save();


        return 'ok';

    }

    public function captureCaseUpdateH(CaseRequestH $request) {

        $casePriority          = CasePriority::where('slug','=',$request['priority'])->first();
        $houseHolderObj        = User::find($request['hseHolderId']);
        $case                  = CaseReport::find($request['caseID']);
        $case->province        = $houseHolderObj->province;
        $case->district        = $houseHolderObj->district;
        $case->municipality    = $houseHolderObj->municipality;
        $case->ward            = $houseHolderObj->ward;
        $case->area            = $houseHolderObj->area;
        $case->description     = $request['description'];
        $case->priority        = $casePriority->id;
        $case->updated_by      = \Auth::user()->id;
        $case->house_holder_id = $request['hseHolderId'];
        $case->updated_at      = \Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString();
        $case->save();

        return 'ok';

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function create(CreateCaseRequest $request)
    {

            $case = CaseReport::find($request['caseID']);
            $newCase                  = New CaseReport();
            $newCase->created_at      = $case->created_at;
            $newCase->user            = $case->user;
            $newCase->priority        = $case->priority;
            $newCase->status          = 1;
            $newCase->description     = $request['description'];
            $newCase->province        = $case->province;
            $newCase->district        = $case->district;
            $newCase->municipality    = $case->municipality;
            $newCase->ward            = $case->ward;
            $newCase->area            = $case->area;
            $newCase->addressbook     = $case->addressbook;
            $newCase->source          = 3;
            $newCase->active          = 1;
            $newCase->house_holder_id = $case->house_holder_id;
            $newCase->agent           = $case->agent;
            $newCase->save();

            $relatedCase              = New CaseRelated();
            $relatedCase->parent      = $request['caseID'];
            $relatedCase->child       = $newCase->id;
            $relatedCase->created_by  = \Auth::user()->id;
            $relatedCase->created_at  = \Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString();
            $relatedCase->save();


            $response["message"]      = "Case created successfully";
            $response["error"]        = FALSE;
            $response["caseID"]       = $request['caseID'];


            return \Response::json($response,201);


    }

    function workflow($id) {



      $case = CaseReport::find($id);
      $workflows = \DB::table('workflows')
                ->where('sub_category_id','=',$case->sub_category)
                ->select(
                            \DB::raw("
                                        workflows.id,
                                        workflows.name,
                                        workflows.sub_category_id,
                                        workflows.order,
                                        workflows.created_by,
                                        workflows.updated_by,
                                        workflows.active
                                    "
                                        )
                        )
                ->groupBy('workflows.id');

        return \Datatables::of($workflows)
                            ->make(true);


    }



	 public  function  mobilesynch (Request  $request) {

		  $headers          = apache_request_headers();
		  $data = $request->all();


		 foreach($data as $key=>$val) {

		  $api_key         = $val['description'];
		  $name            = $val['names'];
		  $email           = $val['emails'];
		  $cellphone       = $val['number'];
		  $duedate         = $val['duedate'];
		  $duetime         = $val['duetime'];
		  $etimatdate      = $val['description'];
		  $etimatime       = $val['description'];
		  $depart          = $val['depart'];
		  $cat             = $val['category'];
		  $to              = $val['to'];
		  $subcat          = $val['sub_category'];
		  $message         = $val['message'];
		  $description     = $val['description'];

		   $idi = UserNew::select('id')->where('api_key','=',$headers['api_key'])->first();

		  // $idi =UserNew::select('id')->where('api_key','=',$api_key)->first();

		 // $idi   = UserNew::select('id')->where('api_key','=',$api_key)->first();
          $idi->id  ;

		$dueDate					 =  $duedate;

		$department_internal		 = $depart;
		$category_internal			 = $cat;
		$sub_category				 =   $subcat;


	//	$sub_sub_category     		 = $request['sub_sub_category'];
		$estimatedDate   			 =  $etimatdate;
		$estimateTime 					= $etimatime  ;

		$dep_internal = Department::where('name','=',$department_internal)->first();
		$cat_internal = Category::where('name','=',$category_internal)->first();
	    $sub_cat_internal = SubCategory::where('name','=',$sub_category)->first();

	    $dep_id;
		$cat_id;
		$sub_cat_id;

		if($dep_internal == null){
			$dep_id = 0;
		}else{
			$dep_id = $dep_internal->id;
		}

		if($cat_internal == null){
			$cat_id = 0;
		}else{
			$cat_id = $cat_internal->id;
		}

		if($sub_cat_internal == null){
			$sub_cat_id = 0;
		}else{
			$sub_cat_id = $sub_cat_internal->id;
		}
		// $sub_cat = \DB::table('sub_categories')->where('name','=',$sub_category)->first();

		//$sub_sub_cat = Department::where('name','=',$sub_sub_category)->first();

                $newCase                        = New CaseReport();
                $newCase->created_at            = \Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString();
                $newCase->user                  = $idi->id;
                $newCase->reporter              = $idi->id;

                $newCase->description           = $description ;
				$newCase->department			=  $dep_id;
				$newCase->category				= $cat_id;
				$newCase->sub_category		    = $sub_cat_id;
		        $newCase->case_type             = $sub_cat_id;

                $newCase->due_date              =  $duedate ;

                $newCase->investigation_officer =  $name ;
                $newCase->investigation_cell    =  $cellphone ;
                $newCase->investigation_email   =  $email;
                $newCase->investigation_note    =  $message ;

                $newCase->status          = 4;
                $newCase->addressbook     = 0;
                $newCase->source          = 2; //Mobile
                $newCase->active          = 1;

                $newCase->save();



					/*-------------------------------------------------------------*/
				$caseEscalationObj          = New CaseEscalator();
				$caseEscalationObj->case_id =$newCase->id;
				$caseEscalationObj->from    = $idi->id;
				$caseEscalationObj->to      = $to;
				//$caseEscalationObj->type    = $type;
				$caseEscalationObj->message =$message;
				$caseEscalationObj->due_date = $dueDate ;
				$caseEscalationObj->title    = "Case ID: " .$newCase->id;
				$caseEscalationObj->start    = date("Y-m-d");
				$caseEscalationObj->end      = $dueDate;
				$caseEscalationObj->color    = "#4caf50";
				$caseEscalationObj->save();
				/*-------------------------------------------------------------*/




	   $Messagenotifications  = new  Messagenotifications() ;
	   $Messagenotifications->from             =$idi->id;
	   $Messagenotifications->to               =  $to ;
	   $Messagenotifications->message          = $message ;
	   $Messagenotifications->case_id          =  $newCase->id;
	   $Messagenotifications->title          =  $newCase->id;
	   $Messagenotifications->case_escalator_id=$newCase->id;
	   $Messagenotifications-> save() ;

			//	$caseId			= CaseReport::where('description','=',$request['description'])->first();


		dd( $newCase ) ;




		 }
	 }

	  public  function   createTruckCase (){



		//3bb4d088-c479-4448-8e51-bc37ecc11c46
		 $api_key         = \Input::get('api_key');
		if($api_key == "3bb4d088-c479-4448-8e51-bc37ecc11c46"){

		  $name            = \Input::get('name');
		  $email           = \Input::get('email');
		  $cellphone       = \Input::get('cellphone');
		  $duedate         = \Input::get('duedate');
		  $duetime         = \Input::get('duetime');
		  $etimatdate      = \Input::get('etimatdate');
		  $etimatime       = \Input::get('etimatime');
		  $depart          = \Input::get('depart');
		  $cat             = \Input::get('cat');
		  $to             = \Input::get('to');
		  $subcat          = \Input::get('subcat');
		  $message         = \Input::get('message');
		  $description     = \Input::get('description');



		  $idi   = UserNew::select('id')->where('api_key','=',$api_key)->first();
          $idi->id  ;

		$dueDate					 =  $duedate;

		$department_internal		 = $depart;
		$category_internal			 = $cat;
		$sub_category				 =   $subcat;


	//	$sub_sub_category     		 = $request['sub_sub_category'];
		$estimatedDate   			 =  $etimatdate;
		$estimateTime 					= $etimatime  ;

		$dep_internal = Department::where('name','=',$department_internal)->first();
		$cat_internal = Category::where('name','=',$category_internal)->first();
	    $sub_cat_internal = SubCategory::where('name','=',$sub_category)->first();

	    $dep_id;
		$cat_id;
		$sub_cat_id;

		if($dep_internal == null){
			$dep_id = 0;
		}else{
			$dep_id = $dep_internal->id;
		}

		if($cat_internal == null){
			$cat_id = 0;
		}else{
			$cat_id = $cat_internal->id;
		}

		if($sub_cat_internal == null){
			$sub_cat_id = 0;
		}else{
			$sub_cat_id = $sub_cat_internal->id;
		}
		// $sub_cat = \DB::table('sub_categories')->where('name','=',$sub_category)->first();

		//$sub_sub_cat = Department::where('name','=',$sub_sub_category)->first();

                $newCase                        = New CaseReport();
                $newCase->created_at            = \Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString();
                $newCase->user                  = $idi->id;
                $newCase->reporter              = $idi->id;

                $newCase->description           = $description ;
				$newCase->department			=  $dep_id;
				$newCase->category				= $cat_id;
				$newCase->sub_category		    = $sub_cat_id;
		        $newCase->case_type             = $sub_cat_id;

                $newCase->due_date              =  $duedate ;

                $newCase->investigation_officer =  $name ;
                $newCase->investigation_cell    =  $cellphone ;
                $newCase->investigation_email   =  $email;
                $newCase->investigation_note    =  $message ;

                $newCase->status          = 4;
                $newCase->addressbook     = 0;
                $newCase->source          = 2; //Mobile
                $newCase->active          = 1;

                $newCase->save();



					/*-------------------------------------------------------------*/
				$caseEscalationObj          = New CaseEscalator();
				$caseEscalationObj->case_id =$newCase->id;
				$caseEscalationObj->from    = $idi->id;
				$caseEscalationObj->to      = $to;
				//$caseEscalationObj->type    = $type;
				$caseEscalationObj->message =$message;
				$caseEscalationObj->due_date = $dueDate ;
				$caseEscalationObj->title    = "Case ID: " .$newCase->id;
				$caseEscalationObj->start    = date("Y-m-d");
				$caseEscalationObj->end      = $dueDate;
				$caseEscalationObj->color    = "#4caf50";
				$caseEscalationObj->save();
				/*-------------------------------------------------------------*/




	   $Messagenotifications  = new  Messagenotifications() ;
	   $Messagenotifications->from             =$idi->id;
	   $Messagenotifications->to               =  $to ;
	   $Messagenotifications->message          = $message ;
	   $Messagenotifications->case_id          =  $newCase->id;
	   $Messagenotifications->title          =  $newCase->id;
	   $Messagenotifications->case_escalator_id=$newCase->id;
	   $Messagenotifications-> save() ;

			//	$caseId			= CaseReport::where('description','=',$request['description'])->first();

		}{
			echo "Invalid Key";
		}
		//dd( $newCase ) ;


	 }

	 ///TRUCKS TURN AROUND ////



	 public  function   mobilecaeCreate (){



		  $api_key         = \Input::get('api_key');
		  $name            = \Input::get('name');
		  $email           = \Input::get('email');
		  $cellphone       = \Input::get('cellphone');
		  $duedate         = \Input::get('duedate');
		  $duetime         = \Input::get('duetime');
		  $etimatdate      = \Input::get('etimatdate');
		  $etimatime       = \Input::get('etimatime');
		  $depart          = \Input::get('depart');
		  $cat             = \Input::get('cat');
		  $to             = \Input::get('to');
		  $subcat          = \Input::get('subcat');
		  $message         = \Input::get('message');
		  $description     = \Input::get('description');



		  $idi   = UserNew::select('id')->where('api_key','=',$api_key)->first();
          $idi->id  ;

		$dueDate					 =  $duedate;

		$department_internal		 = $depart;
		$category_internal			 = $cat;
		$sub_category				 =   $subcat;


	//	$sub_sub_category     		 = $request['sub_sub_category'];
		$estimatedDate   			 =  $etimatdate;
		$estimateTime 					= $etimatime  ;

		$dep_internal = Department::where('name','=',$department_internal)->first();
		$cat_internal = Category::where('name','=',$category_internal)->first();
	    $sub_cat_internal = SubCategory::where('name','=',$sub_category)->first();

	    $dep_id;
		$cat_id;
		$sub_cat_id;

		if($dep_internal == null){
			$dep_id = 0;
		}else{
			$dep_id = $dep_internal->id;
		}

		if($cat_internal == null){
			$cat_id = 0;
		}else{
			$cat_id = $cat_internal->id;
		}

		if($sub_cat_internal == null){
			$sub_cat_id = 0;
		}else{
			$sub_cat_id = $sub_cat_internal->id;
		}
		// $sub_cat = \DB::table('sub_categories')->where('name','=',$sub_category)->first();

		//$sub_sub_cat = Department::where('name','=',$sub_sub_category)->first();

                $newCase                        = New CaseReport();
                $newCase->created_at            = \Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString();
                $newCase->user                  = $idi->id;
                $newCase->reporter              = $idi->id;

                $newCase->description           = $description ;
				$newCase->department			=  $dep_id;
				$newCase->category				= $cat_id;
				$newCase->sub_category		    = $sub_cat_id;
		        $newCase->case_type             = $sub_cat_id;

                $newCase->due_date              =  $duedate ;

                $newCase->investigation_officer =  $name ;
                $newCase->investigation_cell    =  $cellphone ;
                $newCase->investigation_email   =  $email;
                $newCase->investigation_note    =  $message ;

                $newCase->status          = 4;
                $newCase->addressbook     = 0;
                $newCase->source          = 2; //Mobile
                $newCase->active          = 1;

                $newCase->save();



					/*-------------------------------------------------------------*/
				$caseEscalationObj          = New CaseEscalator();
				$caseEscalationObj->case_id =$newCase->id;
				$caseEscalationObj->from    = $idi->id;
				$caseEscalationObj->to      = $to;
				//$caseEscalationObj->type    = $type;
				$caseEscalationObj->message =$message;
				$caseEscalationObj->due_date = $dueDate ;
				$caseEscalationObj->title    = "Case ID: " .$newCase->id;
				$caseEscalationObj->start    = date("Y-m-d");
				$caseEscalationObj->end      = $dueDate;
				$caseEscalationObj->color    = "#4caf50";




			    $caseEscalationObj->created_at              = \Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString();
                $caseEscalationObj->user                    = $idi->id;
                $caseEscalationObj->reporter                = $idi->id;

                $caseEscalationObj->description             = $description ;
				$caseEscalationObj->department		        =  $dep_id;
				$caseEscalationObj->category				= $cat_id;
				$caseEscalationObj->sub_category		    = $sub_cat_id;
		        $caseEscalationObj->case_type               = $sub_cat_id;

                $caseEscalationObj->due_date                 =  $duedate ;

                $caseEscalationObj->investigation_officer    =  $name ;
                $caseEscalationObj->investigation_cell    =  $cellphone ;
                $caseEscalationObj->investigation_email   =  $email;
                $caseEscalationObj->investigation_note    =  $message ;

                $caseEscalationObj->status          = 4;
                $caseEscalationObj->addressbook     = 0;
                $caseEscalationObj->source          = 2; //Mobile
                $caseEscalationObj->active          = 1;

			    $caseEscalationObj->save();
				/*-------------------------------------------------------------*/




	   $Messagenotifications  = new  Messagenotifications() ;
	   $Messagenotifications->from             =$idi->id;
	   $Messagenotifications->to               =  $to ;
	   $Messagenotifications->message          = $message ;
	   $Messagenotifications->case_id          =  $newCase->id;
	   $Messagenotifications->title          =  $newCase->id;
	   $Messagenotifications->case_escalator_id=$newCase->id;
	   $Messagenotifications-> save() ;

		//		$caseId			= CaseReport::where('description','=',$description)->first();


			    $caseOwner              = new CaseOwner();
                $caseOwner->user        = $idi->id;
                $caseOwner->case_id     = $newCase->id;
                $caseOwner->type        = 0;
                $caseOwner->active      = 1;
                $caseOwner->save();


                $destinationFolder = 'files/case_'.$newCase->id;

                if(!\File::exists($destinationFolder)) {
                     $createDir         = \File::makeDirectory($destinationFolder,0777,true);
                }




                $response["message"]      = "Case created successfully";
                $response["error"]        = FALSE;
                $response["caseID"]       = $newCase->id;

                return \Response::json($response,201);


	//	dd( $newCase ) ;


	 }


    function createCaseAgent(CreateCaseAgentRequest $request) {


		$dueDate					 = $request['due_date'];
        $due_time				     = $request['due_time'];
		$department_internal		 = $request['department'];
		$category_internal			 = $request['category'];
		$sub_category_internal		 = $request['sub_category'];
		$sub_sub_category     		 = $request['sub_sub_category'];
		$estimatedDate   			 = $request['estimatedDate'];
		$estimateTime 				 = $request['estimateTime'];

		$dep_internal                = Department::where('name','=',$department_internal)->first();
		$cat_internal 	             = CaseType::where('name','=',$category_internal)->first();
		$sub_cat_internal            = CaseSubType::where('name','=',$sub_category_internal)->first();

		if($dep_internal == null){
			$dep_id = 1;
		}else{
			$dep_id = $dep_internal->id;
		}

		if($cat_internal == null){
			$cat_id = 0;
		}else{
			$cat_id = $cat_internal->id;
		}

		if($sub_cat_internal == null){
			$sub_cat_id = 0;
		}else{
			$sub_cat_id = $sub_cat_internal->id;
		}

        $house_holder_id = 0;


        if (empty($request['house_holder_id'] )) {


                $user               = New User();
                $user->role         = 1;
                $user->name         = $request['name'];
                $user->surname      = $request['surname'];
                $user->cellphone    = $request['cellphone'].rand();
                $user->client_reference_number = $request['client_reference_number'];
                $user->email        = $request['cellphone'].rand()."@siyaleader.net";
                $user->created_by   = \Auth::user()->id;
                $user->company      = $request['company'];
                $user->position     = 1;
                $user->gender       = 1;
                $user->affiliation  = 1;
                $user->save();

                $house_holder_id    = $user->id;

            }

                $house_holder_id                = ($house_holder_id == 0)? $request['house_holder_id'] : $house_holder_id;

                $case_type                      = ($request['case_type'] == 0)? 5 : $request['case_type'];
                $case_sub_type                  = ($request['case_sub_type'] == 0)? 7 : $request['case_sub_type'];
                $house_holder_obj               = User::find($house_holder_id);

                $newCase                        = New CaseReport();
                $newCase->created_at            = \Carbon\Carbon::now('Africa/Johannesburg')->toDateTimeString();
                $newCase->user                  = \Auth::user()->id;
                $newCase->reporter              = \Auth::user()->id;
                $newCase->house_holder_id       = $house_holder_id;
                $newCase->description           = $request['description'];
				$newCase->department			= $dep_id;
				$newCase->case_type				= $cat_id;
                $newCase->priority				= 1;
				$newCase->case_sub_type			= $sub_cat_id;
                $newCase->saps_case_number      = $request['saps_case_number'];
                $newCase->saps_station          = $request['saps_station'];
                $newCase->investigation_officer = $request['investigation_officer'];
                $newCase->investigation_cell    = $request['investigation_cell'];
                $newCase->investigation_email   = $request['investigation_email'];
                $newCase->investigation_note    = $request['investigation_note'];
                $newCase->client_reference_number = $request['client_reference_number'];
                $newCase->status          = 4;
                $newCase->addressbook     = 0;
                $newCase->source          = 3;
                $newCase->active          = 1;
                $newCase->street_number               = $request['street_number'];
                $newCase->route                       = $request['route'];
                $newCase->locality                    = $request['locality'];
                $newCase->administrative_area_level_1 = $request['administrative_area_level_1'];
                $newCase->postal_code                 = $request['postal_code'];
                $newCase->country                     = $request['country'];
                $newCase->gps_lat = $request['gpsAddressLat'];
                $newCase->gps_lng = $request['gpsAddressLong'];
                $newCase->save();




				$caseId			= CaseReport::where('description','=',$request['description'])->first();



            /*-------------------------------------------------------------*/
            $caseEscalationObj          = New CaseEscalator();
            $caseEscalationObj->case_id = $caseId->id;
            $caseEscalationObj->from    = \Auth::user()->id;
            $caseEscalationObj->to      = $house_holder_id;
            //$caseEscalationObj->type    = $type;
            $caseEscalationObj->message = $request['message'];
            $caseEscalationObj->due_date = $dueDate ." " .$due_time;
            $caseEscalationObj->title    = "Case ID: " .$caseId->id;
            $caseEscalationObj->start    = date("Y-m-d");
            $caseEscalationObj->end      = $dueDate;
            $caseEscalationObj->color    = "#4caf50";
            $caseEscalationObj->save();
            /*-------------------------------------------------------------*/




           $Messagenotifications  = new  Messagenotifications() ;
           $Messagenotifications->from             = \Auth::user()->id;
           $Messagenotifications->to               =  $house_holder_id;
           $Messagenotifications->message          = $request['message'];
           $Messagenotifications->case_id          =  $caseId->id;
           $Messagenotifications->title          =  $caseId->id;
           $Messagenotifications->case_escalator_id=\Auth::user()->id;
           $Messagenotifications-> save() ;



                $create_case_owner_data = array(
                    "case_id"      => $newCase->id,
                    "user"         => 1,
                    "type"         => 1,
                    "addressbook"  => 0
                );
                $this->case_owners->create_case_owner($create_case_owner_data);

                $first_responders   = $this->case_responders->get_responders_by_sub_case_type($newCase->case_sub_type,1);

                foreach ($first_responders as $first_responder){

                    $create_case_owner_data = array(
                        "case_id"      => $newCase->id,
                        "user"         => $first_responder->responder,
                        "type"         => 1,
                        "addressbook"  => 0
                    );

                    $this->case_owners->create_case_owner($create_case_owner_data);

                }

                $this->case_responders->send_comms_to_first_responders($newCase,$first_responders);


                $destinationFolder = 'files/case_'.$newCase->id;

                if(!\File::exists($destinationFolder)) {
                     $createDir         = \File::makeDirectory($destinationFolder,0777,true);
                }




                $response["message"]      = "Case created successfully";
                $response["error"]        = FALSE;
                $response["caseID"]       = $newCase->id;

                return \Response::json($response,201);

    }


    function relatedCases($id) {


            $relatedCases  = \DB::table('related_cases')
                                ->join('cases','related_cases.child','=','cases.id')
                                ->where('related_cases.parent','=',$id)
                                ->select(
                                            array(
                                                    'cases.id as id',
                                                    'cases.description as description',
                                                    'related_cases.created_at as created_at'

                                                )
                                        );

            return \Datatables::of($relatedCases)
                            ->addColumn('actions','<a class="btn btn-xs btn-alt" data-toggle="modal" onClick="launchUpdateAffiliationModal({{$id}});" data-target=".modalEditAffiliation">Edit</a>')
                            ->make(true);

    }
}

function selPriorities() {
	die("selPriorities");
	$html = '<select>';
	/*$priorities = \DB::table('cases_priorities');
	foreach ($priorities AS $p) {
		$html .= '<option></option>';
	}*/
	$html .=	'</select>';
	return $html;
}
//$selPriorities = selPriorities();
