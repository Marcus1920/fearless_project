<?php
/**
 * Created by PhpStorm.
 * User: Ngobese
 * Date: 10-Apr-17
 * Time: 13:45
 */

namespace App;
use App\ResponderCase;
use App\Responderusers;

class table
{
  function table(){
      $i=0;
      $case = ResponderCase::all();
            $case_table='';
           foreach ($case as $each){
               $i++;
               $name=$each->name;
               $created=$each->created_by;
               $updated=$each->updated_by;
               $created_at=$each->created_at->diffForHumans();;
               $updated_at=$each->updated_at->diffForHumans();
               $ceate_case=Responderusers::where("id",$created)->take(1)->get();
               foreach ( $ceate_case as $case_name){
                   $get_name=$case_name->name;
               }
               $updated_by_case=Responderusers::where("id",$updated)->take(1)->get();
               foreach ( $updated_by_case as $updated_by){
                   $update_name=$updated_by->name;
               }

               $case_table .=$name."|".$get_name."|".$update_name."|".$created_at."|".$updated_at;
               echo "
        <tr>
        <td>$i</td>
         <td>$name</td>
          <td>$get_name</td>
           <td>$update_name</td>
            <td>$created_at</td>
             <td>$updated_at</td>
            </tr>
        ";
           }

  }
}