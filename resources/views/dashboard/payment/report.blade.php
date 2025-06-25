@extends('dashboard.layouts.template')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Salary Payment Report</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Salary Payment Report</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show">
                                <i class="bi bi-check-circle me-1"></i>
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show">
                                <i class="bi bi-exclamation-octagon me-1"></i>

                                {{ session('error') }}
                            </div>
                        @endif

                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Employee Name</th>
                                    <th>ID Number</th>
                                    <th>Net Salary</th>
                                    <th>Created By</th>
                                    <th>Approved By</th>
                                    <th>Paid By</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                   <th>Date</th>
                                    <th>Employee Name</th>
                                    <th>ID Number</th>
                                    <th>Net Salary</th>
                                    <th>Created By</th>
                                    <th>Approved By</th>
                                    <th>Paid By</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($salaryPayments as $data)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($data->paid_at)->format('d/m/Y') }}</td>
                                        <td>{{ $data->employee->name }}</td>
                                        <td>{{ $data->employee->employee_number}}</td>
                                        <td>Rp {{ number_format($data->total_amount, 0, ',', '.') }}</td>
                                        <td>{{ $data->creator->name }}</td>
                                        <td>{{ $data->approver->name }}</td>
                                        <td>{{ $data->payer->name }}</td>
                                        <td>
                                            <a href="{{ route('payment.salary.report.show', $data->id) }}" class="btn btn-sm btn-info">Detail</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script type="text/javascript">
        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                    title: `Are you sure you want to delete this record?`,
                    text: "If you delete this, it will be gone forever.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });
    </script>
@endsection
