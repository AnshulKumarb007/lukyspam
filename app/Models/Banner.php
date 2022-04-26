<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Banner extends Model
{
    use HasFactory;
    protected $table = 'banners';
    protected $fillable = ['image','isactive'];
    protected $hidden = ['created_at','updated_at','deleted_at'];

    public function getImageAttribute($value){
        if($value)
            return Storage::url($value);
        return null;
    }
}
