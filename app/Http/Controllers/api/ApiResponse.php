<?php
namespace App\Http\Controllers\api;
trait ApiResponse
{
    public function apiresponse($data = null , $status = null,$mes=null)
    {
        $array = [
            'data'=>$data ,
            'status'=> $status,
            'message'=>$mes
    
          ];
          return response($array);

    }
}


