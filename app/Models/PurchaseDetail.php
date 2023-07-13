<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
    public function PurchaseOrder(){
        return $this->belongsTo(PurchaseOrder::class,'order_id','id');
    }
}
