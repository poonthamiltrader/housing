@extends('layouts.app')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                <div class="modal fade" id="modal-sm" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content" id="modal-content">

                        </div>
                    </div>
                </div>

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex justify-content-between">
                            <div class="page-title-left">

                            </div>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item">{{ $page_title }}</li>
                                    <li class="breadcrumb-item active">{{ $module_name }}</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">{{ $page_title }}</h4>
                                </div><!-- end card header -->
                                <div class="card-body form-steps">
                                    {!! Form::model($data, [
                                        'route' => $route,
                                        'id' => 'user-form',
                                        'method' => $method,
                                        'class' => 'vertical-navs-step row g-3',
                                    ]) !!}
                                    <div class="row gy-5">
                                        <div class="col-lg-3">
                                            <div class="nav flex-column custom-nav nav-pills" role="tablist"
                                                aria-orientation="vertical">
                                                <button class="nav-link done" id="v-pills-bill-info-tab"
                                                    data-bs-toggle="pill" data-bs-target="#v-pills-bill-info" type="button"
                                                    role="tab" aria-controls="v-pills-bill-info" aria-selected="true">
                                                    <span class="step-title me-2">
                                                        <i class="ri-close-circle-fill step-icon me-2"></i> Step 1
                                                    </span>
                                                    General information
                                                </button>
                                                <button class="nav-link active" id="v-pills-bill-address-tab"
                                                    data-bs-toggle="pill" data-bs-target="#v-pills-bill-address"
                                                    type="button" role="tab" aria-controls="v-pills-bill-address"
                                                    aria-selected="false">
                                                    <span class="step-title me-2">
                                                        <i class="ri-close-circle-fill step-icon me-2"></i> Step 2
                                                    </span>
                                                    Floor details
                                                </button>
                                                <button class="nav-link" id="v-pills-payment-tab" data-bs-toggle="pill"
                                                    data-bs-target="#v-pills-payment" type="button" role="tab"
                                                    aria-controls="v-pills-payment" aria-selected="false">
                                                    <span class="step-title me-2">
                                                        <i class="ri-close-circle-fill step-icon me-2"></i> Step 3
                                                    </span>
                                                    Project_Description
                                                </button>
                                                <button class="nav-link" id="v-pills-finish-tab" data-bs-toggle="pill"
                                                    data-bs-target="#v-pills-finish" type="button" role="tab"
                                                    aria-controls="v-pills-finish" aria-selected="false">
                                                    <span class="step-title me-2">
                                                        <i class="ri-close-circle-fill step-icon me-2"></i> Step 4
                                                    </span>
                                                    Builder Details
                                                </button>
                                                <button class="nav-link" id="v-pills-finish1-tab" data-bs-toggle="pill"
                                                    data-bs-target="#v-pills-finish1" type="button" role="tab"
                                                    aria-controls="v-pills-finish1" aria-selected="false">
                                                    <span class="step-title me-2">
                                                        <i class="ri-close-circle-fill step-icon me-2"></i> Step 5
                                                    </span>
                                                    Amenities
                                                </button>
                                            </div>
                                            <!-- end nav -->
                                        </div> <!-- end col-->
                                        <div class="col-lg-6">
                                            <div class="px-lg-4">
                                                <div class="tab-content">
                                                    <div class="tab-pane fade show active" id="v-pills-bill-info"
                                                        role="tabpanel" aria-labelledby="v-pills-bill-info-tab">
                                                        <div>
                                                            <h5>General Project Info</h5>
                                                            <p class="text-muted">Fill all information below</p>
                                                        </div>



                                                        <div class="mb-3">
                                                            {!! Form::label('name', 'Name', ['class' => 'form-label']) !!}
                                                            {!! Form::text('name', old('name'), [
                                                                'class' => 'form-control',
                                                                'placeholder' => 'Enter Project Name',
                                                                'id' => 'name',
                                                            ]) !!}
                                                        </div>

                                                        <div class="row mb-3">
                                                            <div class="col-md-6">
                                                                {!! Form::label('state_id', 'Select State', ['class' => 'form-label']) !!}
                                                                {!! Form::select('state_id', ['' => 'Select State'] + $states->toArray(), old('state_id'), [
                                                                    'class' => 'form-select',
                                                                    'id' => 'state_id',
                                                                ]) !!}
                                                            </div>

                                                            <div class="col-md-6">
                                                                {!! Form::label('city_id', 'Select City', ['class' => 'form-label']) !!}
                                                                {!! Form::select(
                                                                    'city_id',
                                                                    isset($cities) ? ['' => 'Select City'] + $cities->toArray() : ['' => 'Select City'],
                                                                    old('city_id'),
                                                                    [
                                                                        'class' => 'form-select',
                                                                        'id' => 'city_id',
                                                                    ],
                                                                ) !!}
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <div class="col-md-6">
                                                                {!! Form::label('area_id', 'Select Area', ['class' => 'form-label']) !!}
                                                                {!! Form::select(
                                                                    'area_id',
                                                                    isset($areas) ? ['' => 'Select Area'] + $areas->toArray() : ['' => 'Select Area'],
                                                                    old('area_id'),
                                                                    [
                                                                        'class' => 'form-select',
                                                                        'id' => 'area_id',
                                                                    ],
                                                                ) !!}
                                                            </div>
                                                            <div class="col-md-3">
                                                                {!! Form::label('baseprice', 'Base Price', ['class' => 'form-label']) !!}
                                                                {!! Form::number('from_price', old('from_price'), [
                                                                    'class' => 'form-control',
                                                                    'placeholder' => 'Enter base price',
                                                                    'id' => 'from_price',
                                                                ]) !!}
                                                            </div>
                                                            <div class="col-md-3">
                                                                {!! Form::label('toprice', 'To Price', ['class' => 'form-label']) !!}
                                                                {!! Form::number('to_price', old('to_price'), [
                                                                    'class' => 'form-control',
                                                                    'placeholder' => 'Enter to price',
                                                                    'id' => 'to_price',
                                                                ]) !!}
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-md-6">
                                                                {!! Form::label('buildingstatus', 'Building Status', ['class' => 'form-label']) !!}
                                                                {!! Form::select(
                                                                    'building_status',
                                                                    ['1' => 'Ready to Move', '2' => 'Under Construction'],
                                                                    old('building_status'),
                                                                    [
                                                                        'class' => 'form-select',
                                                                        'id' => 'building_status',
                                                                    ],
                                                                ) !!}
                                                            </div>
                                                            <div class="col-md-6">
                                                                {!! Form::label('completiondate', 'Completion Date', ['class' => 'form-label']) !!}
                                                                {!! Form::date('completion_date', old('completion_date'), [
                                                                    'class' => 'form-control',
                                                                    'id' => 'completion_date',
                                                                ]) !!}
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-md-3">
                                                                {!! Form::label('from-sqft', 'From Sqft', ['class' => 'form-label']) !!}
                                                                {!! Form::number('from_sqft', old('from_sqft'), [
                                                                    'class' => 'form-control',
                                                                    'id' => 'from_sqft',
                                                                    'placeholder' => 'Enter from-sqft',
                                                                    'min' => 0, // Optional: Add a minimum value if needed
                                                                ]) !!}
                                                            </div>
                                                            <div class="col-md-3">
                                                                {!! Form::label('to-sqft', 'To Sqft', ['class' => 'form-label']) !!}
                                                                {!! Form::number('to_sqft', old('to_sqft'), [
                                                                    'class' => 'form-control',
                                                                    'id' => 'to_sqft',
                                                                    'placeholder' => 'Enter to-sqft',
                                                                    'min' => 0, // Optional: Add a minimum value if needed
                                                                ]) !!}
                                                            </div>
                                                            <div class="col-md-6">
                                                                {!! Form::label('status', 'Status', ['class' => 'form-label']) !!}
                                                                {!! Form::select(
                                                                    'status',
                                                                    [
                                                                        '1' => 'Active',
                                                                        '0' => 'Inactive',
                                                                    ],
                                                                    old('status'),
                                                                    [
                                                                        'class' => 'form-select',
                                                                        'id' => 'status',
                                                                    ],
                                                                ) !!}
                                                            </div>
                                                        </div>






                                                        <div class="d-flex align-items-start gap-3 mt-4">
                                                            <button type="button"
                                                                class="btn btn-success btn-label right ms-auto nexttab nexttab"
                                                                data-nexttab="v-pills-bill-address-tab"><i
                                                                    class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Go
                                                                Next</button>
                                                        </div>
                                                    </div>
                                                    <!-- end tab pane -->
                                                    <div class="tab-pane fade" id="v-pills-bill-address" role="tabpanel"
                                                        aria-labelledby="v-pills-bill-address-tab">
                                                        <div>
                                                            <h5>Floor Details</h5>
                                                            <p class="text-muted">Fill Floor Details</p>
                                                        </div>

                                                        <div>
                                                            <div class="row mb-3">
                                                                <div class="col-md-6">
                                                                    {!! Form::label('floorplan', 'Floor Plan', ['class' => 'form-label']) !!}
                                                                    {!! Form::text('floor_plan', old('floor_plan'), [
                                                                        'class' => 'form-control',
                                                                        'placeholder' => 'Enter floor plan',
                                                                        'id' => 'floor_plan',
                                                                    ]) !!}
                                                                </div>
                                                                <div class="col-md-6">
                                                                    {!! Form::label('area-details', 'Area Details', ['class' => 'form-label']) !!}
                                                                    {!! Form::text('area_details', old('area_details'), [
                                                                        'class' => 'form-control',
                                                                        'placeholder' => 'Enter area details (e.g., 100 sqft)',
                                                                        'id' => 'area_details',
                                                                    ]) !!}
                                                                </div>
                                                                <div class="col-md-6">
                                                                    {!! Form::label('price-details', 'Price Details', ['class' => 'form-label']) !!}
                                                                    {!! Form::number('price_details', old('price_details'), [
                                                                        'class' => 'form-control',
                                                                        'placeholder' => 'Enter price details (e.g., 100000)',
                                                                        'id' => 'price_details',
                                                                    ]) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-start gap-3 mt-4">
                                                            <button type="button"
                                                                class="btn btn-light btn-label previestab"
                                                                data-previous="v-pills-bill-info-tab"><i
                                                                    class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i>
                                                                Back </button>
                                                            <button type="button"
                                                                class="btn btn-success btn-label right ms-auto nexttab nexttab"
                                                                data-nexttab="v-pills-payment-tab"><i
                                                                    class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Go
                                                                to Next</button>
                                                        </div>
                                                    </div>
                                                    <!-- end tab pane -->
                                                    <div class="tab-pane fade" id="v-pills-payment" role="tabpanel"
                                                        aria-labelledby="v-pills-payment-tab">
                                                        <div>
                                                            <h5>Project Description</h5>
                                                            <p class="text-muted">Fill in your project description</p>
                                                        </div>

                                                        <div class="form-group col-12">
                                                            {!! Form::label('project_description', 'Project Description') !!}
                                                            {!! Form::textarea('project_description', old('project_description'), [
                                                                'class' => 'form-control',
                                                                'rows' => 5,
                                                                'placeholder' => 'Enter your project description here...',
                                                                'id' => 'project_description',
                                                            ]) !!}
                                                        </div>

                                                        <div
                                                            class="d-flex justify-content-between align-items-center gap-3 mt-4">
                                                            <button type="button"
                                                                class="btn btn-light btn-label previestab"
                                                                data-previous="v-pills-bill-address-tab">
                                                                <i
                                                                    class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i>
                                                                Back
                                                            </button>
                                                            <button type="button"
                                                                class="btn btn-success btn-label nexttab"
                                                                data-nexttab="v-pills-payment-tab">
                                                                Go to Next <i
                                                                    class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <!-- end tab pane -->
                                                    <div class="tab-pane fade" id="v-pills-finish" role="tabpanel"
                                                        aria-labelledby="v-pills-finish-tab">
                                                        <div>
                                                            <h5>Builder Details</h5>
                                                            <p class="text-muted">Fill Builder Details</p>
                                                        </div>

                                                        <div class="col-md-6">
                                                            {!! Form::label('builder_id', 'Select Builder Name', ['class' => 'form-label']) !!}
                                                            {!! Form::select(
                                                                'builder_id',
                                                                isset($builders) ? ['' => 'Select Builders'] + $builders->toArray() : ['' => 'Select Builder'],
                                                                old('builder_id'),
                                                                [
                                                                    'class' => 'form-select',
                                                                    'id' => 'builder_id',
                                                                ],
                                                            ) !!}

                                                        </div>


                                                        <div class="d-flex align-items-start gap-3 mt-4">
                                                            <button type="button"
                                                                class="btn btn-light btn-label previestab"
                                                                data-previous="v-pills-payment-tab"><i
                                                                    class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i>
                                                                Back </button>
                                                                <button type="button"
                                                                class="btn btn-success btn-label nexttab"
                                                                data-nexttab="v-pills-finish1-tab">
                                                                Go to Next <i
                                                                    class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <!-- end tab pane -->
                                                    <div class="tab-pane fade" id="v-pills-finish1" role="tabpanel"
                                                        aria-labelledby="v-pills-finish1-tab">
                                                        <div>
                                                            <h5>Amenities</h5>
                                                            <p class="text-muted">Fill Amenities</p>
                                                        </div>

                                                        <div class="col-lg-4">
                                                            <h6 class="fw-semibold">Multi Select</h6>
                                                            <select class="js-example-basic-multiple" name="states[]" multiple="multiple">
                                                                <optgroup label="UK">
                                                                    <option value="London">London</option>
                                                                    <option value="Manchester" selected>Manchester</option>
                                                                    <option value="Liverpool">Liverpool</option>
                                                                </optgroup>
                                                                <optgroup label="FR">
                                                                    <option value="Paris">Paris</option>
                                                                    <option value="Lyon">Lyon</option>
                                                                    <option value="Marseille">Marseille</option>
                                                                </optgroup>
                                                                
                                                            </select>
                                                        </div>
                                                       


                                                        <div class="d-flex align-items-start gap-3 mt-4">
                                                            <button type="button"
                                                                class="btn btn-light btn-label previestab"
                                                                data-previous="v-pills-finish-tab"><i
                                                                    class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i>
                                                                Back </button>
                                                            <button type="submit"
                                                                class="btn btn-primary btn-label right ms-auto">
                                                                Submit <i
                                                                    class="ri-check-line label-icon align-middle fs-16 ms-2"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <!-- end tab pane -->
                                                </div>
                                                <!-- end tab content -->
                                            </div>
                                        </div>
                                        <!-- end col -->


                                    </div>
                                    <!-- end row -->
                                    {!! Form::close() !!}
                                </div>
                            </div>
                            <!-- end -->
                        </div>
                        <!-- end col -->
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
    </div>
@endsection
