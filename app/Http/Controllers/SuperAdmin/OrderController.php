<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request){
        $orders = Order::where('status','!=','Pending')
            ->OrderBy('id','DESC')
            ->paginate(10);
        return view('admin.order.view',['orders'=>$orders]);
    }


    public function details(Request $request,$id){
        $orderdetails = OrderDetail::where('order_id',$id)->get();
        return view('admin.order.details',['orderdetails'=>$orderdetails]);
    }

    public function image(Request $request,$id){
        $orderimage = OrderDetail::findOrFail($id);
        return view('admin.order.image',['orderimage'=>$orderimage]);

    }
}
