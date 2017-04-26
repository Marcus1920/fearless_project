<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Position;
use App\Department;
use App\Province;
use App\District;
use App\Municipality;
use App\Ward;
use App\CaseType;
use App\CaseSubType;
use App\CaseSubSubType;
use App\CaseReport;
use App\User;
use App\Relationship;
use App\addressbook;
use App\Message;
use App\UserRole;
use App\Title;
use App\Language;
use App\CaseStatus;
use App\CasePriority;
use App\UserStatus;
use App\Affiliation;
use App\AffiliationPositions;
use App\Meeting;
use App\MeetingVenue;
use App\Poi;
use App\Permission;
use App\userPermission;
use App\GroupPermission;
use App\Country;
use App\PhoneType;
use App\Port;




class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        require_once app_path() . '/validators.php';

        if (\Schema::hasTable('positions'))
        {
            $positions          = Position::orderBy('name','ASC')->get();
            $selectPositions    = array();
            $selectPositions[0] = "Select / All";

            foreach ($positions as $position) {
               $selectPositions[$position->slug] = $position->name;
            }

             \View::share('selectPositions',$selectPositions);

        }

        if (\Schema::hasTable('phone_types'))
        {
            $phone_types           = PhoneType::orderBy('name','ASC')->get();
            $select_phone_types    = array();
            $select_phone_types[0] = "Select Phone Type";

            foreach ($phone_types as $phone_type) {
               $select_phone_types[$phone_type->id] = $phone_type->name;
            }

             \View::share('selectPhoneTypes',$select_phone_types);

        }

        if (\Schema::hasTable('countries'))
        {
            $countries          = Country::orderBy('name','ASC')->get();
            $selectCountries    = array();
            $selectCountries[0] = "Select Country";

            foreach ($countries as $country) {
               $selectCountries[$country->id] = $country->name;
            }

             \View::share('selectCountries',$selectCountries);

        }


        if (\Schema::hasTable('affiliations'))
        {
            $affiliations          = Affiliation::orderBy('name','ASC')->get();
            $selectAffiliations    = array();
            $selectAffiliations[0] = "Select / All";

            foreach ($affiliations as $affiliation) {

               $selectAffiliations[$affiliation->id] = $affiliation->name;

            }

             \View::share('selectAffiliations',$selectAffiliations);

        }

        if (\Schema::hasTable('users_statuses'))
        {
            $userStatuses          = UserStatus::orderBy('name','ASC')->get();
            $selectUserStatuses    = array();
            $selectUserStatuses[0] = "Select / All";

            foreach ($userStatuses as $userStatus) {
               $selectUserStatuses[$userStatus->id] = $userStatus->name;
            }

             \View::share('selectUserStatuses',$selectUserStatuses);

        }



        if (\Schema::hasTable('cases_priorities'))
        {
            $priorities          = CasePriority::orderBy('name','ASC')->get();
            $selectPriorities    = array();
            $selectPriorities[0] = "Select / All";

            foreach ($priorities as $priority) {

               $selectPriorities[$priority->slug] = $priority->name;
            }

             \View::share('selectPriorities',$selectPriorities);

        }

        if (\Schema::hasTable('cases_types'))
        {
            $caseTypes          = CaseType::orderBy('name','ASC')->get();
            $selectCasesTypes    = array();
            $selectCasesTypes[0] = "Select / All";

            foreach ($caseTypes as $caseType) {

               $selectCasesTypes[$caseType->id] = $caseType->name;
            }

             \View::share('selectCasesTypes',$selectCasesTypes);

        }

        if (\Schema::hasTable('titles'))
        {
            $titles          = Title::orderBy('name','ASC')->get();
            $selectTitles    = array();
            $selectTitles[0] = "Select / All";

            foreach ($titles as $title) {
               $selectTitles[$title->slug] = $title->name;
            }

             \View::share('selectTitles',$selectTitles);

        }

         if (\Schema::hasTable('languages'))
        {
            $languages          = Language::orderBy('name','ASC')->get();
            $selectLanguages    = array();
            $selectLanguages[0] = "Select / All";

            foreach ($languages as $language) {
               $selectLanguages[$language->slug] = $language->name;
            }

             \View::share('selectLanguages',$selectLanguages);

        }



         if (\Schema::hasTable('departments'))
        {
            $departments          = Department::orderBy('name','ASC')->get();
            $selectDepartments    = array();
            $selectDepartments[0] = "Select / All";

            foreach ($departments as $department) {
               $selectDepartments[$department->slug] = $department->name;
            }

             \View::share('selectDepartments',$selectDepartments);

        }

        if (\Schema::hasTable('users_roles'))
        {
            $roles          = UserRole::orderBy('name','ASC')->get();
            $selectRoles    = array();
            $selectRoles[0] = "Select / All";

            foreach ($roles as $role) {
               $selectRoles[$role->slug] = $role->name;
            }

             \View::share('selectRoles',$selectRoles);

        }


        if (\Schema::hasTable('provinces'))
        {
            $provinces          = Province::orderBy('name','ASC')->get();
            $selectProvinces    = array();
            $selectProvinces[0] = "Select / All";

            foreach ($provinces as $Province) {
               $selectProvinces[$Province->slug] = $Province->name;
            }

             \View::share('selectProvinces',$selectProvinces);

        }

        if (\Schema::hasTable('districts'))
        {
            $districts          = District::orderBy('name','ASC')->get();
            $selectDistrict     = array();
            $selectDistricts[0] = "Select / All";

            foreach ($districts as $district) {
               $selectDistricts[$district->slug] = $district->name;
            }

             \View::share('selectDistricts',$selectDistricts);

        }

        if (\Schema::hasTable('municipalities'))
        {
            $municipalities          = Municipality::orderBy('name','ASC')->get();
            $selectMunicipalities    = array();
            $selectMunicipalities[0] = "Select / All";
            foreach ($municipalities as $municipality) {
               $selectMunicipalities[$municipality->slug] = $municipality->name;
            }

             \View::share('selectMunicipalities',$selectMunicipalities);

        }

        if (\Schema::hasTable('wards'))
        {
            $wards          = Ward::orderBy('name','ASC')->get();
            $selectWards    = array();
            $selectWards[0] = "Select / All";
            foreach ($wards as $ward) {
               $selectWards[$ward->slug] = $ward->name;
            }

             \View::share('selectWards',$selectWards);

        }

        if (\Schema::hasTable('cases_types'))
        {
            $categories          = CaseType::orderBy('name','ASC')->get();
            $selectCategories    = array();
            $selectCategories[0] = "Select / All";
            foreach ($categories as $category) {
               $selectCategories[$category->slug] = $category->name;
            }

             \View::share('selectCategories',$selectCategories);

        }

        if (\Schema::hasTable('cases_sub_types'))
        {
            $subCategories       = CaseSubType::orderBy('name','ASC')->get();
            $selectSubCategories    = array();
            $selectSubCategories[0] = "Select / All";
            foreach ($subCategories as $subCategory) {
               $selectSubCategories[$subCategory->slug] = $subCategory->name;
            }

             \View::share('selectSubCategories',$selectSubCategories);

        }

        if (\Schema::hasTable('meetings_venues'))
        {
            $venues          = MeetingVenue::orderBy('name','ASC')->get();
            $selectVenues    = array();
            $selectVenues[0] = "Select one";

            foreach ($venues as $venue) {
               $selectVenues[$venue->id] = $venue->name;
            }

             \View::share('selectVenues',$selectVenues);

        }

        if (\Schema::hasTable('cases_sub_sub_types'))
        {
            $subSubCategories          = CaseSubSubType::orderBy('name','ASC')->get();
            $selectSubSubCategories    = array();
            $selectSubSubCategories[0] = "Select / All";
            foreach ($subSubCategories as $subSubCategory) {
               $selectSubSubCategories[$subSubCategory->slug] = $subSubCategory->name;
            }

             \View::share('selectSubSubCategories',$selectSubSubCategories);

        }


        if (\Schema::hasTable('ports'))
        {

            $ports          = Port::orderBy('name','ASC')->get();
            $selectPorts    = array();
            $selectPorts[0] = "Select / All";
            foreach ($ports as $port) {
                $selectPorts[$port->id] = $port->name;
            }

            \View::share('selectPorts',$selectPorts);

        }


        if (\Schema::hasTable('relationships'))
        {
            $relationships          = Relationship::orderBy('name','ASC')->get();
            $selectRelationships    = array();
            $selectRelationships[0] = "Select / All";
            foreach ($relationships as $relationship) {
               $selectRelationships[$relationship->id] = $relationship->name;
            }

             \View::share('selectRelationships',$selectRelationships);

        }


        if (\Schema::hasTable('cases')) {

            $cases = \DB::table('cases')
                        ->join('users', 'cases.reporter', '=', 'users.id')
                        ->select(
                                    \DB::raw(
                                                "
                                                    IF(`cases`.`addressbook` = 1,(SELECT CONCAT(`first_name`, ' ', `surname`) FROM `addressbook` WHERE `addressbook`.`id`= `cases`.`reporter`), (SELECT CONCAT(users.`name`, ' ', users.`surname`) FROM `users` WHERE `users`.`id`= `cases`.`reporter`)) as reporterName

                                                "
                                            )
                                )
                        ->get();



            $reporters    = array();
            $reporters[0] = "Select / All";
            foreach ($cases as $case) {
               $reporters[$case->reporterName] = $case->reporterName;
            }

             \View::share('selectReporters',$reporters);

        }

         if (\Schema::hasTable('users')) {


            $users    = User::select('created_by')->get();
            $idsArray = array();

            foreach ($users as $user) {

                $idsArray[] = $user->created_by;
            }

            $idsArray =  array_unique($idsArray);

            $userObjs = User::whereIn('id',$idsArray)

            ->select(
                    \DB::raw(
                                "
                                   `id`,
                                   CONCAT(`name`, ' ', `surname`)  as createByName

                                "
                            )
                    )

            ->get();

            $users    = array();
            $users[0] = "Select / All";
            foreach ($userObjs as $userObj) {
               $users[$userObj->createByName] = $userObj->createByName;
            }

             \View::share('selectUsersCreatedBy',$users);

        }


        View()->composer('master',function($view){

        $view->with('addressBookNumber',addressbook::all());

          if(\Auth::check()) {

            $number = addressbook::where('user','=',\Auth::user()->id)->get();
            $view->with('addressBookNumber',$number);

            $allUsers = User::where('id','<>',\Auth::user()->id)->get();
            $view->with('loggedInUsers',$allUsers);

            $noPrivateMessages = Message::where('to','=',\Auth::user()->id)
                                         ->where('read','=',0)
                                         ->where('online','=',0)
                                         ->get();

            $view->with('noPrivateMessages',$noPrivateMessages);

            $noInboxMessages = Message::where('to','=',\Auth::user()->id)
                                        ->where('online','=',0)
                                        ->get();

            $view->with('noInboxMessages',$noInboxMessages);


            $noDepartments = Department::all();

            $view->with('noDepartments',$noDepartments);

            $noUsers = User::all();

            $view->with('noUsers',$noUsers);

            $noPOIUsers = Poi::all();
            $view->with('noPOIUsers',$noPOIUsers);


            $noRoles = UserRole::all();

            $view->with('noRoles',$noRoles);

            $noPositions = Position::all();

            $view->with('noPositions',$noPositions);

            $noRelationships = Relationship::all();

            $view->with('noRelationships',$noRelationships);

            $noProvinces = Province::all();

            $view->with('noProvinces',$noProvinces);

            $noCaseStatuses = CaseStatus::all();

            $view->with('noCaseStatuses',$noCaseStatuses);

            $userRole = UserRole::where('id','=',\Auth::user()->role)->first();

            $view->with('systemRole',$userRole);

            $noCasesPriorities = CasePriority::all();

            $view->with('noCasesPriorities',$noCasesPriorities);

            $noAffiliations = Affiliation::all();

            $view->with('noAffiliations',$noAffiliations);

            $noMeetings = Meeting::all();

            $view->with('noMeetings',$noMeetings);

            $noPermissions = Permission::all();
            $view->with('noPermissions',$noPermissions);


           $userViewAffiliationPermission   = \DB::table('group_permissions')
                            ->join('users_roles','group_permissions.group_id','=','users_roles.id')
                            ->where('group_permissions.permission_id','=',1)
                            ->where('group_permissions.group_id','=',\Auth::user()->role)
                            ->first();


            $view->with('userViewAffiliationPermission',$userViewAffiliationPermission);



            $userViewCalendarPermission   = \DB::table('group_permissions')
                            ->join('users_roles','group_permissions.group_id','=','users_roles.id')
                            ->where('group_permissions.permission_id','=',13)
                            ->where('group_permissions.group_id','=',\Auth::user()->role)
                            ->first();




            $view->with('userViewCalendarPermission',$userViewCalendarPermission);

          $userViewCasesPermission   = \DB::table('group_permissions')
                            ->join('users_roles','group_permissions.group_id','=','users_roles.id')
                            ->where('group_permissions.permission_id','=',15)
                            ->where('group_permissions.group_id','=',\Auth::user()->role)
                            ->first();

          $view->with('userViewCasesPermission',$userViewCasesPermission);


          $userViewAdministrationPermission   = \DB::table('group_permissions')
                            ->join('users_roles','group_permissions.group_id','=','users_roles.id')
                            ->where('group_permissions.permission_id','=',14)
                            ->where('group_permissions.group_id','=',\Auth::user()->role)
                            ->first();

          $view->with('userViewAdministrationPermission',$userViewAdministrationPermission);

          $userViewCasePriorityPermission   = \DB::table('group_permissions')
                            ->join('users_roles','group_permissions.group_id','=','users_roles.id')
                            ->where('group_permissions.permission_id','=',2)
                            ->where('group_permissions.group_id','=',\Auth::user()->role)
                            ->first();

          $view->with('userViewCasePriorityPermission',$userViewCasePriorityPermission);

          $userViewCaseStatusPermission   = \DB::table('group_permissions')
                            ->join('users_roles','group_permissions.group_id','=','users_roles.id')
                            ->where('group_permissions.permission_id','=',3)
                            ->where('group_permissions.group_id','=',\Auth::user()->role)
                            ->first();

          $view->with('userViewCaseStatusPermission',$userViewCaseStatusPermission);

          $userViewDepartmentsPermission   = \DB::table('group_permissions')
                            ->join('users_roles','group_permissions.group_id','=','users_roles.id')
                            ->where('group_permissions.permission_id','=',4)
                            ->where('group_permissions.group_id','=',\Auth::user()->role)
                            ->first();

          $view->with('userViewDepartmentsPermission',$userViewDepartmentsPermission);

          $userViewMeetingsPermission   = \DB::table('group_permissions')
                            ->join('users_roles','group_permissions.group_id','=','users_roles.id')
                            ->where('group_permissions.permission_id','=',5)
                            ->where('group_permissions.group_id','=',\Auth::user()->role)
                            ->first();

          $view->with('userViewMeetingsPermission',$userViewMeetingsPermission);

          $userViewPositionsPermission   = \DB::table('group_permissions')
                            ->join('users_roles','group_permissions.group_id','=','users_roles.id')
                            ->where('group_permissions.permission_id','=',6)
                            ->where('group_permissions.group_id','=',\Auth::user()->role)
                            ->first();

          $view->with('userViewPositionsPermission',$userViewPositionsPermission);

          $userViewProvincesPermission   = \DB::table('group_permissions')
                            ->join('users_roles','group_permissions.group_id','=','users_roles.id')
                            ->where('group_permissions.permission_id','=',7)
                            ->where('group_permissions.group_id','=',\Auth::user()->role)
                            ->first();

          $view->with('userViewProvincesPermission',$userViewProvincesPermission);

          $userViewRelationshipsPermission   = \DB::table('group_permissions')
                            ->join('users_roles','group_permissions.group_id','=','users_roles.id')
                            ->where('group_permissions.permission_id','=',8)
                            ->where('group_permissions.group_id','=',\Auth::user()->role)
                            ->first();

          $view->with('userViewRelationshipsPermission',$userViewRelationshipsPermission);

          $userViewUserGroupsPermission   = \DB::table('group_permissions')
                            ->join('users_roles','group_permissions.group_id','=','users_roles.id')
                            ->where('group_permissions.permission_id','=',9)
                            ->where('group_permissions.group_id','=',\Auth::user()->role)
                            ->first();

          $view->with('userViewUserGroupsPermission',$userViewUserGroupsPermission);

          $userViewUsersPermission   = \DB::table('group_permissions')
                            ->join('users_roles','group_permissions.group_id','=','users_roles.id')
                            ->where('group_permissions.permission_id','=',10)
                            ->where('group_permissions.group_id','=',\Auth::user()->role)
                            ->first();

          $view->with('userViewUsersPermission',$userViewUsersPermission);


          $userViewPOIPermission   = \DB::table('group_permissions')
                            ->join('users_roles','group_permissions.group_id','=','users_roles.id')
                            ->where('group_permissions.permission_id','=',11)
                            ->where('group_permissions.group_id','=',\Auth::user()->role)
                            ->first();

          $view->with('userViewPOIPermission',$userViewPOIPermission);

          $userViewPermissionsPermission   = \DB::table('group_permissions')
                            ->join('users_roles','group_permissions.group_id','=','users_roles.id')
                            ->where('group_permissions.permission_id','=',12)
                            ->where('group_permissions.group_id','=',\Auth::user()->role)
                            ->first();

          $view->with('userViewPermissionsPermission',$userViewPermissionsPermission);

          $userViewReportsPermission   = \DB::table('group_permissions')
                            ->join('users_roles','group_permissions.group_id','=','users_roles.id')
                            ->where('group_permissions.permission_id','=',16)
                            ->where('group_permissions.group_id','=',\Auth::user()->role)
                            ->first();

          $view->with('userViewReportsPermission',$userViewReportsPermission);

$nums = array('cases_pending'=>0, 'cases_pending_closure'=>0, 'cases_allocated'=>0, 'cases_closed'=>0);
$nums['cases_pending'] = count(
	\DB::table('cases')
		->join('cases_statuses', 'cases.status', '=', 'cases_statuses.id')->where('cases_statuses.name','=','Pending')->get()
);
$nums['cases_pending_closure'] = count(
	\DB::table('cases')
		->join('cases_owners', 'cases.id', '=', 'cases_owners.case_id')
		->join('cases_statuses', 'cases.status', '=', 'cases_statuses.id')
		->where('cases_statuses.name','=','Pending Closure')
		->groupBy('cases.id')
		->get()
);
$nums['cases_allocated'] = count(
	\DB::table('cases')
	->join('cases_owners', 'cases.id', '=', 'cases_owners.case_id')
	->join('cases_statuses', 'cases.status', '=', 'cases_statuses.id')
	->join('cases_sources', 'cases.source', '=', 'cases_sources.id')
	->join('cases_escalations', 'cases.id', '=', 'cases_escalations.case_id')
	->join('departments','cases.department','=','departments.id')
	->where('cases_statuses.name', '=', 'Allocated')
	->orWhere('cases_statuses.name', '=', 'Referred')
	->groupBy('cases.id')->get()
);
$nums['cases_closed'] = count(
	\DB::table('cases')
		->join('cases_owners', 'cases.id', '=', 'cases_owners.case_id')
		->join('cases_statuses', 'cases.status', '=', 'cases_statuses.id')
		->where('cases_statuses.name','=','Resolved')
		->groupBy('cases.id')
		->get()
);
$view->with('nums', $nums);

          }



        });

      }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
