<?php

namespace App\Http\Controllers\MobileApps\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        
        $services =Service::where('isactive',1)->get();

        if ($services->count() > 0) {
            return [
                'status' => 'true',
                'message' => 'success',
                'data' => compact('services'),
            ];
        } else {

            return [
                'status' => 'false',
                'message' => 'No Record Found',
                'data' => '',
            ];
        }


    }
}
