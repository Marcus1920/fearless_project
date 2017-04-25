<?php

namespace App\Http\Controllers\v1;

use App\Services\CaseResponderService;
use App\Services\v1\CaseService;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\GateTrackRequest;


class ApiController extends Controller
{

    protected $cases;
    protected $case_responders;

    public function __construct(CaseService $service,CaseResponderService $responder_service) {

        $this->cases = $service;
        $this->case_responders = $responder_service;
        $this->middleware('auth.token',['only' => ['store']]);
    }


    public function index()
    {
        $data = $this->cases->getCases();
        return response()->json($data);
    }



    public function store(GateTrackRequest $request)
    {
        $case = $this->cases->createCase($request);
        return response()->json($case,201);

    }



}
