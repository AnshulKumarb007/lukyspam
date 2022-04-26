<?php

namespace App\Models;
Use App\Models\Traits\Active;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCustomer extends Model
{
    use HasFactory,Active;
    protected $table = 'services_customer';
    protected $fillable = ['name','mobile','type','description','service_id','subscription_id','user_id','created_at','service_date','gst_no','address','amount','quantity','gst_per','product_name','invoiceno','contact_person','remarks','numberofmembrane','outletwaterconditon','rawwatercondition',
    'NumberOfMachine','model','company_namea','currentdate'];
    protected $hidden = ['created_at','updated_at','deleted_at'];


    public function servicename(){
        return $this->belongsTo('App\Models\Service','service_id');
    }


    public function vendors(){
        return $this->belongsTo('App\Models\Customer','user_id');
    }

    public function service(){
        return $this->belongsTo('App\Models\Service','service_id');
    }





}
