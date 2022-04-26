<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UrlController extends Controller
{
    public function privacy(Request  $request){

        return view('admin.url.privacy-policy');
    }

    public function about(Request  $request){

        return view('admin.url.about');
    }

    public function termscond(Request  $request){

        return view('admin.url.terms-condition');
    }

}
