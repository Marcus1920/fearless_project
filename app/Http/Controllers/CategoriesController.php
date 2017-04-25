<?php

namespace App\Http\Controllers;

use App\Services\CaseTypeService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CategoryRequest;
use App\Http\Controllers\Controller;
use App\Category;
use App\CaseType;



class CategoriesController extends Controller
{

    protected  $caseTypes;

    public function __construct(CaseTypeService $service)
    {
        $this->caseTypes = $service;

    }


    public function index($id)
    {

        $caseType = CaseType::select(array('id','name','created_at'))->where('department','=',$id);
        return \Datatables::of($caseType)
                            ->addColumn('actions','<a class="btn btn-xs btn-alt" data-toggle="modal" onClick="launchUpdateCategoryModal({{$id}});" data-target=".modalEditCategory">Edit</a>')
                            ->make(true);
    }



    public function store(CategoryRequest $request)
    {

		 $caseType             = new CaseType();
         $caseType->name       = $request['name'];
         $slug                 = preg_replace('/\s+/','-',$request['name']);
         $caseType->slug       = $slug.$request['deptID'];
         $caseType->department = $request['deptID'];
         $caseType->created_by = \Auth::user()->id;
         $caseType->save();
		 
        \Session::flash('success', $request['name'].' category has been successfully added!');
        return redirect()->back();
    }

    public function edit($id)
    {
        $cat    = CaseType::where('id',$id)->first();
        return [$cat];
    }


    public function update(Request $request)
    {

		$caseType             = CaseType::where('id',$request['categoryID'])->first();
        $caseType->name       = $request['name'];
        $caseType->updated_by = \Auth::user()->id;
        $caseType->save();
        \Session::flash('success', $request['name'].' has been successfully updated!');
        return redirect()->back();
    }


}
