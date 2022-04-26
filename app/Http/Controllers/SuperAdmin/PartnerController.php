<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Document;
use App\Models\Partner;
use App\Models\PartnerJob;
use App\Models\Service;
use App\Models\ServiceCharge;
use App\Models\VisitCharge;
use App\Exports\CustomerExports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
class PartnerController extends Controller
{
    public function index(Request $request){
        $partners = Partner::paginate(10);
        return view('admin.partner.view',['partners'=>$partners]);
    }

    public function create(Request $request){
        $category=Category::whereNull('parent_id')->get();
        $carpenters=Category::where('parent_id',6)->get();
        return view('admin.partner.add',['category'=>$category,'carpenters'=>$carpenters]);
    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required',
            'mobile'=>'required',
            'experience'=>'required',
            'partner_type'=>'required',
            'job_profile_id'=>'required',
            'rating'=>'required',
            'status'=>'required',
            'residance'=>'required',
            'lat'=>'required',
            'lang'=>'required',
            'password'=>'required',
            'image'=>'image',
            'work_image'=>'image'
        ]);
        if($request->job_profile_id==6){
            $request->validate([
                'carpenter_id'=>'required'
            ]);
            $jobprofile=6;
        }else{
            $jobprofile= $request->job_profile_id;
        }

        if($partner=Partner::create([
            'name'=>$request->name,
            'mobile'=>$request->mobile,
            'experience'=>$request->experience,
            'partner_type'=>$request->partner_type,
            'job_profile_id'=>$jobprofile,
            'rating'=>$request->rating,
            'residance'=>$request->residance,
            'status'=>$request->status,
            'lat'=>$request->lat,
            'lang'=>$request->lang,
            'password'=> Hash::make($request->password),
          ]))

            if($request->job_profile_id==6){
//                $request->validate([
//                    'carpenter_id'=>'required|array'
//                ]);

                foreach($request->carpenter_id as $catid)
                    PartnerJob::create([
                        'category_id' => $catid,
                        'partner_id' => $partner->id,
                    ]);
            }else{
                $jobprofile= $request->job_profile_id;
                PartnerJob::create([
                    'category_id' => $jobprofile,
                    'partner_id' => $partner->id,
                ]);
            }

        {
            if($request->image) {
                $partner->saveImage($request->image, 'partner');
            }
            if($request->work_image) {
                $partner->saveWorkImage($request->work_image, 'work');
            }
            return redirect()->route('partner.list')->with('success', 'Partner has been created');
        }
        return redirect()->back()->with('error', 'Partner create failed');
    }

    public function edit(Request $request,$id){
        $partner = Partner::findOrFail($id);
        $category=Category::whereNull('parent_id')->get();
        $carpenters=Category::where('parent_id',6)->get();

        return view('admin.partner.edit',['partner'=>$partner,'category'=>$category,'carpenters'=>$carpenters]);
    }

    public function update(Request $request,$id){
        $request->validate([
            'name'=>'required',
            'mobile'=>'required',
            'experience'=>'required',
            'partner_type'=>'required',
            'job_profile_id'=>'required',
            'rating'=>'required',
            'status'=>'required',
            'residance'=>'required',
            'lat'=>'required',
            'lang'=>'required',
            'image'=>'image',
            'work_image'=>'image',
        ]);

        $partner = Partner::findOrFail($id);
        if($request->job_profile_id==6){
            $request->validate([
                'carpenter_id'=>'required'
            ]);
            $jobprofile=6;
        }else{
            $jobprofile= $request->job_profile_id;
        }

        if($partner->update([
            'name'=>$request->name,
            'experience'=>$request->experience,
            'partner_type'=>$request->partner_type,
            'job_profile_id'=>$request->job_profile_id,
            'rating'=>$request->rating,
            'residance'=>$request->residance,
            'status'=>$request->status,
            'lat'=>$request->lat,
            'lang'=>$request->lang,
            'password'=>!empty($request->password)?Hash::make($request->password):$partner->password
        ])){
            PartnerJob::where('partner_id',$partner->id)->delete();

            if($request->job_profile_id==6){

                foreach($request->carpenter_id as $catid)
                    PartnerJob::create([
                        'category_id' => $catid,
                        'partner_id' => $partner->id,
                    ]);
            }else{
                $jobprofile= $request->job_profile_id;
                PartnerJob::create([
                    'category_id' => $jobprofile,
                    'partner_id' => $partner->id,
                ]);
            }

            if($request->image) {
                $partner->saveImage($request->image, 'partner');
            }
            if($request->work_image) {
                $partner->saveWorkImage($request->work_image, 'work');
            }
            return redirect()->route('partner.list')->with('success', 'Partner has been updated');
        }
        return redirect()->back()->with('error', 'Partner update failed');
    }

    public function details(Request $request,$id){
        $partner = Partner::findOrFail($id);

        return view('admin.partner.details',['partner'=>$partner]);

    }

    public function service(Request $request ,$jobprofile_id,$partner_id ){
        $datas=Category::where('parent_id',$jobprofile_id)->get();
        if($datas->count()>0){
          //  $datas=Category::where('id',$jobprofile_id)->where('flag',0)->first();
            return view('admin.partner.services',['datas'=>$datas,'partner_id'=>$partner_id]);

        }else{
            return redirect()->route('partner.visit',['id'=>$jobprofile_id,'partner_id'=>$partner_id]);
        }

    }

    public function visit(Request $request,$id,$partner_id){
      //return $partner_id;
        $datas=Category::findOrFail($id);
        $services = Service::active()->with(['servicecharge'=>function($services)use($id,$partner_id){
            $services->where('cat_id',$id)->where('partner_id',$partner_id);
       }])->where('category_id',$id)->get();
// $services[0]->servicecharge[0]->installation;
        $visitcharge = VisitCharge::where('partner_id', $request->partner_id)
            ->where('cat_id', $id)->first();
       /* $servicecharge= ServiceCharge::where('service_id',)->where('partner_id',$partner_id)->where('cat_id',$id)->get();*/

        return view('admin.partner.visit-charge',['datas'=>$datas,'partner_id'=>$partner_id,'services'=>$services,'visitcharge'=>$visitcharge]);

    }

    public function visitStore(Request $request,$id)
    {
        $request->validate([
            'partner_id' => 'required',
        ]);

        $visitscheck = VisitCharge::where('partner_id', $request->partner_id)
            ->where('cat_id', $id)->first();

        if (!$visitscheck){
            //createquery
            $visits = VisitCharge::create([
                'visit_charge' => $request->visit_charge ?? 0,
                'area_charge' => $request->area_charge ?? 0,
                'cat_id' => $id,
                'partner_id' => $request->partner_id,
            ]);
        }else{
            //updatequery
            $visits=$visitscheck->update([
                    'visit_charge' => $request->visit_charge ?? 0,
                    'area_charge' => $request->area_charge ?? 0,
            ]);
        }
        if($visits)
        {
            return redirect()->back()->with('success', 'Visit Charge has been updated');
        }
        return redirect()->back()->with('error', 'Visit Charge update failed');
    }

    public function serviceCharge(Request $request){
        $request->validate([
            'service_id' => 'required',
        ]);

        $servicecharge= ServiceCharge::where('service_id',$request->service_id)->where('partner_id',$request->partner_id)->first();

        if (!$servicecharge){
            //createquery
            $visits = ServiceCharge::create([
                'partner_id' => $request->partner_id ?? 0,
                'service_id' => $request->service_id ?? 0,
                'cat_id' => $request->cat_id ?? 0,
                'installation' => $request->instcharg ?? 0,
                'repair' => $request->repair ?? 0,
                'uninstallation' => $request->uninstallation ?? 0,
            ]);
        }else{
            //updatequery
            $visits=$servicecharge->update([
                'installation' => $request->instcharg ?? 0,
                'repair' => $request->repair ?? 0,
                'uninstallation' => $request->uninstallation ?? 0,
            ]);
        }
        if($visits)
        {
            return redirect()->back()->with('success', 'Service Charge has been updated');
        }
        return redirect()->back()->with('error', 'Service Charge update failed');
    }

    public function document(Request $request,$id){
        $partner=Partner::findOrFail($id);

        if(!empty($request->document)){

            $request->validate([
                'document'=>'array',
                'document.*'=>'required|image'
            ]);

            foreach($request->document as $file){

                $partner->saveDocument($file, 'partner');
            }
        }
        return redirect()->back()->with('success', 'Images have been uploaded');
    }

    public function deleteDocument(Request $request,$id){
        Document::where('id',$id)->delete();
        return redirect()->back()->with('success', 'Document has been deleted');
    }





    public function exports(){
        return Excel::download(new CustomerExports, 'Partner.xlsx');
    }










}
