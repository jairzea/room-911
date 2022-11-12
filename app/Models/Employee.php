<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function department(){
        return $this->belongsto('App\Models\Department', 'department_id');
    }

    public function incomeRecord(){
        return $this->hasMany('App\Models\IncomeRecord', 'employee_identification', 'identification');
    }
}
