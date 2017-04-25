<?php

namespace App\Http\Controllers;

use App\CaseSubType;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\SubSubCategoryRequest;
use App\Http\Controllers\Controller;
use App\CaseSubSubType;

class SubSubCategoriesController extends Controller
{

    public function index($id)
    {
        $subSubCategories  = CaseSubSubType::select(array('id','name','created_at'))->where('case_type','=',$id);
        return \Datatables::of($subSubCategories)
                            ->addColumn('actions','<a class="btn btn-xs btn-alt" data-toggle="modal" onClick="launchUpdateSubSubCategoryModal({{$id}});" data-target=".SubSubCategoryEditModal">Edit</a>
                                                   <a class="btn btn-xs btn-alt" data-toggle="modal" onClick="launchSubSubCatResponders({{$id}});" data-target=".modalSubSubResponder">Set Responders</a>

                                                   ')
                            ->make(true);
    }


    public function store(SubSubCategoryRequest $request)
    {
        $SubSubCategory               = new CaseSubSubType();
        $SubSubCategory->name         = $request['name'];
        $slug                         = preg_replace('/\s+/','-',$request['name']);
        $SubSubCategory->slug         = $slug;
        $SubSubCategory->case_type    = $request['subCatID'];
        $SubSubCategory->created_by  = \Auth::user()->id;
        $SubSubCategory->save();
        \Session::flash('success', $request['name'].' has been successfully added!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $SubSubCat    = SubSubCategory::where('id',$id)->first();
        return [$SubSubCat];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request)
    {
        $subSubCategory             = SubSubCategory::where('id',$request['subsubCategoryID'])->first();
        $subSubCategory->name       = $request['name'];
        $SubSubCategory->updated_by = \Auth::user()->id;
        $subSubCategory->save();
        \Session::flash('success', $request['name'].' has been successfully updated!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
