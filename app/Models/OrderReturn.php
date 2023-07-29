<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderReturn extends Model
{
    protected $guarded = [];
    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id','id');
    }
    use HasFactory;
}
