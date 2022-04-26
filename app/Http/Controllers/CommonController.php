<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommonController extends Controller
{
    
    public function privacy(){
        return view('privacy');
    }
    public function term(){
        return view('term');
    }
}
