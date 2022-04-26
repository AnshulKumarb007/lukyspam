<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
//use App\Models\Customer;
class DashboardController extends Controller
{
    /**Barato
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(request $request)
    {
        
        if(isset($request->type)){            
            $type=$request->type==1?"mobile":'name';
            $customers=Customer::where($type,'LIKE',"%$request->value")             
            ->paginate(10);
        }else{
            //return "dd";die;
            $customers=Customer::paginate(10);
        }
        
        return view('admin.home',compact('customers'));
    }



    public function update_status($id,$statuss){        
        if($statuss==1){
            $statusss=2;
        }else{
            $statusss=1;
        }
        $status=Customer::findOrFail($id);        
        $status->isactive=$statusss;
        $status->update();

        return redirect()->back()->with('success','Status Updated Successfully');

    }




    public function details($id){
        $details=Customer::first();
        return view('admin.dcustomer',['details'=>$details]);
    }   








}
