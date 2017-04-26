<?php
use App\Province;
use App\District;
use App\Municipality;
use App\Department;
use App\CaseReport;
use App\Online;
use App\User;
use App\Message;
use App\Affiliation;
use App\MeetingVenue;
use App\CaseType;
use App\CaseSubType;
use App\TruckCompany;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(array('prefix' => 'api/v1'), function() {
    Route::get('categoriess', 'DepartController@index');
    Route::get('myreport', 'ReportCController@myReport');
    Route::post('report', 'ReportCController@store');
    Route::get('messagenofication','CaseNotesController@messagenofication');
    Route::post('mobilecaeCreate','CasesController@mobilecaeCreate');
    Route::post('createTrucksCase','CasesController@createTruckCase');
    Route::post('mobilesynch','CasesController@mobilesynch');


    Route::post('newmessagenofication','CaseNotesController@newmessagenofication');

    Route::get('showcontactmobile','AddressBookController@showcontactmobile');
    Route::post('declinseMoblie','ReportCController@declinseMoblie');
    Route::post('acceptedcaseMoblie','ReportCController@acceptedcaseMoblie');
    Route::post('requestcloser','ReportCController@requestcloser');
    Route::post('updatecasemobile','ReportCController@updatecasemobile');
    Route::post('refercase','ReportCController@refercase');




    Route::get('statuss', 'ReportCController@statuss');







    Route::post('mobilerallocate', 'CasesController@mobilerallocate');



    Route::post('actionteken', 'DepartController@action');
    Route::post('Casetype', 'DepartController@castype');
    Route::get('mobiledepartement', 'DepartController@mobiledepartement');
    Route::get('subcategories', 'DepartController@mobilesubcategories');
    Route::get('subsubcategories', 'DepartController@mobilesusubbcategories');

    Route::get('categories', 'DepartController@mobilecategories');



    Route::post('internalmyrepor', 'ReportCController@internalmyrepor');


    Route::get('getallusers', 'ReportCController@getallusers');
    Route::post('referemyrepor', 'ReportCController@referemyrepor');

    Route::get('mobilecalendarListPerUser', 'CasesController@mobilecalendarListPerUser');
    Route::post('reportImage','ReportCController@saveReportImage');
    Route::post('createincident','ReportCController@creatReport');

    Route::post('closeIncidentmobile', 'ReportCController@closeIncidentmobile');
    Route::post('login', 'UserCController@login');
    Route::post('forgot', 'UserCController@forgot');

});

/*
|--------------------------------------------------------------------------
| ROLES ROUTING
|--------------------------------------------------------------------------
|
*/

Route::get('caseliststatus', ['middleware' => 'auth', 'uses' => 'HomeController@caseliststatus']);



Route::get('list-pending-cases/', ['middleware' => 'auth', 'uses' => 'HomeController@PendingCasesPermissions']);
Route::get('list-allocated-cases/', ['middleware' => 'auth', 'uses' => 'HomeController@AllocatedCasesPermissions']);
Route::get('list-pending-closure-cases/', ['middleware' => 'auth', 'uses' => 'HomeController@PendingClosureCasesPermissions']);
Route::get('list-closed-cases/', ['middleware' => 'auth', 'uses' => 'HomeController@ClosedCasesPermissions']);


Route::get('list-roles', ['middleware' => 'auth', function()
{
    return view('roles.list');
}]);
Route::get('roles-list', ['middleware' => 'auth', 'uses' => 'RolesController@index']);
Route::get('roles/{id}', ['middleware' => 'auth', 'uses' => 'RolesController@edit']);


Route::post('add-role', ['middleware' => 'auth', 'uses' => 'RolesController@store']);
Route::post('update-role', ['middleware' => 'auth', 'uses' => 'RolesController@update']);

/*
|--------------------------------------------------------------------------
| END ROLES ROUTING
|--------------------------------------------------------------------------
|
*/



/*
|--------------------------------------------------------------------------
| USERS ROUTING
|--------------------------------------------------------------------------
|
*/

$this->post('login', 'Auth\LoginController@doLogin');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');


Route::get('auth', ['middleware' => 'auth', 'uses' => 'UserController@list_users']);

Route::get('list-users', ['middleware' => 'auth', 'uses' => 'UserController@list_users']);
Route::get('users-list', ['uses' => 'UserController@index']);

Route::get('getResponder', ['middleware' => 'auth', 'uses' => 'UserController@responder']);

Route::get('getResponders', ['middleware' => 'auth', 'uses' => 'UserController@getResponders']);


Route::get('getPois', ['middleware' => 'auth', 'uses' => 'UserController@getPois']);
Route::get('getPoisAssociates/{id}', ['middleware' => 'auth', 'uses' => 'UserController@getPoisAssociates']);
Route::get('deleteAssociation', ['middleware' => 'auth', 'uses' => 'UserController@deleteAssociation']);
Route::get('deleteCaseAssociation', ['middleware' => 'auth', 'uses' => 'UserController@deleteCaseAssociation']);
Route::get('getCasePoisAssociates/{id}', ['middleware' => 'auth', 'uses' => 'UserController@getCasePoisAssociates']);
Route::get('getPoiCasesAssociates/{id}', ['middleware' => 'auth', 'uses' => 'UserController@getPoiCasesAssociates']);
Route::get('getCaseSearch', ['middleware' => 'auth', 'uses' => 'UserController@getCaseSearch']);




Route::get('add-user', ['middleware' => 'auth', function()
{
    return view('users.registration');
}]);



Route::get('home', ['middleware' => 'auth', 'uses' => 'HomeController@index']);

Route::group(array('prefix' => 'api/v1'), function() {
    Route::get('categoriess', 'DepartController@index');
    Route::get('myreport', 'ReportCController@myReport');


});

Route::get('/', function () {
    return view('auth.login');
});


Route::get('users/{id}', ['middleware' => 'auth', 'uses' => 'UserController@edit']);

Route::post('updateUser', ['middleware' => 'auth', 'uses' => 'UserController@update']);

Route::get('getHouseHolder', ['middleware' => 'auth', 'uses' => 'UserController@getHouseHolder']);//getPoi

Route::get('getPoi', ['middleware' => 'auth', 'uses' => 'UserController@getPoi']);//getPoi


Route::post('filterUsersReports', ['middleware' => 'auth', 'uses' => 'UserController@show']);

Route::get('getFieldWorker', ['middleware' => 'auth', 'uses' => 'UserController@getFieldWorker']);

Route::get('list-poi-users', ['middleware' => 'auth', function()
{
    return view('users.poi');
}]);


Route::get('poi-list', ['middleware' => 'auth', 'uses' => 'UserController@list_poi']);

Route::get('add-poi-user', ['middleware' => 'auth', function()
{
    return view('users.poiregistration');
}]);


Route::get('edit-poi-user/{id}', ['middleware' => 'auth', 'uses' => 'UserController@edit_poi']);

Route::get('view-poi-associates/{id}', ['middleware' => 'auth', 'uses' => 'UserController@view_poi_associates']);

Route::get('view-case-poi-associates/{id}', ['middleware' => 'auth', 'uses' => 'UserController@view_case_poi_associates']);

Route::get('view-poi-cases-associates/{id}', ['middleware' => 'auth', 'uses' => 'UserController@view_poi_cases_associates']);





Route::post('save_poi', ['middleware' => 'auth', 'uses' => 'UserController@save_poi']);

Route::post('edit_poi', ['middleware' => 'auth', 'uses' => 'UserController@edit_poi_save']);



/*
|--------------------------------------------------------------------------
| END USERS ROUTING
|--------------------------------------------------------------------------
|
*/



/*
|--------------------------------------------------------------------------

| TRUCKS COMPANIES ROUTING
|--------------------------------------------------------------------------
|
*/
Route::get('list-trucks-companies', ['middleware' => 'auth', function()
{
    return view('truckCompanies.list');
}]);

Route::get('truck-companies-list', ['middleware' => 'auth', 'uses' => 'TruckCompaniesController@index']);
Route::get('companies/{id}', ['middleware' => 'auth', 'uses' => 'TruckCompaniesController@edit']);
Route::post('updateTruckCompany', ['middleware' => 'auth', 'uses' => 'TruckCompaniesController@update']);
Route::post('addCompany', ['middleware' => 'auth', 'uses' => 'TruckCompaniesController@store']);


/*
|--------------------------------------------------------------------------
| END TRUCKS COMPANIES ROUTING
|--------------------------------------------------------------------------
|
*/




/*
|--------------------------------------------------------------------------
| TRUCKS ROUTING
|--------------------------------------------------------------------------
|
*/

Route::get('list-trucks/{truckCompany}', ['middleware' => 'auth', function($truckCompany)
{
    $truckCompObj = TruckCompany::find($truckCompany);
    return view('trucks.list',compact('truckCompObj'));
}]);


Route::get('truck/{id}', ['middleware' => 'auth', 'uses' => 'TruckController@edit']);
Route::get('truck-list/{id}', ['middleware' => 'auth', 'uses' => 'TruckController@index']);
Route::post('updateTruck', ['middleware' => 'auth', 'uses' => 'TruckController@update']);
Route::post('addTruck', ['middleware' => 'auth', 'uses' => 'TruckController@store']);
Route::get('printPermit/{id}', ['middleware' => 'auth', 'uses' => 'PermitController@create']);



/*
|--------------------------------------------------------------------------
| END TRUCKS ROUTING
|--------------------------------------------------------------------------
|
*/


/*
|--------------------------------------------------------------------------
| GATE TRACK ENTRIES ROUTING
|--------------------------------------------------------------------------
|
*/
Route::get('list-gate-track-entries', ['middleware' => 'auth', function()
{
    return view('gateTrackEntries.list');
}]);

/*
|--------------------------------------------------------------------------
| END GATE TRACK ENTRIES ROUTING
|--------------------------------------------------------------------------
|
*/




/*
|--------------------------------------------------------------------------
| DEPARTMENTS ROUTING
|--------------------------------------------------------------------------
|
*/
Route::get('list-departments', ['middleware' => 'auth', function()
{
    return view('departments.list');
}]);

Route::get('departments-list', ['middleware' => 'auth', 'uses' => 'DepartmentController@index']);
Route::get('departments/{id}', ['middleware' => 'auth', 'uses' => 'DepartmentController@edit']);

Route::post('updateDepartment', ['middleware' => 'auth', 'uses' => 'DepartmentController@update']);
Route::post('addDepartment', ['middleware' => 'auth', 'uses' => 'DepartmentController@store']);


/*
|--------------------------------------------------------------------------
| END DEPARTMENTS ROUTING
|--------------------------------------------------------------------------
|
*/

/*
|--------------------------------------------------------------------------
| MEETINGS ROUTING
|--------------------------------------------------------------------------
|
*/


Route::get('canlendertest', ['middleware' => 'auth', function()
{
    return view('tesReport.calender');
}]);

Route::get('list-meetings', ['middleware' => 'auth', function()
{
    return view('meetings.list');
}]);



Route::get('meetings-list', ['middleware' => 'auth', 'uses' => 'MeetingsController@index']);
Route::get('meetings-attendees-list/{id}', ['middleware' => 'auth', 'uses' => 'MeetingsController@indexAttendee']);
Route::get('meetings-files-list/{id}', ['middleware' => 'auth', 'uses' => 'MeetingsController@indexFiles']);
Route::get('meetings/{id}', ['middleware' => 'auth', 'uses' => 'MeetingsController@edit']);
Route::post('updateMeeting', ['middleware' => 'auth', 'uses' => 'MeetingsController@update']);
Route::post('addMeetingMinutesFile', ['middleware' => 'auth', 'uses' => 'MeetingsController@uploadMeetingMinutes']);
Route::post('addMeeting', ['middleware' => 'auth', 'uses' => 'MeetingsController@store']);
Route::post('addMeetingAttendee', ['middleware' => 'auth', 'uses' => 'MeetingsController@storeAttendee']);
Route::post('removeMeetingAttendee', ['middleware' => 'auth', 'uses' => 'MeetingsController@removeAttendee']);
Route::post('inviteMeetingAttendee', ['middleware' => 'auth', 'uses' => 'MeetingsController@inviteAttendee']);
Route::post('markMeetingAttendee', ['middleware' => 'auth', 'uses' => 'MeetingsController@markAttendee']);


/*
|--------------------------------------------------------------------------
| END MEETINGS ROUTING
|--------------------------------------------------------------------------
|
*/

/*
|--------------------------------------------------------------------------
| VENUES ROUTING
|--------------------------------------------------------------------------
|
*/

Route::post('addVenue', ['middleware' => 'auth', 'uses' => 'VenuesController@store']);


/*
|--------------------------------------------------------------------------
| END VENUES ROUTING
|--------------------------------------------------------------------------
|
*/

/*
|--------------------------------------------------------------------------
| MEETING FACILITATORS ROUTING
|--------------------------------------------------------------------------
|
*/


Route::get('getMeetingFacilitators', ['middleware' => 'auth', 'uses' => 'AddressBookController@show']);


/*
|--------------------------------------------------------------------------
| END MEETING FACILITATORS ROUTING
|--------------------------------------------------------------------------
|
*/

/*
|--------------------------------------------------------------------------
| STATUSES ROUTING
|--------------------------------------------------------------------------
|
*/
Route::get('list-statuses', ['middleware' => 'auth', function()
{
    return view('statuses.list');
}]);

Route::get('statuses-list', ['middleware' => 'auth', 'uses' => 'CasesStatusesController@index']);
Route::get('statuses/{id}', ['middleware' => 'auth', 'uses' => 'CasesStatusesController@edit']);
Route::post('updateCaseStatus', ['middleware' => 'auth', 'uses' => 'CasesStatusesController@update']);
Route::post('addCaseStatus', ['middleware' => 'auth', 'uses' => 'CasesStatusesController@store']);


/*
|--------------------------------------------------------------------------
| END STATUSES ROUTING
|--------------------------------------------------------------------------
|
*/

/*
|--------------------------------------------------------------------------
| PRIORITIES ROUTING
|--------------------------------------------------------------------------
|
*/
Route::get('list-priorities', ['middleware' => 'auth', function()
{
    return view('priorities.list');
}]);

Route::get('priorities-list', ['middleware' => 'auth', 'uses' => 'CasesPrioritiesController@index']);
Route::get('priorities/{id}', ['middleware' => 'auth', 'uses' => 'CasesPrioritiesController@edit']);
Route::post('updateCasePriority', ['middleware' => 'auth', 'uses' => 'CasesPrioritiesController@update']);
Route::post('addCasePriority', ['middleware' => 'auth', 'uses' => 'CasesPrioritiesController@store']);


/*
|--------------------------------------------------------------------------
| END PRIORITIES ROUTING
|--------------------------------------------------------------------------
|
*/







/*
|--------------------------------------------------------------------------
| PROVINCES ROUTING
|--------------------------------------------------------------------------
|
*/
Route::get('list-ports', ['middleware' => 'auth', function()
{
    return view('provinces.list');
}]);

Route::get('ports-list', ['middleware' => 'auth', 'uses' => 'ProvincesController@index']);
Route::get('provinces/{id}', ['middleware' => 'auth', 'uses' => 'ProvincesController@edit']);
Route::post('updateProvince', ['middleware' => 'auth', 'uses' => 'ProvincesController@update']);
Route::post('addProvince', ['middleware' => 'auth', 'uses' => 'ProvincesController@store']);


/*
|--------------------------------------------------------------------------
| END PROVINCES ROUTING
|--------------------------------------------------------------------------
|
*/

/*
|--------------------------------------------------------------------------
| DISTRICS ROUTING
|--------------------------------------------------------------------------
|
*/
Route::get('list-districts/{province}', ['middleware' => 'auth', function($province)
{
    $provinceObj = Province::find($province);
    return view('districts.list',compact('provinceObj'));
}]);

Route::get('districts-list/{id}', ['middleware' => 'auth', 'uses' => 'DistricsController@index']);
Route::get('districts/{id}', ['middleware' => 'auth', 'uses' => 'DistricsController@edit']);
Route::post('updateDistrict', ['middleware' => 'auth', 'uses' => 'DistricsController@update']);
Route::post('addDistrict', ['middleware' => 'auth', 'uses' => 'DistricsController@store']);


/*
|--------------------------------------------------------------------------
| END DISTRICS ROUTING
|--------------------------------------------------------------------------
|
*/


/*
|--------------------------------------------------------------------------
| MUNICIPALITIES ROUTING
|--------------------------------------------------------------------------
|
*/
Route::get('list-municipalities/{district}', ['middleware' => 'auth', function($district)
{
    $districtObj   = District::find($district);
    $provinceObj  = Province::find($districtObj->province);
    return view('municipalities.list',compact('districtObj','provinceObj'));
}]);


Route::get('municipalities-list/{id}', ['middleware' => 'auth', 'uses' => 'MunicipalitiesController@index']);
Route::get('municipalities/{id}', ['middleware' => 'auth', 'uses' => 'MunicipalitiesController@edit']);

Route::post('updateMunicipality', ['middleware' => 'auth', 'uses' => 'MunicipalitiesController@update']);
Route::post('addMunicipality', ['middleware' => 'auth', 'uses' => 'MunicipalitiesController@store']);

/*
|--------------------------------------------------------------------------
| END MUNICIPALITIES ROUTING
|--------------------------------------------------------------------------
|
*/


/*
|--------------------------------------------------------------------------
| WARDS ROUTING
|--------------------------------------------------------------------------
|
*/
Route::get('list-wards/{municipality}', ['middleware' => 'auth', function($municipality)
{
    $municipalityObj  = Municipality::find($municipality);
    $districtObj      = District::find($municipalityObj->district);
    $provinceObj      = Province::find($districtObj->province);
    return view('wards.list',compact('districtObj','municipalityObj','provinceObj'));
}]);


Route::get('wards-list/{id}', ['middleware' => 'auth', 'uses' => 'WardsController@index']);
Route::get('wards/{id}', ['middleware' => 'auth', 'uses' => 'WardsController@edit']);

Route::post('updateWard', ['middleware' => 'auth', 'uses' => 'WardsController@update']);
Route::post('addWard', ['middleware' => 'auth', 'uses' => 'WardsController@store']);

/*
|--------------------------------------------------------------------------
| END WARDS ROUTING
|--------------------------------------------------------------------------
|
*/






/*
|--------------------------------------------------------------------------
| CATEGORIES ROUTING
|--------------------------------------------------------------------------
|
*/

Route::get('list-categories/{department}', ['middleware' => 'auth', function($department)
{
    $deptObj = Department::find($department);
    return view('categories.list',compact('deptObj'));
}]);


Route::get('categories/{id}', ['middleware' => 'auth', 'uses' => 'CategoriesController@edit']);
Route::get('categories-list/{id}', ['middleware' => 'auth', 'uses' => 'CategoriesController@index']);
Route::post('updateCategory', ['middleware' => 'auth', 'uses' => 'CategoriesController@update']);
Route::post('addCategory', ['middleware' => 'auth', 'uses' => 'CategoriesController@store']);


/*
|--------------------------------------------------------------------------
| END CATEGORIES ROUTING
|--------------------------------------------------------------------------
|
*/



/*
|--------------------------------------------------------------------------
| SUB-CATEGORIES ROUTING
|--------------------------------------------------------------------------
|
*/
Route::get('list-sub-categories/{category}', ['middleware' => 'auth', function($category)
{
    $catObj   = CaseType::find($category);
    $deptName = Department::find($catObj->department);
    return view('subcategories.list',compact('catObj','deptName'));
}]);

Route::get('subcategories/{id}', ['middleware' => 'auth', 'uses' => 'SubCategoriesController@edit']);
Route::get('sub-categories-list/{id}', ['middleware' => 'auth', 'uses' => 'SubCategoriesController@index']);
Route::post('updateSubCategory', ['middleware' => 'auth', 'uses' => 'SubCategoriesController@update']);
Route::post('addSubCategory', ['middleware' => 'auth', 'uses' => 'SubCategoriesController@store']);

/*
|--------------------------------------------------------------------------
| END SUB-CATEGORIES ROUTING
|--------------------------------------------------------------------------
|
*/

/*
|--------------------------------------------------------------------------
| SUB-SUB-CATEGORIES ROUTING
|--------------------------------------------------------------------------
|
*/

Route::get('list-sub-sub-categories/{sub_category}', ['middleware' => 'auth', function($sub_category)
{
    $subCatObj = CaseSubType::find($sub_category);
    $catObj    = CaseType::find($subCatObj->category);
    $deptObj   = Department::find($catObj->department);
    return view('subsubcategories.list',compact('subCatObj','deptObj','catObj'));
}]);

Route::get('sub-sub-categories-list/{id}', ['middleware' => 'auth', 'uses' => 'SubSubCategoriesController@index']);
Route::get('subsubcategories/{id}', ['middleware' => 'auth', 'uses' => 'SubSubCategoriesController@edit']);
Route::post('addSubSubCategory', ['middleware' => 'auth', 'uses' => 'SubSubCategoriesController@store']);
Route::post('updateSubSubCategory', ['middleware' => 'auth', 'uses' => 'SubSubCategoriesController@update']);



/*
|--------------------------------------------------------------------------
| END SUB-SUB-CATEGORIES ROUTING
|--------------------------------------------------------------------------
|
*/


/*
|--------------------------------------------------------------------------
| CASES ROUTING
|--------------------------------------------------------------------------
|
*/

Route::get('cases-list/{id}', ['middleware' => 'auth', 'uses' => 'CasesController@index']);
Route::get('cases-calendar-list', ['middleware' => 'auth', 'uses' => 'CasesController@calendarList']);
Route::get('cases-calendar-list-perUser/{id}', ['middleware' => 'auth', 'uses' => 'CasesController@calendarListPerUser']);
Route::get('case/{id}', ['middleware' => 'auth', 'uses' => 'CasesController@edit']);
Route::get('workflows-list-case/{id}', ['middleware' => 'auth', 'uses' => 'CasesController@workflow']);
Route::post('escalateCase', ['middleware' => 'auth', 'uses' => 'CasesController@escalate']);
Route::post('allocateCase', ['middleware' => 'auth', 'uses' => 'CasesController@allocate']);
Route::post('addCasePoi', ['middleware' => 'auth', 'uses' => 'CasesController@addCasePoi']);
Route::post('addAssociatePoi', ['middleware' => 'auth', 'uses' => 'CasesController@addAssociatePoi']);
Route::post('addCaseAssociatePoi', ['middleware' => 'auth', 'uses' => 'CasesController@addCaseAssociatePoi']);
Route::post('addCaseAssociatePoiCase', ['middleware' => 'auth', 'uses' => 'CasesController@addCaseAssociatePoiCase']);



Route::post('createCase', ['middleware' => 'auth', 'uses' => 'CasesController@create']);
Route::post('createCaseAgent', ['middleware' => 'auth', 'uses' => 'CasesController@createCaseAgent']);
Route::get('acceptCase/{id}', ['middleware' => 'auth', 'uses' => 'CasesController@acceptCase']);
Route::get('addCaseForm', ['middleware' => 'auth', 'uses' => 'CasesController@captureCase']);
Route::get('closeCase/{id}', ['middleware' => 'auth', 'uses' => 'CasesController@closeCase']);
Route::post('requestCaseClosure', ['middleware' => 'auth', 'uses' => 'CasesController@requestCaseClosure']);
Route::get('request-cases-closure-list', ['middleware' => 'auth', 'uses' => 'CasesController@requestCaseClosureList']);
Route::get('resolved-cases-list', ['middleware' => 'auth', 'uses' => 'CasesController@resolvedCasesList']);
Route::get('pending-referral-cases-list', ['middleware' => 'auth', 'uses' => 'CasesController@pendingReferralCasesList']);
Route::post('captureCaseUpdate', ['middleware' => 'auth', 'uses' => 'CasesController@captureCaseUpdate']);
Route::post('captureCaseUpdateH', ['middleware' => 'auth', 'uses' => 'CasesController@captureCaseUpdateH']);
Route::get('relatedCases-list/{id}', ['middleware' => 'auth', 'uses' => 'CasesController@relatedCases']);


/*
|--------------------------------------------------------------------------
| END CASES ROUTING
|--------------------------------------------------------------------------
|
*/


/*
|--------------------------------------------------------------------------
| ADDRESSBOOK ROUTING
|--------------------------------------------------------------------------
|
*/
Route::get('addressbook-list/{id}', ['middleware' => 'auth', 'uses' => 'AddressBookController@index']);
Route::post('addContact', ['middleware' => 'auth', 'uses' => 'AddressBookController@store']);
Route::get('getContacts', ['middleware' => 'auth', 'uses' => 'AddressBookController@show']);
Route::get('getPoisContacts', ['middleware' => 'auth', 'uses' => 'UserController@searchPOI']);




/*
|--------------------------------------------------------------------------
| END ADDRESSBOOK ROUTING
|--------------------------------------------------------------------------
|
*/



/*
|--------------------------------------------------------------------------
| RELATIONSHIP ROUTING
|--------------------------------------------------------------------------
|
*/


/*
|--------------------------------------------------------------------------
| POSITIONS ROUTING
|--------------------------------------------------------------------------
|
*/

Route::get('list-relationships', ['middleware' => 'auth', function()
{
    return view('relationships.list');

}]);

Route::get('relationships-list', ['middleware' => 'auth', 'uses' => 'RelationshipController@index']);
Route::get('relationships/{id}', ['middleware' => 'auth', 'uses' => 'RelationshipController@edit']);
Route::post('updateRelationship', ['middleware' => 'auth', 'uses' => 'RelationshipController@update']);
Route::post('addRelationship', ['middleware' => 'auth', 'uses' => 'RelationshipController@store']);


/*
|--------------------------------------------------------------------------
| END POSITIONS ROUTING
|--------------------------------------------------------------------------
|
*/






/*
|--------------------------------------------------------------------------
| END RELATIONSHIP ROUTING
|--------------------------------------------------------------------------
|
*/


/*
|--------------------------------------------------------------------------
| RESPONDERS ROUTING
|--------------------------------------------------------------------------
|
*/
Route::get('getsubSubResponders/{id}', ['middleware' => 'auth', 'uses' => 'RespondersController@subSubResponder']);
Route::post('addSubSubCategoryResponder', ['middleware' => 'auth', 'uses' => 'RespondersController@storeSubSubResponder']);
Route::get('getSubResponders/{id}', ['middleware' => 'auth', 'uses' => 'RespondersController@subResponder']);
Route::post('addSubCategoryResponder', ['middleware' => 'auth', 'uses' => 'RespondersController@storeSubResponder']);
Route::get('caseResponders-list/{id}', ['middleware' => 'auth', 'uses' => 'RespondersController@index']);






/*
|--------------------------------------------------------------------------
| END RESPONDERS ROUTING
|--------------------------------------------------------------------------
|
*/


/*
|--------------------------------------------------------------------------
| WORKFLOWS ROUTING
|--------------------------------------------------------------------------
|
*/

Route::get('workflows-list/{id}', ['middleware' => 'auth', 'uses' => 'WorkflowsController@index']);
Route::get('saveWorkFlowOrder', ['middleware' => 'auth', 'uses' => 'WorkflowsController@saveWorkFlowOrder']);
Route::post('AddWorkF', ['middleware' => 'auth', 'uses' => 'WorkflowsController@store']);
Route::post('removeWorkFlow', ['middleware' => 'auth', 'uses' => 'WorkflowsController@removeWorkFlow']);


/*
|--------------------------------------------------------------------------
| END WORKFLOWS ROUTING
|--------------------------------------------------------------------------
|
*/

/*
|--------------------------------------------------------------------------
| CASE NOTES ROUTING
|--------------------------------------------------------------------------
|
*/
Route::get('caseNotes-list/{id}', ['middleware' => 'auth', 'uses' => 'CaseNotesController@index']);
Route::get('poi-list/{id}', ['middleware' => 'auth', 'uses' => 'CasesController@list_case_poi']);

Route::post('addCaseNote', ['middleware' => 'auth', 'uses' => 'CaseNotesController@store']);


/*
|--------------------------------------------------------------------------
| END CASE NOTES ROUTING
|--------------------------------------------------------------------------
|
*/


/*
|--------------------------------------------------------------------------
| CASE FILES ROUTING
|--------------------------------------------------------------------------
|
*/

Route::post('addCaseFile', ['middleware' => 'auth', 'uses' => 'CaseFilesController@store']);
Route::get('fileDescription/{id}/{name}', ['middleware' => 'auth', 'uses' => 'CaseFilesController@index']);


/*
|--------------------------------------------------------------------------
| END CASE FILES ROUTING
|--------------------------------------------------------------------------
|
*/



/*
|--------------------------------------------------------------------------
| CASE ACTIVITIES ROUTING
|--------------------------------------------------------------------------
|
*/

Route::get('caseActivities-list/{id}', ['middleware' => 'auth', 'uses' => 'CaseActivitiesController@index']);

/*
|--------------------------------------------------------------------------
| END CASE ACTIVITIES ROUTING
|--------------------------------------------------------------------------
|
*/






/*
|--------------------------------------------------------------------------
| POSITIONS ROUTING
|--------------------------------------------------------------------------
|
*/

Route::get('list-positions', ['middleware' => 'auth', function()
{
    return view('positions.list');
}]);

Route::get('positions-list', ['middleware' => 'auth', 'uses' => 'PositionsController@index']);
Route::get('positions/{id}', ['middleware' => 'auth', 'uses' => 'PositionsController@edit']);
Route::post('updatePosition', ['middleware' => 'auth', 'uses' => 'PositionsController@update']);
Route::post('addPosition', ['middleware' => 'auth', 'uses' => 'PositionsController@store']);

Route::get('getPositions', ['middleware' => 'auth', 'uses' => 'PositionsController@show']);


/*
|--------------------------------------------------------------------------
| END POSITIONS ROUTING
|--------------------------------------------------------------------------
|
*/





/*
|--------------------------------------------------------------------------
| CALENDAR ROUTING
|--------------------------------------------------------------------------
|
*/

Route::get('calendar', ['middleware' => 'auth', 'uses' => 'CalendarController@index']);
Route::post('getEvents', ['middleware' => 'auth', 'uses' => 'CalendarController@show']);


/*
|--------------------------------------------------------------------------
| END CALENDAR ROUTING
|--------------------------------------------------------------------------
|
*/


/*
|--------------------------------------------------------------------------
| CALENDAR DEMO ROUTING
|--------------------------------------------------------------------------
|
*/

Route::get('calendarreal', ['middleware' => 'auth', function()
{
    return view('calendarreal.calendar');
}]);

Route::get('calendarreal', ['middleware' => 'auth', 'uses' => 'CalendarController@showCalendar']);
Route::get('calendar', ['middleware' => 'auth', 'uses' => 'CalendarController@index']);
Route::post('getEvents', ['middleware' => 'auth', 'uses' => 'CalendarController@show']);

Route::get('lcases-calendar-list', ['middleware' => 'auth', 'uses' => 'CalendarController@calendarList']);
Route::get('lcases-calendar-list-perUser', ['middleware' => 'auth', 'uses' => 'CalendarController@landingsCalendarListPerUser']);

  Route::get('lcases-calendar-list', ['middleware' => 'auth', 'uses' => 'CalendarController@calendarList']);
  Route::get('lcases-calendar-list-perUser', ['middleware' => 'auth', 'uses' => 'CalendarController@landingsCalendarListPerUser']);


/*
|--------------------------------------------------------------------------
| END CALENDAR DEMO ROUTING
|--------------------------------------------------------------------------
|
*/


/*
|--------------------------------------------------------------------------
| CALENDAR TASKS ROUTING
|--------------------------------------------------------------------------
|
*/

Route::get('tasks-calendar', ['middleware' => 'auth', function()
{
    return view('task_calendar.calendar');
}]);
Route::get('getCalendarTasks', ['middleware' => 'auth', 'uses' => 'TaskCalendarController@index']);

/*
|--------------------------------------------------------------------------
| END CALENDAR TASKS ROUTING
|--------------------------------------------------------------------------
|
*/


/*
|--------------------------------------------------------------------------
| CASE OWNERS ROUTING
|--------------------------------------------------------------------------
|
*/

Route::get('caseOwner/{user}/{id}', ['middleware' => 'auth', 'uses' => 'CaseOwnerController@index']);


/*
|--------------------------------------------------------------------------
| CASE OWNERS ROUTING
|--------------------------------------------------------------------------
|
*/

/*
|--------------------------------------------------------------------------
|  PASSWORD  ROUTING
|--------------------------------------------------------------------------
|
*/


Route::get('resend_password/{id}', 'UserController@resendPassword');
// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');


// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

/*
|--------------------------------------------------------------------------
|  END PASSWORD  ROUTING
|--------------------------------------------------------------------------
|
*/



/*
|--------------------------------------------------------------------------
| REPORTS ROUTING
|--------------------------------------------------------------------------
|
*/

Route::get('reports', ['middleware' => 'auth', function()
{
    return view('reports.list');
}]);

Route::get('reports-list', ['middleware' => 'auth', 'uses' => 'ReportsController@index']);
Route::post('filterReports', ['middleware' => 'auth', 'uses' => 'ReportsController@show']);



/*
|--------------------------------------------------------------------------
| END REPORTS ROUTING
|--------------------------------------------------------------------------
|
*/



$router->resource('users','UserController');

Route::get('/api/dropdown/{to}/{from}', function($to,$from){
    $name      = Input::get('option');

    if ($from == 'province')
    {
        $object = Province::where('slug','=',$name)->first();
    }
    if ($from == 'district')
    {
        $object = District::where('slug','=',$name)->first();
    }

    if ($from == 'municipality')
    {
        $object  = Municipality::where('slug','=',$name)->first();
        $listing = DB::table($to)->where($from,$object->id)->lists('name', 'slug');

    } else {

        $listing = DB::table($to)->where($from,$object->id)->orderBy('name','ASC')->lists('name', 'slug');
    }



    return $listing;

});

Route::get('/api/dropdownDepartment/{to}/{from}', function($to,$from){

    $name      = Input::get('option');

    if ($from == 'department')
    {
        $object = Department::where('slug','=',$name)->first();
        $listing = DB::table('cases_types')
            ->where('department','=',$object->id)
            ->orderBy('name','ASC')
            ->lists('name', 'slug');
    }

    if ($from == 'category')
    {
        $object  = CaseType::where('slug','=',$name)->first();
        $listing = DB::table('cases_sub_types')
            ->where('case_type','=',$object->id)
            ->orderBy('name','ASC')
            ->lists('name', 'slug');
    }

    if ($from == 'sub_category')
    {
        $object  = CaseSubType::where('slug','=',$name)->first();
        $listing = DB::table('cases_sub_sub_types')
            ->where('case_type','=',$object->id)
            ->orderBy('name','ASC')
            ->lists('name', 'slug');
    }

    return $listing;
});

Route::get('/api/dropdownCaseType/{to}/{from}', function($to,$from){

    $id      = Input::get('option');

    if ($from == 'case_type')
    {
        $object = CaseType::where('id','=',$id)->first();
        $listing = DB::table('cases_sub_types')
            ->where('case_type','=',$object->id)
            ->orderBy('name','ASC')
            ->lists('name', 'id');
    }

    return $listing;
});

Route::get('/api/dropdownCategory/{to}/{from}', function($to,$from){

    $name      = Input::get('option');

    if ($from == 'category')
    {
        $object = CaseType::where('slug','=',$name)->first();
    }
    else{

        $object = CaseSubType::where('slug','=',$name)->first();

    }

    if ($from == 'category')
    {
        $listing = DB::table('cases_sub_types')
            ->where('case_type','=',$object->id)
            ->orderBy('name','ASC')
            ->lists('name', 'slug');

    }
    else {

        $listing = DB::table('cases_sub_sub_types')
            ->where('case_type','=',$object->id)
            ->orderBy('name','ASC')
            ->lists('name', 'slug');
    }

    return $listing;
});


Route::get('/api/dropdown/{table}', function($table){

    $listing   = DB::table($table)->orderBy('name','ASC')->lists('name', 'id');

    return $listing;

});




Route::post('postChat', ['middleware' => 'auth', 'uses' => 'ChatController@postChat']);


Event::listen('auth.login', function()
{
    $user               = User::find(\Auth::user()->id);
    $user->availability = 1;
    $user->last_login   =  new DateTime;
    $user->save();
});

Event::listen('auth.logout', function()
{
    $user = User::find(\Auth::user()->id);
    $user->availability = 0;
    $user->last_logout  =  new DateTime;
    $user->save();
});



Route::get('getLoggedInUsers', function(){

    $allUsers = User::where('id','<>',\Auth::user()->id)->orderBy('availability','desc')->get();
    $html     = "";

    foreach ($allUsers as $user) {

        $availability = ($user->availability == 1)? "<i class='fa fa-circle-o status m-r-5'></i>":"<i class='fa fa-circle-o offline m-r-5'></i>";
        $html .=  "<div class='media'>";
        $html .=  "<a href='#' onClick='chatStart(this)' class='chatWith' data-userid = '$user->id' data-names = '$user->name $user->surname'> <img class='pull-left' src='img/profile-pics/7.png' width='30' alt=''></a>";
        $html .=  "<div class='media-body'>";
        $html .=  "<span class='t-overflow p-t-5'>$user->name  $user->surname $availability</span>";
        $html .=  "</div>";
        $html .=  "</div>";

    }
    return $html;

});



/*
|--------------------------------------------------------------------------
| CASE MESSAGE ROUTING
|--------------------------------------------------------------------------
|
*/

Route::post('addCaseMessage', ['middleware' => 'auth', 'uses' => 'MessageController@store']);

Route::get('/getOfflineMessage', function(){

    $offlineMessages = Message::where('to','=',\Auth::user()->id)
        ->where('online','=',0)
        ->orderBy('created_at','desc')
        ->take(5)
        ->get();

    $html     = "";

    foreach ($offlineMessages as $message) {

        $user = User::where('id','=',$message->from)->first();
        $read = ($message->read == 0)? "<span class='label label-danger'>New</span>":"";
        $html .=  "<div class='media'>";
        $html .=  "<div class='pull-left'>";
        $html .=  "<a href='#' onClick='chatStart(this)'> <img class='pull-left' src='img/profile-pics/7.png' width='30' alt=''></a>";
        $html .=  "</div>";
        $html .=  "<div class='media-body'>";
        $html .=  "<small class='text-muted'>$user->name  $user->surname - $message->created_at</small> $read<br>";
        $html .=  "<a class='t-overflow' href='message-detail/$message->id'>$message->message .Ref:Case ID $message->caseId</a>";
        $html .=  "</div>";
        $html .=  "</div>";

    }
    return $html;

});

Route::get('message-detail/{id}','MessageController@edit');
Route::get('all-messages','MessageController@index');


/*
|--------------------------------------------------------------------------
| END CASE MESSAGE ROUTING
|--------------------------------------------------------------------------
|
*/


/*
|--------------------------------------------------------------------------
| AFFILIATIONS ROUTING
|--------------------------------------------------------------------------
|
*/
Route::get('list-affiliations', ['middleware' => 'auth', function()
{
    return view('affiliations.list');
}]);

Route::get('list-affiliation-positions/{affiliation}', ['middleware' => 'auth', function($affiliation)
{

    $affiliationObj = Affiliation::find($affiliation);

    return view('affiliations.positions',compact('affiliationObj'));
}]);

Route::get('affiliations-list', ['middleware'   => 'auth', 'uses' => 'AffiliationsController@index']);
Route::get('affiliations/{id}', ['middleware'   => 'auth', 'uses' => 'AffiliationsController@edit']);
Route::get('affiliation-positions/{id}', ['middleware'   => 'auth', 'uses' => 'AffiliationsController@getAffiliationPositions']);
Route::post('updateAffiliation', ['middleware'  => 'auth', 'uses' => 'AffiliationsController@update']);
Route::post('addAffiliation', ['middleware'     => 'auth', 'uses' => 'AffiliationsController@store']);
Route::post('addAffiliationPosition', ['middleware'     => 'auth', 'uses' => 'AffiliationsController@addAffiliationPosition']);


/*
|--------------------------------------------------------------------------
| END PRIORITIES ROUTING
|--------------------------------------------------------------------------
|
*/



Route::get('list-permissions', ['middleware' => 'auth', function()
{
    return view('permissions.list');
}]);

Route::get('permissions-list', ['middleware' => 'auth', 'uses' => 'PermissionController@index']);


Route::get('permissions/{id}', ['middleware'   => 'auth', 'uses' => 'PermissionController@edit']);


Route::post('updatePermission', ['middleware'  => 'auth', 'uses' => 'PermissionController@update']);


Route::get('permissions-list/{id}', ['middleware' => 'auth', 'uses' => 'PermissionController@list_permissions']);


Route::get('getPermissions', ['middleware' => 'auth', 'uses' => 'PermissionController@show']);

Route::post('addGroupPermission', ['middleware' => 'auth', 'uses' => 'PermissionController@storeGroupPermissions']);

Route::post('removeGroupPermission', ['middleware' => 'auth', 'uses' => 'PermissionController@removeGroupPermission']);




Route::get('list-permissions-per-group/{group}', ['middleware' => 'auth', function($group)
{
    return view('permissions.group',compact('group',$group));
}]);

Route::get('group-users-list/{id}', ['middleware' => 'auth', 'uses' => 'PermissionController@group_users_list']);


Route::get('map', ['middleware' => 'auth', 'uses' => 'MapController@index']);


Route::get('poimap/{id}', ['middleware' => 'auth', 'uses' => 'UserController@poimap']);


Route::resource('api/v1/gatetrack',v1\ApiController::class,[

    'except' => ['create']

]);

Route::get('case_map/{id}', ['middleware' => 'auth', 'uses' => 'CasesController@casemap']);



Route::get('notiocat', function () {
    return view('Notification.notification');
});
