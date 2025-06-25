@extends('dashboard.layouts.template')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Calculation Result</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Calculate</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Employee Salary Calculation</h5>
                                <table class="table">
                                    <tr>
                                        <th>Empployee Name</th>
                                        <td>{{ $employee->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Base Salary</th>
                                        <td>Rp {{ number_format($employee->base_salary, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Bonus</th>
                                        <td>Rp {{ number_format($bonus, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tax</th>
                                        <td>Rp {{ number_format($tax, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr class="table-primary">
                                        <th>Net Salary</th>
                                        <td>Rp {{ number_format($netSalary, 0, ',', '.') }}</td>
                                    </tr>
                                </table>
                                <a href="{{ route('payment.salary.request.create', ['employee_id' => $employee->id, 'bonus' => $bonus]) }}" class="btn btn-primary">Create Payment Request</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
