<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
   use HasFactory;
   protected $table = 'subscribe';
   protected $fillable=['userid','subscriptionid','amount','status','created_at','orderid','expire_date'];


   public function plan(){
      return $this->belongsTo('App\Models\Subscription','subscriptionid');
     }


     public function users_details(){
        return $this->belongsTo('App\Models\Customer','userid');
     }




}
