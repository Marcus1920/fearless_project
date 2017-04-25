<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comments  ;
use Illuminate\Support\Facades\Input;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

if(isset($_POST["view"]))
{

  if($_POST["view"] != '')
   {
      $Comments  = Comments::where ('comment_status'  , '=' , 0 )->first();
      $Comments->comment_status = 1;
      $Comments ->save() ;

   }

$quety   = Comments::all();


$output = '' ;

}

    if ($quety ) {


foreach ($quety as $quety ) {
  $output .= '
    <li>
     <a href="#">
      <strong>'.$quety->comment_subject.'</strong><br />
      <small><em>'.$quety->comment_text.'</em></small>
     </a>
    </li>
    <li class="divider"></li>
    ';
}
    }

    else {

    $output .= '<li><a href="#" class="text-bold text-italic">No Notification Found</a></li>';

    }

    $Querry_1  = Comments::where('comment_status' , '=' , 0)->get() ;
    $count   = $Querry_1->count();
    $data = array(
  'notification'   => $output,
  'unseen_notification' => $count
 );
 echo json_encode($data);



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


      if(isset($_POST["subject"]))
      {
   $Comments   = new  Comments () ;
   $subject    = Input::get('subject') ;
   $comment    =Input ::get('comment') ;

   $Comments->comment_subject   = $subject;
   $Comments->comment_text   = $comment;
   $Comments->comment_status   = 0;


   $Comments ->save() ;


      }

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
