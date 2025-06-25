@extends('dashboard.layouts.template')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Payment Data</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Payment</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">
                @if (Auth::user()->role == 'finance')
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Salary Calculation</h5>
                                <div class="accordion" id="accordionExample">
                                    <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Salary Calculation
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                        <form action="{{ route('payment.salary.calculate') }}" method="post"enctype="multipart/form-data" class="row g-3">
                                            @csrf
                                                <div class="col-md-6">
                                                    <label for="inputState" class="form-label">Chose Employee</label>
                                                    <select name="employee_id" id="inputState" class="form-select">
                                                        <option value="">Employee</option>
                                                            @foreach($employees as $employee)
                                                                <option value="{{ $employee->id }}">{{ $employee->name }} - Rp {{ number_format($employee->base_salary, 0, ',', '.') }}</option>
                                                            @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="inputState" class="form-label">Bonus</label>
                                                    <input type="text" class="form-control" name="bonus" placeholder="Bonus Amount Rp. " required>
                                                </div>

                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Payment</h5>
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
                                    <th>Employee Name</th>
                                    <th>ID Number</th>
                                    <th>Base Salary</th>
                                    <th>Bonus</th>
                                    <th>Tax</th>
                                    <th>Net Salary</th>
                                    <th>Status</th>
                                    <th>Note</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Employee Name</th>
                                    <th>ID Number</th>
                                    <th>Base Salary</th>
                                    <th>Bonus</th>
                                    <th>Tax</th>
                                    <th>Net Salary</th>
                                    <th>Status</th>
                                    <th>Note</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($salaryPayments as $data)
                                    <tr>
                                        <td>{{ $data->employee->name }}</td>
                                        <td>{{ $data->employee->employee_number }}</td>
                                        <td>Rp {{ number_format($data->base_salary, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($data->bonus, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($data->tax_amount, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($data->total_amount, 0, ',', '.') }}</td>
                                        <td>
                                            @switch($data->status)
                                                @case('pending')
                                                    <span class="badge bg-warning">Pending</span>
                                                @break

                                                @case('approved')
                                                    <span class="badge bg-success">Approved</span>
                                                @break

                                                @case('paid')
                                                    <span class="badge bg-success">Paid</span>
                                                @break

                                                @case('rejected')
                                                    <span class="badge bg-danger">Rejected</span>
                                                @break

                                                @default
                                                    <span class="badge bg-danger">Rejected</span>
                                            @endswitch
                                        </td>
                                        <td>{{ $data->rejection_reason }}</td>
                                        <td>
                                            @if (Auth::user()->role == 'manager' && $data->status =='pending')
                                                <a href="{{ route('payment.salary.approval.show', $data->id) }}"
                                                    class="btn btn-outline-primary mr-3">Detail</a>
                                            @elseif (Auth::user()->role == 'finance')
                                                @if ($data->status =='approved')
                                                    <a href="{{ route('payment.salary.payment.process', $data->id) }}"
                                                        class="btn btn-outline-primary mr-3">Process</a>
                                                @else
                                                    <a href="{{ route('payment.detail', $data->id) }}"
                                                        class="btn btn-outline-primary mr-3">Detail</a>
                                                @endif
                                            @endif
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
