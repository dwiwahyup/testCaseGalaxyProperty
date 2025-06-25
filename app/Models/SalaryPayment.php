<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalaryPayment extends Model
{
     protected $fillable = [
        'employee_id', 'created_by', 'base_salary', 'bonus', 
        'tax_amount', 'total_amount', 'status', 'approved_by',
        'approved_at', 'rejection_reason', 'payment_proof', 'paid_at', 'paid_by'
    ];
    
    public function calculateTax()
    {
        $grossSalary = $this->base_salary + $this->bonus;
        
        if ($grossSalary <= 5000000) {
            $taxRate = 0.05;
        } elseif ($grossSalary <= 20000000) {
            $taxRate = 0.10;
        } else {
            $taxRate = 0.15;
        }
        
        return $grossSalary * $taxRate;
    }
    
    public function calculateNetSalary()
    {
        $grossSalary = $this->base_salary + $this->bonus;
        $tax = $this->calculateTax();
        
        return $grossSalary - $tax;
    }
    
    // Relasi
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
    
    public function payer()
    {
        return $this->belongsTo(User::class, 'paid_by');
    }
}
