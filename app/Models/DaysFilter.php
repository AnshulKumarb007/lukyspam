<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaysFilter extends Model
{
    use HasFactory;
    protected $table = 'day_filter';
    protected $fillable = ['name'];
    protected $hidden = ['created_at','updated_at','deleted_at'];
}
