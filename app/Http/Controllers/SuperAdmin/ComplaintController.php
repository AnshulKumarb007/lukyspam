<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerComplaint;
use App\Models\Order;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function index(Request $request){
        $complaints =CustomerComplaint::with(['order','partner','customer'])->paginate(20);
        return view('admin.complaint.view',['complaints'=>$complaints]);
    }

    public function sendForm(Request $request,$id){
        $sendComplaint = CustomerComplaint::findOrFail($id);
        return view('admin.complaint.send',['sendComplaint'=>$sendComplaint]);
    }

    public function sendMessage(Request $request,$id){
        $request->validate([
            'message'=>'required',
        ]);

        $sendComplaint = CustomerComplaint::findOrFail($id);

        if($sendComplaint = CustomerComplaint::create([
            'order_id'=>$sendComplaint->order_id,
            'user_id'=>$sendComplaint->user_id,
            'partner_id'=>$sendComplaint->partner_id,
            'title'=>$sendComplaint->title,
            'message'=>$request->message,
            'type'=>'ADMIN'
        ])){
            return redirect()->route('complaint.list')->with('success','Message has been created');
        }
        return redirect()->back()->with('error','message create failed');
    }

}
