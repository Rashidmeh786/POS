<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $guarded = [];
    public function category(){
        return $this->belongsTo(ExpenseCategory::class,'category_id','id');
    }
    public function user(){
        return $this->belongsTo(user::class,'user_id','id');
    }
    use HasFactory;
}
