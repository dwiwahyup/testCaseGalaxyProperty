<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
     public function index()
    {
        $data = Employee::all();

        return view('dashboard.employee.index', ['data' => $data]);
    }

     public function create()
    {
        return view('dashboard.employee.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'employee_number' => 'required|string|max:255|unique:employees,employee_number,',
            'bank_account_number' => 'required|string|max:255',
            'bank_name' => 'required|string|max:255',
            'base_salary' => 'required|numeric|min:0',
        ]);

        Employee::create($request->all());

        return redirect()->route('employee.index')->with('success', 'Employee created successfully.');
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);

        return view('dashboard.employee.edit', ['data' => $employee]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'employee_number' => 'required|string|max:255|unique:employees,employee_number,' . $id,
            'bank_account_number' => 'required|string|max:255',
            'bank_name' => 'required|string|max:255',
            'base_salary' => 'required|numeric|min:0',
        ]);

        $employee = Employee::findOrFail($id);
        $employee->update($request->all());

        return redirect()->route('employee.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect()->route('employee.index')->with('success', 'Employee deleted successfully.');
    }

}
