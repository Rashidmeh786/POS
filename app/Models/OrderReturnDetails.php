<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderReturnDetails extends Model
{
    protected $guarded = [];

    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
    public function orderReturn(){
        return $this->belongsTo(OrderReturn::class,'order_id','id');
    }
    use HasFactory;
}
