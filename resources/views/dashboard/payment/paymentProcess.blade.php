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
                            <table class="table">
                                <tr>
                                    <th>Empployee Name</th>
                                    <td>{{ $payment->employee->name }}</td>
                                </tr>
                                <tr>
                                    <th>Base Salary</th>
                                    <td>Rp {{ number_format($payment->base_salary, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Bonus</th>
                                    <td>Rp {{ number_format($payment->bonus, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Tax</th>
                                    <td>Rp {{ number_format($payment->tax_amount, 0, ',', '.') }}</td>
                                </tr>
                                <tr class="table-primary">
                                    <th>Net Salary</th>
                                    <td>Rp {{ number_format($payment->total_amount, 0, ',', '.') }}</td>
                                </tr>
                            </table>
                            @if($payment->status == 'approved')
                                <form method="POST" action="{{ route('payment.salary.payment.complete', $payment->id) }}" enctype="multipart/form-data">
                                @csrf
                                    <div class="mb-3">
                                        <label for="payment_proof" class="form-label">Upload Payment Proof</label>
                                        <input class="form-control" type="file" id="payment_proof" name="payment_proof" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Complete Payment</button>
                                </form>
                            @elseif($payment->status == 'paid')
                                <div class="alert alert-success" role="alert">
                                    Payment has been completed successfully.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
