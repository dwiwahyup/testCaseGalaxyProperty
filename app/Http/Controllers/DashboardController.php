<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\SalaryPayment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $countEmployees = Employee::count();
        $salaryPayments = SalaryPayment::count();
        $pendingPayments = SalaryPayment::where('status', 'pending')->count();
        $approvedPayments = SalaryPayment::where('status', 'approved')->count();
        $rejectedPayments = SalaryPayment::where('status', 'rejected')->count();
        $paidPayments = SalaryPayment::where('status', 'paid')->count();
        return view('dashboard.dashboard',
            [
                'countEmployees' => $countEmployees,
                'salaryPayments' => $salaryPayments,
                'pendingPayments' => $pendingPayments,
                'approvedPayments' => $approvedPayments,
                'rejectedPayments' => $rejectedPayments,
                'paidPayments' => $paidPayments,
            ]
        );
    }
}
