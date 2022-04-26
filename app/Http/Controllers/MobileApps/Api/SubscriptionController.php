<?php

namespace App\Http\Controllers\MobileApps\Api;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index(){
        $user = auth()->guard('customerapi')->user();
        if($user->isactive !=1){
             return [
               'status'=>'failed',
               'message'=>'You are inactive please contact to admin'
           ];
        }
        $banners = Banner::where('isactive',1)->get();
        $subscriptions = Subscription::where('isactive',1)->get();
        return [
            'status'=>'true',
            'message'=>'success',
            'data'=>compact('banners','subscriptions')
        ];
    }
}
