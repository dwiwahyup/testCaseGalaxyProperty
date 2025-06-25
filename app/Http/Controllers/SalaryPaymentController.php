<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Notification;
use App\Models\SalaryPayment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalaryPaymentController extends Controller
{
    public function index()
    {
        $salaryPayments = SalaryPayment::all();
        $employees = Employee::all();
        return view('dashboard.payment.index', compact('salaryPayments', 'employees'));
    }

    public function show($id)
    {
        $payment = SalaryPayment::with('employee')->findOrFail($id);
        return view('dashboard.payment.detail', compact('payment'));
    }

    //Salary Calculation
    public function salaryCalculation(Request $request)
    {   
         $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'bonus' => 'required|numeric|min:0',
        ]);

        $employee = Employee::findOrFail($request->employee_id);

        $grossSalary = $employee->base_salary + ($request->bonus ?? 0);

        if ($grossSalary <= 5000000) {
            $taxRate = 0.05;
        } elseif ($grossSalary <= 20000000) {
            $taxRate = 0.10;
        } else {
            $taxRate = 0.15;
        }

        $tax = $grossSalary * $taxRate;
        $netSalary = $grossSalary - $tax;
        
        // dd($netSalary);
        
        return view('dashboard.payment.calculationResult', [
            'employee' => $employee,
            'bonus' => $validated['bonus'],
            'tax' => $tax,
            'netSalary' => $netSalary
        ]);
    }

    //Salary Request
    public function salaryRequest(Request $request)
    {
        $employee = Employee::find($request->employee_id);
        
        $grossSalary = $employee->base_salary + $request->bonus;
        
        if ($grossSalary <= 5000000) {
            $taxRate = 0.05;
        } elseif ($grossSalary <= 20000000) {
            $taxRate = 0.10;
        } else {
            $taxRate = 0.15;
        }

        $tax = $grossSalary * $taxRate;
        $netSalary = $grossSalary - $tax;

        return view('dashboard.payment.salaryRequest', [
            'employee' => $employee,
            'bonus' => $request->bonus,
            'tax' => $tax,
            'netSalary' => $netSalary
        ]);
    }

    public function salaryStore(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'bonus' => 'required|numeric|min:0',
        ]);

        $employee = Employee::find($validated['employee_id']);
        $grossSalary = $employee->base_salary + $validated['bonus'];
        
        if ($grossSalary <= 5000000) {
            $taxRate = 0.05;
        } elseif ($grossSalary <= 20000000) {
            $taxRate = 0.10;
        } else {
            $taxRate = 0.15;
        }

        $tax = $grossSalary * $taxRate;
        $netSalary = $grossSalary - $tax;

        $salaryPayment = SalaryPayment::create([
            'employee_id' => $employee->id,
            'created_by' => Auth::id(),
            'base_salary' => $employee->base_salary,
            'bonus' => $validated['bonus'],
            'tax_amount' => $tax,
            'total_amount' => $netSalary,
            'status' => 'pending'
        ]);

        // Notfication for managers
        $managers = User::where('role', 'manager')->get();
        foreach ($managers as $manager) {
            Notification::create([
                'user_id' => $manager->id,
                'title' => 'New Salary Payment Request',
                'message' => 'A salary payment request for ' . $employee->name . ' is awaiting your approval.',
                'link' => route('payment.salary.approval.show', $salaryPayment->id)
            ]);
        }
        
        return redirect()->route('payment.index')->with('success', 'Salary payment request submitted successfully.');
    }

    // Salary Approval
    public function showRequest($id)
    {
        $payment = SalaryPayment::with('employee')->findOrFail($id);
        return view('dashboard.payment.showRequest', compact('payment'));
    }

    public function approve(Request $request, $id)
    {
        $payment = SalaryPayment::findOrFail($id);
        
        $payment->update([
            'status' => 'approved',
            'approved_by' => Auth::id(),
            'approved_at' => now()
        ]);

        // Notification for finance
        Notification::create([
            'user_id' => $payment->created_by,
            'title' => 'Salary Payment Request Approved',
            'message' => 'The salary payment request for ' . $payment->employee->name . ' has been approved.',
            'link' => route('payment.salary.payment.process', $payment->id)
        ]);

        return redirect()->route('payment.index')->with('success', 'The salary payment request has been approved.');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:255'
        ]);

        $payment = SalaryPayment::findOrFail($id);
        
        $payment->update([
            'status' => 'rejected',
            'approved_by' => Auth::id(),
            'approved_at' => now(),
            'rejection_reason' => $request->rejection_reason
        ]);

        // Notification for finance
        Notification::create([
            'user_id' => $payment->created_by,
            'title' => 'Salary Payment Request Rejected',
            'message' => 'The salary payment request for ' . $payment->employee->name . ' has been rejected. Reason: ' . $request->rejection_reason,
            'link' => route('payment.index')
        ]);

        return redirect()->route('payment.index')->with('success', 'The salary payment request has been rejected.');
    }

    //Salary Payment
    public function process($id)
    {
        $payment = SalaryPayment::with('employee')->findOrFail($id);
        return view('dashboard.payment.paymentProcess', compact('payment'));
    }

    public function complete(Request $request, $id)
    {
        $request->validate([
            'payment_proof' => 'required|file|mimes:jpeg,png,pdf|max:2048'
        ]);

        $payment = SalaryPayment::findOrFail($id);
        
        $path = $request->file('payment_proof')->store('payment-proofs', 'public');

        $payment->update([
            'status' => 'paid',
            'payment_proof' => $path,
            'paid_by' => Auth::id(),
            'paid_at' => now()
        ]);

        // Notification for directors
        $directors = User::where('role', 'director')->get();

        foreach ($directors as $director) {
            Notification::create([
                'user_id' => $director->id,
                'title' => 'Salary Payment Completed',
                'message' => 'The salary payment for ' . $payment->employee->name . ' has been successfully processed.',
                'link' => route('payment.salary.report.show', $payment->id)
            ]);
        }

        return redirect()->route('payment.index')->with('success', 'Salary payment has been completed successfully.');
    }

    //Payment Report
    public function paymentReport()
    {
        $salaryPayments = SalaryPayment::with('employee')
                        ->where('status', 'paid')
                        ->get();
        return view('dashboard.payment.report', compact('salaryPayments'));
    }

    public function showReport($id)
    {
        $payment = SalaryPayment::with('employee')->findOrFail($id);
        return view('dashboard.payment.reportDetail', compact('payment'));
    }
}
