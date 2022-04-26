<?php

namespace App\Http\Controllers\MobileApps\Api;

use App\Http\Controllers\Controller;
use App\Models\DaysFilter;
use App\Models\Service;
use App\Models\ServiceCustomer;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Services\SMS\Msg91;
use App\Models\Invoice;
use PDF;
class ServiceCustomerController extends Controller
{
    public function index(Request $request){
         $user=auth()->guard('customerapi')->user();
          $invcount=ServiceCustomer::where('invoiceno',$request->invoiceno)
        ->where('user_id',$user->id)
        ->count();
        
        if($invcount > 0 AND $request->service_id==5){
            return [
                'status'=>'false',
                'message'=>'invoice Number allready exist!',
                //'data'=>''
            ];
        }else{
       
          date_default_timezone_set("Asia/Kolkata");
          $cureentdate=date("Y-m-d"); 
         // echo $cureentdate;die;
        //  $user=auth()->guard('customerapi')->user();
           $data = ServiceCustomer::create(array_merge($request->only('name','mobile','type','description','service_id','subscription_id','service_date','gst_no','address','amount','quantity','gst_per','product_name','contact_person','remarks','numberofmembrane',
         'outletwaterconditon','rawwatercondition','NumberOfMachine','model','company_namea','invoiceno'
        ),['user_id'=>$user->id??'','currentdate'=>$cureentdate])); 

          if ($data){                    
          $amount=$request->amount;
          if($request->service_id==1){
              $dltid=env('Salestext_dltid');//get dlt id from env file
              $msg=str_replace('{{var}}', $amount, config('sms-templates.Salestext'));
               Msg91::send($request->mobile, $msg,$dltid);
          }else if($request->service_id==2){
              $dltid=env('Servicetext_dltid');//get dlt id from env file
              $msg=str_replace('{{var}}', $amount, config('sms-templates.Servicetext'));
              Msg91::send($request->mobile, $msg,$dltid);
          }else if($request->service_id==3){
              $dltid=env('Installation_dltid');//get dlt id from env file
              $msg=str_replace('{{var}}', $amount, config('sms-templates.Installation'));
               Msg91::send($request->mobile, $msg,$dltid);
          }else if($request->service_id==4){
              $dltid=env('Amcmaintenancetext_dltid');//get dlt id from env file
              $msg=str_replace('{{var}}', $amount, config('sms-templates.Amcmaintenancetext'));
               Msg91::send($request->mobile, $msg,$dltid);
          }
              
             $datax=['invoiceno'=>$data->invoiceno,'userid'=>$data->id];
              return [
                  'status'=>'true',
                  'message'=>'data created successfully',
                  'data'=>$datax
              ];
          }else{
              return [
                  'status'=>'false',
                  'message'=>'data created failed',
                  'data'=>''
              ];
          }

        }
      }
  

 
    
  
     
    public function history(Request $request){

        $user=auth()->guard('customerapi')->user();

     $servicecustomer = ServiceCustomer::where('user_id',$user->id??'')
     ->whereNotIn("service_id",[5,6,7,8,9]);
     
        if($request->search){
            $search=$request->search;
            $service =Service::where('title','like','%'.$search.'%')->first();
            if($service){
                $servicecustomer = $servicecustomer->where(function($query) use ($service) {
                $query->where('service_id','like','%'.$service->id.'%');
                });
            }else{
                $servicecustomer = $servicecustomer->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%')->orwhere('mobile', 'like', '%' . $search . '%')->orwhere('type', 'like', '%' . $search . '%');
                });
            }
        }

        if($request->days){

        if (strpos($request->days, 'Day') !== false) {
            $todate = date('Y-m-d H:i:s' ,strtotime('-'.$request->days,strtotime(date('Y-m-d H:i:s'))));
        }elseif (strpos($request->days, 'Month') !== false){
            $todate = date('Y-m-d H:i:s' ,strtotime('-'.$request->days,strtotime(date('Y-m-d H:i:s'))));
        }else{
            $todate = date('Y-m-d H:i:s' ,strtotime('-'.$request->days,strtotime(date('Y-m-d H:i:s'))));
        }
            $servicecustomer = $servicecustomer->whereDate('created_at','<=', date('Y-m-d H:i:s'))
                ->whereDate('created_at','>=', $todate);
        }
        $servicecustomer = $servicecustomer->get();
        if ($servicecustomer){
            return [
                'status'=>'true',
                'message'=>'success',
                'data'=>compact('servicecustomer')
            ];
        }else{
            return [
                'status'=>'false',
                'message'=>'No record found'
            ];
        }
    }

    public function days_filter(Request $request){
        $filter = DaysFilter::orderBy('id','ASC')->get();
        if($filter){
            return [
                'status'=>'true',
                'message'=>'success',
                'data'=>compact('filter')
            ];
        }else{
            return [
                'status'=>'false',
                'message'=>'No record found'
            ];
        }
    }

    public function createPDF(Request $request,$bookid,$userid,$invoiceno) {
        //return $userid;die;
         // $user = auth()->guard('customerapi')->user();
          $profile = Customer::find($userid);
          $userdata= ServiceCustomer::where('id',$bookid)->where('invoiceno',$invoiceno)->first();  
         //  return  $userdata;
        // retreive all records from db
           $data = ServiceCustomer::select('services_customer.*','invoice.amount as amt','invoice.qty as qty','invoice.productname as pname','invoice.gst_per as gst')
          ->join('invoice', 'services_customer.id', '=', 'invoice.userid')
          ->where('invoice.orderid',$invoiceno)
          ->where('loginuserid',$userid)
          ->get();  
            
         // return $data;
        // share data to view
       /* $data = [
            'title' => 'First PDF ',
            'heading' => 'Hello Bro',
            'content' => 'Data content'
        ];*/
       // return $data;
      // return view('invoice',compact('data','profile','userdata'));die;
        $pdf = PDF::loadView('invoice', array('data'=>$data,'profile'=>$profile,'userdata'=>$userdata));
        return $pdf->download($userdata->name.'.pdf');
    }
 
    public function createCard(Request $request,$bookid,$userid) {
        //return $userid;die;
         // $user = auth()->guard('customerapi')->user();
          $profile = Customer::find($userid);
        

        // retreive all records from db
          $data = ServiceCustomer::find($bookid);

        $gstamount= (($data->amount *$data->quantity) * $data->gst_per)/100;
        if($data){
            $data->gstamount=$gstamount;
            $totalamount = ($data->amount*$data->quantity) + $gstamount;
            $data->total = $totalamount;
        }
        // share data to view
       /* $data = [
            'title' => 'First PDF ',
            'heading' => 'Hello Bro',
            'content' => 'Data content'
        ];*/
       // return $data;
       // return view('warrentyCard',compact('data','profile'));die;
        $pdf = PDF::loadView('warrentyCard', array('data'=>$data,'profile'=>$profile));
        return $pdf->download($data->name.'.pdf');;
    }




    public function service_customerlist($serviceid){
    $user=auth()->guard('customerapi')->user();
    $servicecustomer = ServiceCustomer::orderBy('id','DESC')
                       ->where('user_id',$user->id)
                       ->where('service_id',$serviceid)
                       ->get();  
                       $rowcount = $servicecustomer->count();               
      if($rowcount>0){
        $data=[];
        foreach($servicecustomer as $src){
            if($src->service_id==6){
                $url="warranty-card/{$src->id}/{$user->id}";
            }else{
                $url="invoice-download/{$src->id}/{$user->id}/{$src->invoiceno}";
            }
            $data[]=array(
                'id'=>$src->id,
                'name'=>$src->name,
                'mobile'=>$src->mobile,
                'amount'=>$src->amount,
                'description'=>$src->description,
                'link'=>url("api/$url")                
            );
        }  
        return [
                'status'=>'true',
                'message'=>'success',
                'data'=>$data
            ];

      } else{

            return [
                'status'=>'false',
                'message'=>'No Record Found',
                'data'=> ' '
            ];
      }           
    }

 
    // public function pdfGenerator($id){
    //     $data=ServiceCustomer::find($id);
    //     $pdf = PDF::loadView('recipt', array('data'=>$data));
    //    // return view('recipt',compact('pdf'));
    //    // return $pdf->download($data->name.'.pdf');
    // }


 public function viewdetailss($id){
          //  $user=auth()->guard('customerapi')->user();
            $data = ServiceCustomer::findOrfail($id);
            if(!empty($data)){
                return [
                    'status'=>'true',
                    'message'=>'success',
                    'data'=>$data
                ];
    
            }else{
                return [
                    'status'=>'false',
                    'message'=>'false',
                    'data'=>''
                ];
    
            }
        }
        
        
 public function deleteviewdetailss($id){
            //  $user=auth()->guard('customerapi')->user();
              $data = ServiceCustomer::find($id)->delete();
              if(!empty($data)){
                  return [
                      'status'=>'true',
                      'message'=>'successfully Deleted',
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
        
        
    
    
    public function updatedetails(Request $request){ 
            
              $data = ServiceCustomer::where("id", $request->id)
              ->update([              
                "name"=>$request->name  ?? "0"  ,
                "mobile"=>$request->mobile  ?? "0"  ,
                "type"=>$request->type  ?? "0"  ,
                "description"=>$request->description  ?? "0"  ,
                "service_id"=>$request->service_id  ?? "0"  ,
                "subscription_id"=>$request->subscription_id  ?? "0"  ,
                "service_date"=>$request->service_date,
                "gst_no"=>$request->gst_no  ?? "0"  ,
                "address"=>$request->address  ?? "0"  ,
                "amount"=>$request->amount  ?? "0"  ,
                "quantity"=>$request->quantity  ?? "0"  ,
                "gst_per"=>$request->gst_per  ?? "0"  ,
                "product_name"=>$request->product_name  ?? "0"  
            ]);
              if(!empty($data)){
                 $amount =$request->amount;
               $dltid=env('Servicetext_dltid');//get dlt id from env file
               $msg=str_replace('{{var}}', $amount, config('sms-templates.Servicetext'));
               Msg91::send($request->mobile, $msg,$dltid);
                  
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


          public function listbyinvoice($invno){
                $data=Invoice::where("orderid",$invno)->get();
                if(!empty($data)){ 
                    return [
                        'status'=>'true',
                        'message'=>'successfully',
                        'data'=>$data
                    ];
        
                }else{
                    return [
                        'status'=>'false',
                        'message'=>'false',
                        'data'=>''
                    ];
        
                }
          }


          public function invdelete($id){
            //  $user=auth()->guard('customerapi')->user();
              $data = Invoice::find($id)->delete();
              if(!empty($data)){
                  return [
                      'status'=>'true',
                      'message'=>'successfully Deleted',
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




          public function shistory(Request $request){
         $user=auth()->guard('customerapi')->user();
         $servicecustomer = ServiceCustomer::where('user_id',$user->id??'')
         ->whereNotIn("service_id",[5,6,7,8,9]); 
            //if($request->days){
                 $request->days="7 Day"; 
            if (strpos($request->days, 'Day') !== false) {                
                 $todate = date('Y-m-d' ,strtotime('+'.$request->days,strtotime(date('Y-m-d'))));
            }elseif (strpos($request->days, 'Month') !== false){
              //  echo "dddddssaass";
                $todate = date('Y-m-d' ,strtotime('-'.$request->days,strtotime(date('Y-m-d'))));
            }else{
               // echo "dddddss";
                $todate = date('Y-m-d' ,strtotime('-'.$request->days,strtotime(date('Y-m-d'))));
            }
               // $cdate=date('Y-m-d');
              //  $servicecustomer = $servicecustomer->whereDate('service_date','<=',$todate)
                 //   ->whereDate('service_date','>', date('Y-m-d'));
                 $servicecustomer = $servicecustomer->whereBetween('service_date', [date('Y-m-d'), $todate]);

                
            //}           
            $servicecustomer = $servicecustomer->get();
            //return $servicecustomer;die;
            if ($servicecustomer){
                return [
                    'status'=>'true',
                    'message'=>'success',
                    'data'=>compact('servicecustomer')
                ];
            }else{
                return [
                    'status'=>'false',
                    'message'=>'No record found'
                ];
            }
        }





}






          