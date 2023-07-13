<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function supllier(){
        return $this->belongsTo(Supplier::class,'supplier_id','id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function purchaseUnit()
    {
        return $this->belongsTo(Unit::class, 'purchase_unit_id', 'id');
    }

    public function saleUnit()
    {
        return $this->belongsTo(Unit::class, 'sale_unit_id', 'id');
    }
}
