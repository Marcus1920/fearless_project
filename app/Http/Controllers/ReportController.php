<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Charts;
use  App\User;
class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

     $chartssz =   Charts::multi('areaspline', 'highcharts')

    ->title('My nice chart')
    ->colors(['#ff0000', '#ffffff'])
    ->labels(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday','Saturday', 'Sunday'])
    ->dataset('John', [3, 4, 3, 5, 4, 10, 12])
    ->backgroundColor('red')
    ->dataset('Jane',  [1, 3, 4, 3, 3, 5, 4]);

      $chartss= Charts::create('geo', 'highcharts')
            ->title('Port Geo Cha')
            ->elementLabel('My nice label')
            ->labels(['AF', 'CONGO', 'RU'])
            ->colors(['#C5CAE9', '#283593'])

            ->values([5,10,20])
            ->dimensions(1000,500)
            ->responsive(true);
  //    $chart =   Charts::database(User::all(), 'bar', 'highcharts')
       $chart = Charts::database(User::all(), 'bar', 'highcharts')->dateColumn('created_at')
              //  $chart = Charts::multi('bar', 'highcharts')
              // Setup the chart settings
              ->title("Bar  Charts")
              // A dimension of 0 means it will take 100% of the space
              ->dimensions(0, 400) // Width x Height
              // This defines a preset of colors already done:)
              ->template("material")
              ->elementLabel("Total")
              ->dimensions(1000, 500)
              ->responsive(true)

             ->groupBy('administrative_area_level_1');

             $charts = Charts::database(User::all(), 'line', 'highcharts')->dateColumn('created_at')
                    //  $chart = Charts::multi('bar', 'highcharts')
                    // Setup the chart settings
                    ->title("Line Chart ")
                    // A dimension of 0 means it will take 100% of the space
                    ->dimensions(0, 400) // Width x Height
                    // This defines a preset of colors already done:)
                   ->template("material")
                    ->elementLabel("Total")
                    ->dimensions(1000, 500)
                    ->responsive(true)

                   ->groupBy('administrative_area_level_1');
            ///  ->labels(['One', 'Two', 'Three']);




     return view('Report.mainreport', ['chart' => $chart  ,'chartss' => $chartss  ,'chartssz' => $chartssz], ['charts' => $charts] );
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
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
