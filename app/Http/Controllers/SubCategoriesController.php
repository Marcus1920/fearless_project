<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\SubCategoryRequest;
use App\Http\Controllers\Controller;
use App\CaseSubType;


class SubCategoriesController extends Controller
{

    public function index($id)
    {

        $caseSubType= CaseSubType::select(array('id','name','created_at'))->where('case_type','=',$id);
        return \Datatables::of($caseSubType)
                            ->addColumn('actions','<a class="btn btn-xs btn-alt" data-toggle="modal" onClick="launchUpdateSubCategoryModal({{$id}});" data-target=".modalEditSubCategory">Edit</a>
                                                   <a class="btn btn-xs btn-alt" data-toggle="modal" onClick="launchSubCatResponders({{$id}});" data-target=".modalSubResponder">Set Responders</a>
                                                   <a class="btn btn-xs btn-alt" data-toggle="modal" onClick="launchWorkFlow({{$id}});" data-target=".modalWorkflows">Add Workflow</a>

                                                   ')
                            ->make(true);
    }


    public function store(SubCategoryRequest $request)
    {

		 $caseSubType              = new CaseSubType();
         $caseSubType->name        = $request['name'];
         $slug                     = preg_replace('/\s+/','-',$request['name']);
         $caseSubType->slug        = $slug;
         $caseSubType->case_type   = $request['subCatID'];
         $caseSubType->created_by  = \Auth::user()->id;
         $caseSubType->save();
		 
        \Session::flash('success', $request['name'].' has been successfully added!');
        return redirect()->back();
    }


    public function edit($id)
    {
        $SubCat    = CaseSubType::where('id',$id)->first();
        return [$SubCat];
    }


    public function update(Request $request)
    {

		$caseSubType             = CaseSubType::where('id',$request['subCategoryID'])->first();
        $caseSubType->name       = $request['name'];
        $caseSubType->updated_by = \Auth::user()->id;
        $caseSubType->save();
        \Session::flash('success', $request['name'].' has been successfully updated!');
        return redirect()->back();
    }


}
