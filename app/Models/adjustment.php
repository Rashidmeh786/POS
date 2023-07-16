<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class adjustment extends Model
{
    protected $guarded = [];
    use HasFactory;


    public function products(){
        return $this->belongsTo(Product::class,'product_id','id');
    }

    public function users(){
        return $this->belongsTo(user::class,'user_id','id');
    }
}
