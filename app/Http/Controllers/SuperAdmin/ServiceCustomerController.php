<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceCustomer;
use App\Models\Customer;
use App\Exports\ServiceCustomere;
use Maatwebsite\Excel\Facades\Excel;
class ServiceCustomerController extends Controller
{
    
    public function index(request $request){

       // return $request->user_id;

        $customers=Customer::orderBy('id','desc')
        ->where('name','!=','')->get();
        if($request->user_id){ 
             $srcustomers = ServiceCustomer::active()
            ->where('user_id',$request->user_id)
            ->paginate(10);
        }else if($request->type){ 
            $type=$request->type=='1'?'mobile':'name';            
            $srcustomers = ServiceCustomer::active()
            ->where($type,'LIKE','%'.$request->value.'%')
            ->paginate(10);
        } else{
            $srcustomers = ServiceCustomer::active()
            
            ->paginate(10);
        }

        return view('admin.ServiceCustomer.view',compact('srcustomers','customers'));
    }


   public function customers(request $request,$id){  
          if($request->id){
            $idx=$request->id;
          }else{
            $idx=$id;
          }
          $count=ServiceCustomer::where('user_id',$id)->count();                   
          if($request->type){ 
            $type=$request->type=='1'?'mobile':'name';            
            $srcustomerss = ServiceCustomer::active()
            ->where($type,'LIKE','%'.$request->value.'%')
            ->where('user_id',$id)
            ->paginate(10);
          } else{
            $srcustomerss=ServiceCustomer::active() 
            ->where('user_id',$id)
            ->paginate(10);    
          }      
         return view('admin.ServiceCustomer.srcustomers',['count'=>$count,'id'=>$idx],compact('srcustomerss'));
     }


     public function details($id){   
        // return $id;
         $details = ServiceCustomer::where('id',$id)
        ->first();       
       return view('admin.ServiceCustomer.details',['details'=>$details]);

     } 


     public function export(){ 
        return Excel::download(new ServiceCustomere, 'ServiceCustomer.xlsx');
     }



}
