<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{

    use HasFactory;
    
    protected $fillable = [
        'name',
        'employee_number',
        'bank_account_number',
        'bank_name',
        'base_salary',
    ];
}
