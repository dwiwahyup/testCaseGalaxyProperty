@extends('dashboard.layouts.template')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Driver Data</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Driver</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Add Driver</h5>
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

                            <form action="{{ route('employee.store') }}" method="post" enctype="multipart/form-data"
                                class="row g-3">
                                @csrf

                                <div class="col-md-4">
                                    <label class="form-label">Employee Name</label>
                                    <input name="name" type="text" class="form-control">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Employee Number</label>
                                    <input name="employee_number" type="text" class="form-control">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Bank Number</label>
                                    <input name="bank_account_number" type="number" class="form-control">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Bank Name</label>
                                    <input name="bank_name" type="text" class="form-control">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Base Salary</label>
                                    <input name="base_salary" type="number" class="form-control">
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>
@endsection
