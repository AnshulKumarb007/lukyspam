<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function index(Request $request){
        $ratings = Rating::paginate(20);
        return view('admin.rating.view',['ratings'=>$ratings]);
    }
}
