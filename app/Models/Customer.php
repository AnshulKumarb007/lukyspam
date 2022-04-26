<?php

namespace App\Models;
use App\Models\Traits\Active;
use App\Models\Traits\DocumentUploadTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;
use Tymon\JWTAuth\Contracts\JWTSubject;
use DateTime;
class Customer extends Authenticatable implements JWTSubject
{
    use  Active;
    use DocumentUploadTrait;

    protected $table='customers';

    protected $fillable = [
        'name', 'email', 'mobile', 'password', 'image', 'status','notification_token',
        'company_name','address','bank_name','bank_address','ifsc_code','account_no','state','gst'];

    protected $hidden = [
        'password','created_at','deleted_at','updated_at'
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }


    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getImageAttribute($value){
        if($value)
            return Storage::url($value);
        return Storage::url('customers/default.jpeg');
    }

}
