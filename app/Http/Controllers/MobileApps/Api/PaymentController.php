<?php

namespace App\Http\Controllers\MobileApps\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Subscription;

class PaymentController extends Controller
{
    public function index(){     
        $user=auth()->guard('customerapi')->user();
        $payment = Payment::orderBy('id')
        ->where('userid',$user->id)
        ->where('status','Transaction Successful!')
        ->get();
        $data=[];
        $rowcount = count($payment); 
        if($rowcount>0){
         foreach($payment as $pay){
            $date=date_create($pay->created_at);
            $cdate=date_format($date,"d/m/Y");
            
            $edate=date_create($pay->expire_date);
            $eddate=date_format($edate,"d/m/Y");

            $data[]=array(                
                'id'=>$pay->id,
                'orderid'=>$pay->orderid,
                'userid'=>$pay->userid,      
                'subscriptionid'=>$pay->plan->title,   
                'amount'=>$pay->amount, 
                'status'=>$pay->status, 
                'SubscriptionDate'=>$cdate, 
                'enddate'=>$eddate,                   
             );

         } 

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



    public function store(Request $request){
        
        $duration=Subscription::findOrfail($request->subscriptionid);
        
             $time_now=mktime(date('h')+5,date('i')+30,date('s'));
             $order_date = date('Y-m-d', $time_now);

        $date=date_create($request->created_at);
        $subscribedate=date_format($date,"d/m/Y"); 
        $expiration = 30 * intval($duration->title); 
         $expiredate=date('Y-m-d',strtotime('+'.$expiration.' days',strtotime(str_replace('/', '-', $subscribedate))));
         
        $payment=Payment::create(array_merge(
        $request->only('userid','subscriptionid','amount','status','orderid'),
        [
            'expire_date'=>$expiredate,
            'created_at'=>$order_date
        ]
        ));

        if ($payment){
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


    }




    public function planstatuss(){
            
             $time_now=mktime(date('h')+5,date('i')+30,date('s'));
             $date = date('Y-m-d', $time_now);
          
          $user=auth()->guard('customerapi')->user(); 
          if($user){
          $subscribe=Payment::where('userid',$user->id)
          ->where('plan_status',1)
          ->first();
            
            
            
           // return $date." - ".$subscribe->expire_date;die;
            
         // $rowcount = count($subscribe); 
         if(!empty($subscribe)){
        
        if($subscribe->expire_date >= $date){   
            return [
                'status'=>'true',
                'message'=>'You Are Active'
            ];        
            
        }else{
            
            $Payment = Payment::where("userid", $user->id)
            ->where("plan_status",1)
            ->update(["plan_status" => 2]);  

            return [
                'status'=>'false',
                'message'=>'You Are Inactive'
            ]; 
             
        }}else{
            return [
                'status'=>'false',
                'message'=>'You Are Inactive'
            ]; 
        }
        
    }else{
        return [
            'status'=>'false',
            'message'=>'Login First'
        ];
    }

    }






}
