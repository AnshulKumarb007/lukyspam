<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
class SubscribeController extends Controller
{
    public function index(){
        $subscribe=Payment::orderBy("id","desc")->paginate(10);
        //return $subscribe; die;
        return view('admin.Subscribe.view',compact('subscribe'));
    }
}
