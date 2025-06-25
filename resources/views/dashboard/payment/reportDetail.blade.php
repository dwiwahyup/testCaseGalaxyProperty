@extends('dashboard.layouts.template')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Report Detail</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('payment.salary.report.index') }}">Salary Payment Report</a></li>
                    <li class="breadcrumb-item active">Report Detail</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Report Detail</h5>
                            <table class="table">
                                <tr>
                                    <th>Employee Name</th>
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
                                <tr>
                                    <th>Net Salary</th>
                                    <td>Rp {{ number_format($payment->total_amount, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Created By</th>
                                    <td>{{ $payment->creator->name }}</td>
                                </tr>
                                <tr>
                                    <th>Approved By</th>
                                    <td>{{ $payment->approver->name }}</td>
                                </tr>
                                <tr>
                                    <th>Paid By</th>
                                    <td>{{ $payment->payer->name }}</td>
                                </tr>
                                <tr>
                                    <th>Paid At</th>
                                    <td>{{ \Carbon\Carbon::parse($payment->paid_at)->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Payment Proof</th>
                                    <td>
                                        @if ($payment->payment_proof)
                                            <a href="{{ asset('storage/' . $payment->payment_proof) }}" target="_blank" class="btn btn-primary">View Proof</a>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rejectModalLabel">Alasan Penolakan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('payment.salary.approval.reject', $payment->id) }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="rejection_reason" class="form-label">Alasan</label>
                        <textarea class="form-control" id="rejection_reason" name="rejection_reason" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Submit Penolakan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
