<?php

namespace App\Http\Controllers\MobileApps\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GenrateorderidController extends Controller
{
    

    public function index(){
        $user = auth()->guard('customerapi')->user();
         $orderid=date('mdis').rand(10000000,99999999);
        if($user){
            
            $data =[
                'userid' =>$user->id,
                'orderid' =>$orderid
            ];
            return [
                'status'=>'success',
                'message'=>'success',
                'data'=>$data
            ];
        }else{

            return [
                'status'=>'faild',
                'message'=>'no record found',
                'data'=>''
            ];

        }





    }







}
