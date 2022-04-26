<?php

namespace App\Models;

use App\Models\Traits\Active;
use App\Models\Traits\DocumentUploadTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use Active,DocumentUploadTrait;
    use HasFactory;
    protected $table='categories';
    protected $fillable=['name','image','isactive','flag','parent_id'];

    protected $hidden = ['created_at','deleted_at','updated_at'];
    public function getImageAttribute($value){
        if($value)
            return Storage::url($value);
        return null;
    }

    public function parentname(){
        return $this->belongsTo('App\Models\Category','parent_id');
    }
    public function services(){
        return $this->hasMany('App\Models\Service');
    }
}
