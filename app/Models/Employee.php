<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $guarded = [];
   
    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function AdvanceSalaries()
    {
        return $this->hasMany(Employee::class);
    }
    public function PaySalaries()
    {
        return $this->hasMany(Employee::class);
    }

    public function advance(){
        return $this->belongsTo(AdvanceSalary::class,'id','employee_id');
    }
    public function paysalary(){
        return $this->belongsTo(Paysalary::class,'id','employee_id');
    }
}
