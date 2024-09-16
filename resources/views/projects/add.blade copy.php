@extends('layouts.app')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid ">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex justify-content-between">
                            <div class="page-title-left">
                                {{-- Page title --}}
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
                            <div class="form-steps">
                                {!! Form::model($data, [
                                    'route' => $route,
                                    'id' => 'user-form',
                                    'method' => $method,
                                    'class' => 'vertical-navs-step row g-3',
                                ]) !!}
                                @csrf
                                <div class="row gy-3">
                                    <div class="col-lg-3">
                                        <div class="card custom-card1" id="wizard-card">
                                            <div class="card-body">
                                                <div class="nav flex-column custom-nav nav-pills" role="tablist"
                                                    aria-orientation="vertical">
                                                    <button class="nav-link active" id="v-pills-bill-info-tab"
                                                        data-bs-toggle="pill" data-bs-target="#v-pills-bill-info"
                                                        type="button" role="tab" aria-controls="v-pills-bill-info"
                                                        aria-selected="true">
                                                        <span class="step-title me-2">
                                                            <i class="ri-close-circle-fill step-icon me-2"></i> Step 1
                                                        </span>
                                                        General information
                                                    </button>
                                                    <button class="nav-link " id="v-pills-bill-address-tab"
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
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="card">
                                            <div class="card-body custom-card2">
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
                                                        <div class="tab-pane fade" id="v-pills-bill-address"
                                                            role="tabpanel" aria-labelledby="v-pills-bill-address-tab">
                                                            <div>
                                                                <h5>Floor Details</h5>
                                                                <p class="text-muted">Fill Floor Details</p>
                                                            </div>
                                                            <div class="scrollable">
                                                                <table class="table table-bordered"
                                                                    data-repeater-list="items" id="sortable-table1">
                                                                    <thead>
                                                                        <tr>
                                                                            <th width="3%">#</th>
                                                                            <th>Property Types</th>
                                                                            <th>From Sqft</th>
                                                                            <th>To Sqft</th>
                                                                            <th>From Price</th>
                                                                            <th>To Price</th>
                                                                            <th>Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr class="table-active">
                                                                            <td>
                                                                                <input type="hidden" id="auto_value1"
                                                                                    value="1">
                                                                                <span class="auto_inc"
                                                                                    id="auto_inc_0">1</span>
                                                                            </td>
                                                                            <td>
                                                                                <div class="input-group">
                                                                                    <select
                                                                                        class="form-select grade_dropdown"
                                                                                        name="propertytype_id[]"
                                                                                        id="propertytype_id_0">
                                                                                        <option value="">Select
                                                                                            property types</option>
                                                                                    </select>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <input type="number"
                                                                                    class="form-control builtup_area"
                                                                                    name="from_sqft[]" id="from_sqft_0"
                                                                                    placeholder="Enter Built-up Area (e.g., sqft)">
                                                                            </td>
                                                                            <td>
                                                                                <input type="number"
                                                                                    class="form-control builtup_area"
                                                                                    name="to_sqft[]" id="to_sqft_0"
                                                                                    placeholder="Enter Built-up Area (e.g., sqft)">
                                                                            </td>
                                                                            <td>
                                                                                <input type="number"
                                                                                    class="form-control base_price"
                                                                                    id="from_price_0" name="from_price[]"
                                                                                    placeholder="Enter Base Price">
                                                                            </td>
                                                                            <td>
                                                                                <input type="number"
                                                                                    class="form-control base_price"
                                                                                    id="to_price_0" name="to_price[]"
                                                                                    placeholder="Enter Base Price">
                                                                            </td>
                                                                            <td id="remove"
                                                                                style="white-space: nowrap;">
                                                                                <button type="button"
                                                                                    class="btn btn-success position-relative p-0 avatar-xs rounded add-row"
                                                                                    id="add-row">
                                                                                    <span
                                                                                        class="avatar-title bg-transparent">
                                                                                        <i class="ri-add-fill"></i>
                                                                                    </span>
                                                                                </button>

                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>

                                                            <hr style="padding:10px 0px;">
                                                            <div>
                                                                <h5>Sub-floor Details</h5>
                                                            </div>
                                                            <div class="scrollable">
                                                                <table class="table table-bordered"
                                                                    data-repeater-list="items" id="sortable-table2">
                                                                    <thead>
                                                                        <tr>
                                                                            <th width="3%">#</th>
                                                                            <th>Property Types</th>
                                                                            <th>Built-up Area</th>
                                                                            <th>Base Price</th>
                                                                            <th>Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr class="table-active">
                                                                            <td>
                                                                                <input type="hidden" id="auto_value2"
                                                                                    value="1">
                                                                                <span class="auto_inc"
                                                                                    id="auto_inc_0">1</span>
                                                                            </td>
                                                                            <td>
                                                                                <div class="input-group">
                                                                                    <select
                                                                                        class="form-select grade_dropdown"
                                                                                        name="subsubpropertytype_id[]"
                                                                                        id="subpropertytype_id_0">
                                                                                        <option value="">Select
                                                                                            Sub property types</option>
                                                                                    </select>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <input type="number"
                                                                                    class="form-control builtup_area"
                                                                                    name="builtup_area[]"
                                                                                    id="builtup_area_0"
                                                                                    placeholder="Enter Built-up Area (e.g., sqft)">
                                                                            </td>
                                                                            <td>
                                                                                <input type="number"
                                                                                    class="form-control base_price"
                                                                                    id="base_price_0" name="base_price[]"
                                                                                    placeholder="Enter Base Price">
                                                                            </td>
                                                                            <td id="remove"
                                                                                style="white-space: nowrap;">
                                                                                <button type="button"
                                                                                    class="btn btn-success position-relative p-0 avatar-xs rounded add-row"
                                                                                    id="add-row">
                                                                                    <span
                                                                                        class="avatar-title bg-transparent">
                                                                                        <i class="ri-add-fill"></i>
                                                                                    </span>
                                                                                </button>

                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
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
                                                                        class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>
                                                                    Next</button>
                                                            </div>
                                                        </div>
                                                        <!-- end tab pane -->
                                                        <div class="tab-pane fade" id="v-pills-payment" role="tabpanel"
                                                            aria-labelledby="v-pills-payment-tab">
                                                            <div>
                                                                <h5>Project Description</h5>
                                                                <p class="text-muted">Fill in your project description
                                                                </p>
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
                                                                    data-nexttab="v-pills-finish-tab">
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
                                                                    Next <i
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

                                                            <div class="hstack gap-2 flex-wrap">

                                                                @foreach ($amenities as $item)
                                                                    <input type="checkbox" class="btn-check"
                                                                        id="btn-check-outlined"
                                                                        value="{{ $item->id }}">
                                                                    <label class="btn btn-outline-primary shadow-none"
                                                                        for="btn-check-outlined">{!! $item->name !!}</label>
                                                                @endforeach



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
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('.nav-link');

            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    // Remove the 'active' class from all nav links
                    navLinks.forEach(link => link.classList.remove('active'));

                    // Add the 'active' class to the clicked tab
                    this.classList.add('active');
                });
            });
        });

        $(document).ready(function() {

            function initializeTableHandlers(tableSelector, autoValueSelector) {
                var uniqueIdCounter = 0;
                var autoIncCounter = parseInt($(autoValueSelector).val());

                // Add row function
                $(document).on("click", tableSelector + " .add-row", function() {

                    autoIncCounter++;
                    $(autoValueSelector).val(autoIncCounter);

                    var newRow = $(tableSelector + " tbody tr:last").clone();
                    var uniqueId = ++uniqueIdCounter;
                    newRow.attr("id", "row_" + uniqueId);
                    newRow.find(".auto_inc").attr("id", "auto_inc_" + autoIncCounter).text(autoIncCounter);
                    newRow.find('span.error').remove();

                    newRow.find('input[type="text"], select').each(function(index) {
                        var name = $(this).attr('id');
                        name = name.slice(0, -2);
                        $(this).attr("id", name + "." + uniqueId);
                    });

                    if ($(tableSelector + " tbody tr").length === 1) {
                        newRow.find('#remove').empty().append(
                            '<button type="button" class="btn btn-success avatar-xs me-2 rounded add-row" id="add-row">' +
                            '<span class="avatar-title bg-transparent">' +
                            '<i class="ri-add-fill"></i>' +
                            '</span>' +
                            '</button>' +
                            '<button type="button" class="btn btn-danger avatar-xs rounded remove-row">' +
                            '<span class="avatar-title bg-transparent">' +
                            '<i class="ri-subtract-fill"></i>' +
                            '</span>' +
                            '</button>'
                        );
                    }

                    $(tableSelector + " tbody").append(newRow);
                });

                // Remove row function
                $(document).on("click", tableSelector + " .remove-row", function() {
                    var currentRow = $(this).closest('tr');
                    var removedId = currentRow.attr('id').split('_')[1];
                    currentRow.remove();
                    autoIncCounter--;
                    $(autoValueSelector).val(autoIncCounter);

                    // Update uniqueIdCounter when row is removed
                    uniqueIdCounter--;

                    // Update all rows after the removed row
                    $(tableSelector + " tbody tr").each(function(index) {
                        if (index >= removedId) {
                            var newRowId = "row_" + index;
                            $(this).attr("id", newRowId);
                            $(this).find('.auto_inc').text(index + 1);

                            $(this).find('input[type="text"], select').each(function() {
                                var idParts = $(this).attr('id').split('.');
                                var newName = idParts[0] + "." + index;
                                $(this).attr("id", newName);
                            });
                        }
                    });
                });
            }

            // Initialize handlers for two different tables
            initializeTableHandlers("#sortable-table1", "#auto_value1");
            initializeTableHandlers("#sortable-table2", "#auto_value2");

        });
    </script>
@endsection
