<?php

namespace App\Http\Controllers\MobileApps\Api;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\HomeSection;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    public function index(){
        $user = auth()->guard('customerapi')->user();
        if($user->isactive !=1){
             return [
               'status'=>'failed',
               'message'=>'You are inactive please contact to admin'
           ];
        }
        $banners= Banner::active()->where('type',2)->get();
        $categories=Category::active()->get();
        $secondbanner= Banner::active()->where('type',3)->get();
        $user=[
            'name'=>$user->name??'Gest',
            'image'=>$user->image??'',
            'mobile'=>$user->mobile??''
        ];
        $home_sections=HomeSection::active()
            ->with('entities.entity')
            ->orderBy('sequence_no', 'asc')
            ->get();

        foreach($home_sections as $section){
            $new_sec=[];
            switch($section->type){
                case 'banner':
                    $new_sec['type']='banner';
                    $new_sec['title']='';
                    $new_sec['name']='';
                    $new_sec['bannerdata']=[
                        'image'=>$section->entities[0]->entity->image??'',
                        'category_id'=>$section->entities[0]->entity->parent_category??'',
                        'subcategory_id'=>$section->entities[0]->entity->entity_id??'',
                    ];
                    $new_sec['products']=[];
                    $new_sec['subcategory']=[];
                    break;
                case 'product':
                    $new_sec['type']='product';
                    $new_sec['name']=$section->name;
                    $new_sec['bannerdata']=[
                        'image'=>'',
                        'category_id'=>'',
                        'subcategory_id'=>'',
                    ];
                    $new_sec['subcategory']=[];
                    $new_sec['products']=[];
                    foreach($section->entities as $entity){
                        if(isset($products[$entity->entity_id])){
                            $entity1=$entity->entity;
                            $entity1->sizeprice=$products[$entity->entity_id]['sizeprice']??[];
                            $entity1->ratings=number_format($products[$entity->entity_id]['ratings']??0, 1);
                            $entity1->reviews=$products[$entity->entity_id]['reviews']??0;
                            $new_sec['products'][]=$entity1;
                        }
                    }
                    break;
                case 'subcategory':
                    $new_sec['type']='subcategory';
                    $new_sec['name']=$section->name;
                    $new_sec['products']=[];
                    $new_sec['bannerdata']=[
                        'image'=>'',
                        'category_id'=>'',
                        'subcategory_id'=>'',
                    ];
                    $new_sec['subcategory']=[];
                    foreach($section->entities as $entity){
                        $new_sec['subcategory'][]=[
                            'categoryname'=>$entity->name,
                            'categoryimage'=>$entity->image,
                            'subcategory_id'=>$entity->entity_id,
                            'category_id'=>$entity->parent_category,
                        ];
                    }
                    break;
            }

            $sections[]=$new_sec;

        }

       if($banners->count()>0 || $categories->count()>0){
           return [
               'status'=>'success',
               'message'=>'success',
               'data'=>compact('banners','categories','secondbanner','user')
           ];
       }else{
           return [
               'status'=>'failed',
               'message'=>'No Record Found'
           ];
       }

    }

    //login page banner api
    public function login_Banner(){

        $banners= Banner::active()->where('type',1)->get();
        return [
            'status'=>'success',
            'message'=>'success',
            'data'=>compact('banners')
        ];
    }
}
