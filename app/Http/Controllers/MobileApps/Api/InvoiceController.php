<?php

namespace App\Http\Controllers\MobileApps\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;
class InvoiceController extends Controller
{
    public function store(Request $request){
        
        $user=auth()->guard('customerapi')->user();
        if($user){
             // $inv=Invoice::where('orderid',$request->orderid)->where('loginuserid',$user->id)->where('userid',$request->userid)->count();
            
            //if($inv>0){
                 //return [
                    //    'status'=>'false',
                    //    'message'=>'orderid created failed'
                   // ];
            //}else{ 
                
                $data = Invoice::create(array_merge(
                $request->only('userid','productname','qty','orderid','amount','gst_per'),
                ['loginuserid'=>$user->id]
            ));
             if($data){      
                    return [
                        'status'=>'true',
                        'message'=>'data created successfully'
                    ];
                }else{
                    return [
                        'status'=>'false',
                        'message'=>'data created failed'
                    ];
                }
           // }
            
           }else{
            return [
                'status'=>'faild',
                'message'=>'Login First'
                //''=>'',
            ];
        }


    }
}
