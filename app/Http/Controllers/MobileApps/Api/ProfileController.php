<?php

namespace App\Http\Controllers\MobileApps\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Wallet;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(){
        $user=auth()->guard('customerapi')->user();

        if(!$user){
            return [
                'status'=>'failed',
                'message'=>'Please Login to Continue..',
            ];
        }
        $userdata=array(
            'id'=>$user->id,
            'name'=>$user->name,
            'email'=>$user->email,
            'mobile'=>$user->mobile,
            'address'=>$user->address,
            'company_name'=>$user->company_name,
            'bank_name'=>$user->bank_name,
            'bank_address'=>$user->bank_address,
            'ifsc_code'=>$user->ifsc_code,
            'account_no'=>$user->account_no,
        );

        return [
            'status'=>'success',
            'message'=>'success',
            'data'=>$userdata,
        ];
    }
    public function update(Request $request){
        $user=auth()->guard('customerapi')->user();

        
        if(!$user){
            return [
                'status'=>'failed',
                'message'=>'Please Login to Continue..',
            ];
        }
        $request->validate([
            'name'=>'string',
            'email'=>'string',
            'company_name'=>'string',
            'address'=>'string',
            'state'=>'string'
        ]);

       /* $customer=Customer::where('mobile', $request->mobile)->orWhere('email', $request->email)->first();
        if($customer){

        }else{
            $user->email=$request->email;
        }
        $user->name=$request->name;
        if($request->image){
            $user->saveImage($request->image, 'customers');
        }*/
        
        $user=$user->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'company_name'=>$request->company_name,
            'address'=>$request->address,
            'state'=>$request->state,
            'gst'=>$request->gst
        ]);

         
        if($user){
            return [
                'status'=>'success',
                'message'=>'Profile Updated Successfully',
            ];
        }else{
            return [
                'status'=>'failed',
                'message'=>'Profile Not Update',
            ];
        }

    }
    public function bankdetails_update(Request $request){

        $request->validate([
            'bank_name'=>'string|required',
            'bank_address'=>'string|required',
            'ifsc_code'=>'string|required',
            'account_no'=>'string|required',
        ]);
        $user=auth()->guard('customerapi')->user();
        if(!$user){
            return [
                'status'=>'failed',
                'message'=>'Please Login to Continue..',
            ];
        }

        $user=$user->update([
            'bank_name'=>$request->bank_name,
            'bank_address'=>$request->bank_address,
            'ifsc_code'=>$request->ifsc_code,
            'account_no'=>$request->account_no,
        ]);
        if($user){
            return [
                'status'=>'success',
                'message'=>'Profile Updated Successfully',
            ];
        }else{
            return [
                'status'=>'failed',
                'message'=>'Profile Not Update',
            ];
        }

    }
    
    
    
    public function viewprofiles(){
        $user=auth()->guard('customerapi')->user();
        $customer=Customer::where("id",$user->id)->first();

        if(!empty($customer)){
            return [
                'status'=>'success',
                'message'=>'success',
                "data"=>$customer
            ];
        }else{

            return [
                'status'=>'fail',
                'message'=>'data Not Found',
                //"data"=>$customer
            ];
 
        }
 
    }
    
    
    
    
      public function updatedetails(Request $request){ 
             
             $user=auth()->guard('customerapi')->user(); 
            if(!$user){
                return [
                    'status'=>'failed',
                    'message'=>'Please Login to Continue..',
                ];
            }
            //return $request.$i;
              $data = Customer::where("id", $user->id)
              ->update([              
                "name"=>$request->name  ?? "0"  ,
                "company_name"=>$request->company_name  ?? "0"  ,
                "email"=>$request->email  ?? "0"  ,
                "address"=>$request->address  ?? "0"  ,
                "state"=>$request->state  ?? "0"  ,
                "gst"=>$request->gst   ?? "0",
               
            ]);
              if(!empty($data)){
                  return [
                      'status'=>'true',
                      'message'=>'successfully Update Successfully',
                      //'data'=>$data
                  ];
      
              }else{
                  return [
                      'status'=>'false',
                      'message'=>'false',
                      //'data'=>''
                  ];
      
              }
          }   
    

}
