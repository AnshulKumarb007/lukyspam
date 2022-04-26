<?php

namespace App\Http\Controllers\MobileApps\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Partner;
use App\Models\PartnerJob;
use App\Models\Rating;
use App\Models\ServiceCharge;
use App\Models\VisitCharge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PartnerController extends Controller
{
    public function index(Request $request, $lat, $lang, $order_id, $partner_type)
    {


        $latitude = $lat ?? "28.618528";
        $longitude = $lang ?? "77.372627";
        $radius = 500;
        $order = Order::with(['details'])->find($order_id);

            if ($order->unit_type == 'nos') {
                $cat_id = $order->category_id;
                $unit_type = $order->unit_type;
                $job_id = $order->job_profile_id;
            } else {
                $cat_id = $order->category_id;
                $unit_type = $order->unit_type;
                $job_id = $order->job_profile_id;
            }

        if ($unit_type == 'select') {
            $partnersdata = VisitCharge::join('partners', function ($join) use ($partner_type) {
                $join->on('visit_charges.partner_id', '=', 'partners.id');
            })
                ->select(DB::raw('*, IFNULL(round(( 6367 * acos( cos( radians(' . $latitude . ') ) * cos( radians( lat ) ) * cos( radians( lang ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') ) * sin( radians( lat ) ) ) ),2),0) AS distance,(visit_charges.visit_charge) as charge'))
                ->where('cat_id', $cat_id)
                ->where('partners.partner_type', $partner_type)
                ->where('partners.job_profile_id', $job_id)
                ->having("distance", "<", $radius)
                ->orderBy('distance', 'ASC')
                ->get();
            $partners = [];

            foreach ($partnersdata as $partner) {

                $rating = number_format($partner->ratings()->avg('rating'), 1);
                if ($rating > 0){
                    $avrating = $rating;
                }else{
                    $avrating = number_format($partner->rating,1);
                }
            $partners[] = array(

                'id' => $partner->id,
                'partner_id' => $partner->id,
                'cat_id' => $cat_id,
                'visit_charge' => $partner->visit_charge,
                'area_charge' =>$partner->area_charge,
                'name' => $partner->name,
                'job_profile_id' => $partner->job_profile_id,
                'experience' => $partner->experience,
                'image' => $partner->image,
               // 'rating' => $partner->rating,
                  'rating' => $avrating,
                'mobile' => $partner->mobile,
                'lat' => $partner->lat,
                'lang' => $partner->lang,
                'status' => $partner->status,
                'first_name' => $partner->first_name,
                'last_name' => $partner->last_name,
                'aadhar_number' => $partner->aadhar_number,
                'aadhar_contact' => $partner->aadhar_contact,
                'aadhar_front' => $partner->aadhar_front,
                'aadhar_back' => $partner->aadhar_back,
                'kyc_image' => $partner->kyc_image,
                'distance' => number_format($partner->distance,2),
                'charge' => $partner->charge

            );

        }

        } elseif ($unit_type == 'area') {

            $partnersdata = VisitCharge::join('partners', function ($join) {
                $join->on('visit_charges.partner_id', '=', 'partners.id');
            })
                ->select(DB::raw('*, IFNULL(round(( 6367 * acos( cos( radians(' . $latitude . ') ) * cos( radians( lat ) ) * cos( radians( lang ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') ) * sin( radians( lat ) ) ) ),2),0) AS distance,(visit_charges.area_charge) as charge'))
                ->where('cat_id', $cat_id)
                ->where('partners.partner_type', $partner_type)
                ->where('partners.job_profile_id', $job_id)
                ->having("distance", "<", $radius)
                ->orderBy('distance', 'ASC')
                ->get();
            $partners = [];
            $total = 0;

            foreach ($partnersdata as $partner) {

                if ($partnersdata) {
                    $total = $total + (($partner->charge ?? 0) * $order->details[0]->installation);
                }
                $rating = number_format($partner->ratings()->avg('rating'), 1);
                if ($rating > 0){
                    $avrating = $rating;
                }else{
                    $avrating = number_format($partner->rating,1);
                }
                $partners[] = array(

                    'id' => $partner->id,
                    'partner_id' => $partner->id,
                    'cat_id' => $cat_id,
                    'visit_charge' => 0,
                    'area_charge' => 0,
                    'name' => $partner->name,
                    'job_profile_id' => $partner->job_profile_id,
                    'experience' => $partner->experience,
                    'image' => $partner->image,
                   // 'rating' => $partner->rating,
                    'rating' => $avrating,
                    'mobile' => $partner->mobile,
                    'lat' => $partner->lat,
                    'lang' => $partner->lang,
                    'status' => $partner->status,
                    'first_name' => $partner->first_name,
                    'last_name' => $partner->last_name,
                    'aadhar_number' => $partner->aadhar_number,
                    'aadhar_contact' => $partner->aadhar_contact,
                    'aadhar_front' => $partner->aadhar_front,
                    'aadhar_back' => $partner->aadhar_back,
                    'kyc_image' => $partner->kyc_image,
                    'distance' => number_format($partner->distance,2),
                    'charge' => $total

                );

            }


        } elseif ($unit_type == 'nos') {

            $partnersdata = Partner::with(['servicecharge' => function ($service) use ($cat_id) {
                $service->where('cat_id', $cat_id);
            }
            ])->select(DB::raw('*, round(( 6367 * acos( cos( radians(' . $latitude . ') ) * cos( radians( lat ) ) * cos( radians( lang ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') ) * sin( radians( lat ) ) ) ),2) AS distance'))
                ->where('partners.job_profile_id', $job_id)
                ->where('partners.partner_type', $partner_type)
                ->having("distance", "<", $radius)
                ->orderBy('distance', 'ASC')
                ->get();
            $partners = [];
            foreach ($partnersdata as $partner) {

                $total = 0;
                foreach ($order->details as $detailservice_id) {
                    $charge = ServiceCharge::where('cat_id', $cat_id)->where('service_id', $detailservice_id->service_id)->where('partner_id', $partner->id)->first();
                    if ($charge) {
                        $total = $total + (($charge->installation ?? 0) * $detailservice_id->installation) + (($charge->uninstallation ?? 0) * $detailservice_id->uninstallation) + (($charge->repair ?? 0) * $detailservice_id->repair);
                    }
                }
                $rating = number_format($partner->ratings()->avg('rating'), 1);
                if ($rating > 0){
                    $avrating = $rating;
                }else{
                    $avrating = number_format($partner->rating,1);
                }
                $partners[] = array(

                    'id' => $partner->id,
                    'partner_id' => $partner->id,
                    'cat_id' => $cat_id,
                    'visit_charge' => 0,
                    'area_charge' => 0,
                    'name' => $partner->name,
                    'job_profile_id' => $partner->job_profile_id,
                    'experience' => $partner->experience,
                    'image' => $partner->image,
                   // 'rating' => $partner->rating,
                    'rating' => $avrating,
                    'mobile' => $partner->mobile,
                    'lat' => $partner->lat,
                    'lang' => $partner->lang,
                    'status' => $partner->status,
                    'first_name' => $partner->first_name,
                    'last_name' => $partner->last_name,
                    'aadhar_number' => $partner->aadhar_number,
                    'aadhar_contact' => $partner->aadhar_contact,
                    'aadhar_front' => $partner->aadhar_front,
                    'aadhar_back' => $partner->aadhar_back,
                    'kyc_image' => $partner->kyc_image,
                    'distance' => number_format($partner->distance,2),
                    'charge' => $total

                );

            }

        } else {
            $partnersdata = PartnerJob::join('partners', function ($join) {
                $join->on('partner_jobs.partner_id', '=', 'partners.id');
            })
                ->select(DB::raw('*, round(( 6367 * acos( cos( radians(' . $latitude . ') ) * cos( radians( lat ) ) * cos( radians( lang ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') ) * sin( radians( lat ) ) ) ),2) AS distance'))
                ->where('partners.status', 1)
                ->where('category_id', $cat_id)
                ->having("distance", "<", $radius)
                ->orderBy('distance', 'ASC')
                ->get();

            $partners = [];
            foreach ($partnersdata as $partner) {
                $rating = number_format($partner->ratings()->avg('rating'), 1);
                if ($rating > 0){
                    $avrating = $rating;
            }else{
                    $avrating = number_format($partner->rating,1);
            }
                $partners[] = array(

                    'id' => $partner->id,
                    'partner_id' => $partner->id,
                    'cat_id' => $cat_id,
                    'visit_charge' => 0,
                    'area_charge' => 0,
                    'name' => $partner->name,
                    'job_profile_id' => $partner->job_profile_id,
                    'experience' => $partner->experience,
                    'image' => $partner->work_image,
                  //  'rating' => $partner->rating,
                    'rating' => $avrating,
                    'mobile' => $partner->mobile,
                    'lat' => $partner->lat,
                    'lang' => $partner->lang,
                    'status' => $partner->status,
                    'first_name' => $partner->first_name,
                    'last_name' => $partner->last_name,
                    'aadhar_number' => $partner->aadhar_number,
                    'aadhar_contact' => $partner->aadhar_contact,
                    'aadhar_front' => $partner->aadhar_front,
                    'aadhar_back' => $partner->aadhar_back,
                    'kyc_image' => $partner->kyc_image,
                    'distance' => number_format($partner->distance,2),
                    'charge' => 0

                );
            }
        }

        switch($request->sort_type){
            case 'rating':
                usort($partners,function($item1, $item2){
                    if ($item1['rating'] == $item2['rating']) return 0;
                    return ($item1['rating'] < $item2['rating']) ? -1 : 1;
                });
                break;
            case 'rate':
                usort($partners, function($item1, $item2){
                    if ($item1['rate'] == $item2['rate']) return 0;
                    return ($item1['rate'] < $item2['rate']) ? -1 : 1;
                });
                break;
            case 'nearest':usort($partners, function($item1, $item2){
                if ($item1['distance'] == $item2['distance']) return 0;
                return ($item1['distance'] < $item2['distance']) ? -1 : 1;
            });
                break;
            default:usort($partners, function($item1, $item2){
                if ($item1['distance'] == $item2['distance']) return 0;
                return ($item1['distance'] < $item2['distance']) ? -1 : 1;
            });
                break;

        }


        if ($partners) {
            return [
                'status' => "success",
                'message' => "success",
                'data' => $partners
            ];
        } else {
            return [
                'status' => 'failed',
                'message' => 'No Record Found'
            ];
        }
    }

    public function partnerDetails(Request $request, $partner_id)
    {

        $partner = Partner::with(['gallery','partnerJob'])->find($partner_id);
        $reviews= Rating::with('customer')->where('partner_id',$partner_id)->orderBy('id','DESC')->limit(80)->get();
       $ratings=[];
foreach ($reviews as $review){
    $ratings[]=array(
        'name'=>$review->customer->name??'',
        'rating'=>number_format($review->rating,1),
        'text'=>$review->text,
        'date'=>$review->date,
    );
}
        $partner->ratings=$ratings;
      $rating =  number_format($partner->ratings()->avg('rating'),1);

        if($rating>0)
            $partner->rating=$rating;
                else
                    $partner->rating=number_format($partner->rating,1);

        if ($partner) {
            return [
                'status' => 'success',
                'message' => 'success',
                'data' => compact('partner')

            ];
        }
        return [
            'status' => 'failed',
            'message' => 'Details Not Found'
        ];

    }

}
