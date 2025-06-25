@extends('dashboard.layouts.template')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Salary Payment Submission</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Salary Payment Submission</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $employee->name }}</h5>
                             <form method="POST" action="{{ route('payment.salary.request.store') }}">
                                @csrf
                                <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                                <input type="hidden" name="bonus" value="{{ $bonus }}">
                                <table class="table">
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
                                <button type="submit" class="btn btn-primary">Submit to Manager</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
