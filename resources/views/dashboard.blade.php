@extends('layouts.app')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="h-100">
                            <div class="row mb-3 pb-1">
                                <div class="col-12">
                                    <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                        <div class="flex-grow-1">
                                            <h4 class="fs-16 mb-1">Good Morning, {!! ucfirst(Auth::user()->name) !!}</h4>
                                            <p class="text-muted mb-0">
                                                Here's what's happening with your store today.
                                            </p>
                                        </div>
                                        
                                    </div>
                                    <!-- end card header -->
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->

                            <div class="row">
                                <div class="col-xl-3 col-md-6">
                                    <!-- card -->
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                        Total Inquires
                                                    </p>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <h5 class="text-success fs-14 mb-0">
                                                        <i class="ri-arrow-right-up-line fs-13 align-middle"></i> +16.24 %
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                                        <span class="counter-value" data-target="559">0</span>
                                                    </h4>
                                                  
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-success rounded fs-3">
                                                        <i class="bx bx-dollar-circle"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end card body -->
                                    </div>
                                    <!-- end card -->
                                </div>
                                <!-- end col -->

                                <div class="col-xl-3 col-md-6">
                                    <!-- card -->
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                        Buyers
                                                    </p>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <h5 class="text-danger fs-14 mb-0">
                                                        <i class="ri-arrow-right-down-line fs-13 align-middle"></i> -3.57 %
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                                        <span class="counter-value" data-target="3689">0</span>
                                                    </h4>
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-info rounded fs-3">
                                                        <i class="bx bx-shopping-bag"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end card body -->
                                    </div>
                                    <!-- end card -->
                                </div>
                                <!-- end col -->

                                <div class="col-xl-3 col-md-6">
                                    <!-- card -->
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                        Seller
                                                    </p>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <h5 class="text-success fs-14 mb-0">
                                                        <i class="ri-arrow-right-up-line fs-13 align-middle"></i> +29.08 %
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                                        <span class="counter-value" data-target="183">0</span>M
                                                    </h4>
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-warning rounded fs-3">
                                                        <i class="bx bx-user-circle"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end card body -->
                                    </div>
                                    <!-- end card -->
                                </div>
                                <!-- end col -->

                                <div class="col-xl-3 col-md-6">
                                    <!-- card -->
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                        Total Properties
                                                    </p>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <h5 class="text-muted fs-14 mb-0">+24.00 %</h5>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                                        $<span class="counter-value" data-target="1657">0</span>k
                                                    </h4>
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-danger rounded fs-3">
                                                        <i class="bx bx-wallet"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end card body -->
                                    </div>
                                    <!-- end card -->
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row-->

                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="card">
                                        <div class="card-header align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1">
                                                Buyer
                                            </h4>

                                        </div>
                                        <!-- end card header -->

                                        <div class="card-body">
                                            <div class="table-responsive table-card">
                                                <table
                                                    class="table table-hover table-centered align-middle table-nowrap mb-0">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                Vignesh
                                                            </td>
                                                            <td>
                                                                Coimbatore
                                                            </td>
                                                            <td>
                                                                vignesh@gmail.com
                                                            </td>
                                                            <td>
                                                                7345676543
                                                            </td>
                                                            <td>
                                                                <span
                                                                    class="badge bg-success-subtle text-success">Active</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                Pugal
                                                            </td>
                                                            <td>
                                                                Coimbatore
                                                            </td>
                                                            <td>
                                                                pugal@gmail.com
                                                            </td>
                                                            <td>
                                                                9867564534
                                                            </td>
                                                            <td>
                                                                <span
                                                                    class="badge bg-success-subtle text-success">Active</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                Dhanapal
                                                            </td>
                                                            <td>
                                                                Coimbatore
                                                            </td>
                                                            <td>
                                                                dhanapal@gmail.com
                                                            </td>
                                                            <td>
                                                                8765645336
                                                            </td>
                                                            <td>
                                                                <span
                                                                    class="badge bg-warning-subtle text-warning">Inactive</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div
                                                class="align-items-center mt-4 pt-2 justify-content-between row text-center text-sm-start">
                                                <div class="col-sm">
                                                    <div class="text-muted">
                                                        Showing <span class="fw-semibold">5</span> of
                                                        <span class="fw-semibold">25</span> Results
                                                    </div>
                                                </div>
                                                <div class="col-sm-auto mt-3 mt-sm-0">
                                                    <ul
                                                        class="pagination pagination-separated pagination-sm mb-0 justify-content-center">
                                                        <li class="page-item disabled">
                                                            <a href="#" class="page-link">←</a>
                                                        </li>
                                                        <li class="page-item">
                                                            <a href="#" class="page-link">1</a>
                                                        </li>
                                                        <li class="page-item active">
                                                            <a href="#" class="page-link">2</a>
                                                        </li>
                                                        <li class="page-item">
                                                            <a href="#" class="page-link">3</a>
                                                        </li>
                                                        <li class="page-item">
                                                            <a href="#" class="page-link">→</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="card card-height-100">
                                        <div class="card-header align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1">Top Sellers</h4>

                                        </div>
                                        <!-- end card header -->

                                        <div class="card-body">
                                            <div class="table-responsive table-card">
                                                <table
                                                    class="table table-centered table-hover align-middle table-nowrap mb-0">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                VKV Builders
                                                            </td>
                                                            <td>
                                                                Coimbatore
                                                            </td>
                                                            <td>
                                                                8236873653
                                                            </td>
                                                            <td>
                                                                <span
                                                                    class="badge bg-success-subtle text-success">Active</span>
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                KAG Builders
                                                            </td>
                                                            <td>
                                                                Coimbatore
                                                            </td>
                                                            <td>
                                                                9834648370
                                                            </td>
                                                            <td>
                                                                <span
                                                                    class="badge bg-success-subtle text-success">Active</span>
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                VP Promoters
                                                            </td>
                                                            <td>
                                                                Coimbatore
                                                            </td>
                                                            <td>
                                                                9087654467
                                                            </td>
                                                            <td>
                                                                <span
                                                                    class="badge bg-success-subtle text-success">Active</span>
                                                            </td>

                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <!-- end table -->
                                            </div>

                                            <div
                                                class="align-items-center mt-4 pt-2 justify-content-between row text-center text-sm-start">
                                                <div class="col-sm">
                                                    <div class="text-muted">
                                                        Showing <span class="fw-semibold">5</span> of
                                                        <span class="fw-semibold">25</span> Results
                                                    </div>
                                                </div>
                                                <div class="col-sm-auto mt-3 mt-sm-0">
                                                    <ul
                                                        class="pagination pagination-separated pagination-sm mb-0 justify-content-center">
                                                        <li class="page-item disabled">
                                                            <a href="#" class="page-link">←</a>
                                                        </li>
                                                        <li class="page-item">
                                                            <a href="#" class="page-link">1</a>
                                                        </li>
                                                        <li class="page-item active">
                                                            <a href="#" class="page-link">2</a>
                                                        </li>
                                                        <li class="page-item">
                                                            <a href="#" class="page-link">3</a>
                                                        </li>
                                                        <li class="page-item">
                                                            <a href="#" class="page-link">→</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- .card-body-->
                                    </div>
                                    <!-- .card-->
                                </div>
                                <!-- .col-->
                            </div>
                            <!-- end row-->

                        </div>
                        <!-- end .h-100-->
                    </div>
                    <!-- end col -->

                </div>
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
    @endsection
