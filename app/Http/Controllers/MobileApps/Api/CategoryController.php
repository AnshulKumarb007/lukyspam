<?php

namespace App\Http\Controllers\MobileApps\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $user=auth()->guard('customerapi')->user();
        $categories=Category::active()->whereNull('parent_id')->get();
        $user=[
            'name'=>$user->name??'Guest',
            'image'=>$user->image??'',
            'mobile'=>$user->mobile??''
        ];
        if($categories->count()>0){
            return [
                'status'=>'success',
                'message'=>'success',
                'data'=>compact('categories','user')
            ];
        }else{
            return [
                'status'=>'failed',
                'message'=>'No Record Found'
            ];
        }

    }

    public  function subcategory(Request $request,$id){
        $category=Category::active()->where("id",$id)->select('image','name')->first();
        $subcategories=Category::active()->where('parent_id',$id)->get();
        if($subcategories->count()>0){
            return [
                'status'=>'success',
                'message'=>'success',
                'name'=>$category->name,
                'image'=>$category->image,
                'unit_type'=>$category->unit_type??'',
                'data'=>compact('subcategories')
            ];
        }else{
            return [
                'status'=>'failed',
                'message'=>'No Record Found'
            ];
        }
    }

    public  function search(Request $request,$search){
       /* $category=Category::active()->where("name",'LIKE','%'.$search.'%')->select('image','name')->first();*/
        $search_data=Category::active()->where("name",'LIKE','%'.$search.'%')->whereNotNull('parent_id')->get();
        if($search_data->count()>0){
            return [
                'status'=>'success',
                'message'=>'success',
               /* 'name'=>$category->name,
                'image'=>$category->image,
                'unit_type'=>$category->unit_type??'',*/
                'data'=>compact('search_data')
            ];
        }else{
            return [
                'status'=>'failed',
                'message'=>'No Record Found'
            ];
        }
    }
}
