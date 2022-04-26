<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
        //service
    public function services(Request $request ,$id){
        $datas=Service::where('category_id',$id)->get();
        return view('admin.category.services',['datas'=>$datas]);

    }

    public function serviceedit(Request $request,$id){
        $data = Service::findOrFail($id);
        return view('admin.category.service_edit',['data'=>$data]);
    }

    public function serviceupdate(Request $request,$id){
        $request->validate([
            'isactive'=>'required',
            'name'=>'required',
            'image'=>'image'
        ]);
        $data = Service::findOrFail($id);

        $data->update($request->only('name','isactive'));
        if($request->image){
            $data->saveImage($request->image, 'services');
        }
        if($data)
        {
            return redirect()->route('category.service.list',['id'=>$data->category_id])->with('success', 'Data has been updated');
        }
        return redirect()->back()->with('error', 'Data update failed');

    }

}
