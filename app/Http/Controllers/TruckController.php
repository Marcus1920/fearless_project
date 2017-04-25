<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Truck;

class TruckController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $truck = Truck::select(array('id','make','created_at'))->where('company','=',$id);
        return \Datatables::of($truck)

                            ->addColumn('actions','<a class="btn btn-xs btn-alt" data-toggle="modal" onClick="launchUpdateTruck({{$id}});" data-target=".modalEditTruck">Edit</a>
													<a class="btn btn-xs btn-alt" data-toggle="modal">Suspend</a>
													<a class="btn btn-xs btn-alt" data-toggle="modal" onClick="launchPrintPermitModal({{$id}});" data-target=".modalPrintPermit">Print Permit</a>
							')


                            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$truck             			= new Truck();
        $truck->company 			= $request['companyID'];
		$truck->registration_number = $request['registration_number'];
		$truck->reference_number 	= $request['reference_number'];
		$truck->vin_number 			= $request['vin_number'];
		$truck->chassis_number 		= $request['chassis_number'];
		$truck->engine_number 		= $request['engine_number'];
		$truck->registration_year 	= $request['registration_year'];
		$truck->make 				= $request['make'];
	    $truck->model 				= $request['model'];
		$truck->colour 				= $request['colour'];
		$truck->speed_limit 		= $request['speed_limit'];
		$truck->date_inactive 		= $request['date_inactive'];
        $truck->created_by 			= \Auth::user()->id;
		$truck->created_by 			= \Auth::user()->id;
        $truck->save();
        \Session::flash('success', $request['make'].' Truck has been successfully added!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $truck    = Truck::where('id',$id)->first();
        return [$truck];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request)
    {
        $truck             			= Truck::where('id',$request['truckID'])->first();
		$truck->registration_number = $request['registration_number'];
		$truck->reference_number 	= $request['reference_number'];
		$truck->vin_number 			= $request['vin_number'];
		$truck->chassis_number 		= $request['chassis_number'];
		$truck->engine_number 		= $request['engine_number'];
		$truck->registration_year 	= $request['registration_year'];
		$truck->make 				= $request['make'];
	    $truck->model 				= $request['model'];
		$truck->colour 				= $request['colour'];
		$truck->speed_limit 		= $request['speed_limit'];
		$truck->date_inactive 		= $request['date_inactive'];
		$truck->created_by 			= \Auth::user()->id;
        $truck->save();
        \Session::flash('success', $request['make'].' Truck has been successfully updated!');
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
