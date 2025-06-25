@extends('dashboard.layouts.template')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div>
        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Employee</h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $countEmployees }} Employee</h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-xxl-6 col-md-6">
                            <div class="card info-card revenue-card">
                                <div class="card-body pb-0">
                                    <h5 class="card-title">Payment </h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bx bxs-car"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $salaryPayments }} Total Salary Payment</h6>
                                            <span class="text-Warning small pt-1 fw-bold">{{ $pendingPayments }}
                                                Pending Payment
                                            </span>
                                                //
                                            <span class="text-info small pt-1 fw-bold">{{ $approvedPayments }}
                                                Approved Payment
                                            </span>
                                            //
                                            <span class="text-danger small pt-1 fw-bold">{{ $rejectedPayments }}
                                                Rejected Payment
                                            </span>
                                            //
                                            <span
                                                class="text-success small pt-1 fw-bold">{{ $paidPayments }}
                                                Paid Payment
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
