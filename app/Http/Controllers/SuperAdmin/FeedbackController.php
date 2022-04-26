<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index(Request $request){
        $feedbacks = Feedback::paginate(20);
        return view('admin.feedback.view',['feedbacks'=>$feedbacks]);
    }

    public function delete(Request $request,$id){
        Feedback::where('id',$id)->delete();
        return redirect()->back()->with('success','feedback has been deleted');
    }
}
