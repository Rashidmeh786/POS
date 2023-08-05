<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoldOrderDetails extends Model
{
    protected $guarded = [];
    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
    public function orderReturn(){
        return $this->belongsTo(HoldOrder::class,'id','hold_id');
    }
    use HasFactory;
}
