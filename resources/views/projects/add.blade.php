@extends('layouts.app')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid ">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex justify-content-between">
                            <div class="page-title-left">
                                <h5 class="card-title mb-0">{{ $page_title }}</h5>
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
                                    'class' => 'form-control',
                                ]) !!}
                                @csrf
                                <div class="step-arrow-nav mb-4">
                                    <ul class="nav nav-pills custom-nav nav-justified" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active done" id="general-info-tab" data-bs-toggle="pill"
                                                data-bs-target="#general-info" type="button" role="tab"
                                                aria-controls="general-info" aria-selected="false" data-position="0"
                                                tabindex="-1">General</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="floor-details-tab" data-bs-toggle="pill"
                                                data-bs-target="#floor-details" type="button" role="tab"
                                                aria-controls="floor-details" aria-selected="false" data-position="1"
                                                tabindex="-1">Floor details</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="project-description-tab" data-bs-toggle="pill"
                                                data-bs-target="#project-description" type="button" role="tab"
                                                aria-controls="project-description" aria-selected="false" data-position="2">
                                                Project Description</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="builder-details-tab" data-bs-toggle="pill"
                                                data-bs-target="#builder-details" type="button" role="tab"
                                                aria-controls="builder-details" aria-selected="false" data-position="3">
                                                Builder Details</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="images-tab" data-bs-toggle="pill"
                                                data-bs-target="#images" type="button" role="tab"
                                                aria-controls="images" aria-selected="false" data-position="4">
                                                Images</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="amenities-tab" data-bs-toggle="pill"
                                                data-bs-target="#amenities" type="button" role="tab"
                                                aria-controls="amenities" aria-selected="false" data-position="5">
                                                Amenities</button>
                                        </li>
                                    </ul>
                                </div>



                                <!-- Tab Content -->
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="general-info" role="tabpanel"
                                        aria-labelledby="general-info-tab">
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
                                                data-nexttab="floor-details-tab"><i
                                                    class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Go
                                                Next</button>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="floor-details" role="tabpanel"
                                        aria-labelledby="floor-details-tab">
                                        <div>
                                            <h5>Floor Details</h5>
                                            <p class="text-muted">Fill Floor Details</p>
                                        </div>
                                        <div class="scrollable">
                                            <table class="table table-bordered" data-repeater-list="items"
                                                id="sortable-table1">
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
                                                            <input type="hidden" id="auto_value1" value="1">
                                                            <span class="auto_inc" id="auto_inc_0">1</span>
                                                        </td>
                                                        <td>
                                                            <div class="input-group">
                                                                {!! Form::select('propertytype_id[]', $property_types, old('propertytype_id[]'), [
                                                                    'class' => 'form-select grade_dropdown',
                                                                    'id' => 'propertytype_id_0',
                                                                    'placeholder' => 'Select property type',
                                                                ]) !!}
                                                            </div>


                                                        </td>
                                                        <td>
                                                            {!! Form::number('from_sqft[]', old('from_sqft[]'), [
                                                                'class' => 'form-control builtup_area',
                                                                'id' => 'from_sqft_0',
                                                                'placeholder' => 'Enter Built-up Area (e.g., sqft)',
                                                            ]) !!}


                                                        </td>

                                                        <td>
                                                            {!! Form::number('to_sqft[]', old('to_sqft[]'), [
                                                                'class' => 'form-control builtup_area',
                                                                'id' => 'to_sqft_0',
                                                                'placeholder' => 'Enter Built-up Area (e.g., sqft)',
                                                            ]) !!}

                                                        </td>
                                                        <td>
                                                            {!! Form::number('from_price[]', old('from_price[]'), [
                                                                'class' => 'form-control base_price',
                                                                'id' => 'from_price_0',
                                                                'placeholder' => 'Enter Base Price',
                                                            ]) !!}

                                                        </td>
                                                        <td>
                                                            {!! Form::number('to_price[]', old('to_price[]'), [
                                                                'class' => 'form-control base_price',
                                                                'id' => 'to_price_0',
                                                                'placeholder' => 'Enter Base Price',
                                                            ]) !!}

                                                        </td>
                                                        <td id="remove" style="white-space: nowrap;">
                                                            <button type="button"
                                                                class="btn btn-success position-relative p-0 avatar-xs rounded add-row"
                                                                id="add-row">
                                                                <span class="avatar-title bg-transparent">
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
                                            <table class="table table-bordered" data-repeater-list="items"
                                                id="sortable-table2">
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
                                                            {!! Form::hidden('auto_value2', '1', old('auto_value2'), ['id' => 'auto_value2']) !!}
                                                            <span class="auto_inc" id="auto_inc_0">1</span>
                                                        </td>
                                                        <td>
                                                            <div class="input-group">
                                                                {!! Form::select('subpropertytype_id[]', [], old('subpropertytype_id[]'), [
                                                                    'class' => 'form-select grade_dropdown',
                                                                    'id' => 'subpropertytype_id_0',
                                                                    'placeholder' => 'Select Sub property types',
                                                                ]) !!}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            {!! Form::number('builtup_area[]', old('builtup_area[]'), [
                                                                'class' => 'form-control builtup_area',
                                                                'id' => 'builtup_area_0',
                                                                'placeholder' => 'Enter Built-up Area (e.g., sqft)',
                                                            ]) !!}
                                                        </td>
                                                        <td>
                                                            {!! Form::number('base_price[]', old('base_price[]'), [
                                                                'class' => 'form-control base_price',
                                                                'id' => 'base_price_0',
                                                                'placeholder' => 'Enter Base Price',
                                                            ]) !!}
                                                        </td>
                                                        <td id="remove" style="white-space: nowrap;">
                                                            <button type="button"
                                                                class="btn btn-success position-relative p-0 avatar-xs rounded add-row"
                                                                id="add-row">
                                                                <span class="avatar-title bg-transparent">
                                                                    <i class="ri-add-fill"></i>
                                                                </span>
                                                            </button>

                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>


                                        <div class="d-flex align-items-start gap-3 mt-4">
                                            <button type="button" class="btn btn-light btn-label previestab"
                                                data-previous="general-info-tab"><i
                                                    class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i>
                                                Back </button>
                                            <button type="button"
                                                class="btn btn-success btn-label right ms-auto nexttab nexttab"
                                                data-nexttab="project-description-tab"><i
                                                    class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>
                                                Next</button>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="project-description" role="tabpanel"
                                        aria-labelledby="project-description-tab">
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

                                        <div class="d-flex justify-content-between align-items-center gap-3 mt-4">
                                            <button type="button" class="btn btn-light btn-label previestab"
                                                data-previous="floor-details-tab">
                                                <i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i>
                                                Back
                                            </button>
                                            <button type="button" class="btn btn-success btn-label nexttab"
                                                data-nexttab="builder-details-tab">
                                                Next <i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="builder-details" role="tabpanel"
                                        aria-labelledby="builder-details-tab">
                                        <div>
                                            <h5>Builder Details</h5>
                                            <p class="text-muted">Fill Builder Details</p>
                                        </div>

                                        <div class="col-md-6">
                                            {!! Form::label('builder_id', 'Select Builder Name', ['class' => 'form-label']) !!}
                                            {!! Form::select(
                                                'builder_id', // Name should be an array
                                                isset($builders) ? ['' => 'Select Builders'] + $builders->toArray() : ['' => 'Select Builder'],
                                                old('builder_id'), // Keep old values for validation
                                                [
                                                    'class' => 'form-select',
                                                    'id' => 'builder_id',
                                                    // 'multiple' => 'multiple', // Add multiple attribute
                                                ],
                                            ) !!}
                                        </div>


                                        <div class="d-flex align-items-start gap-3 mt-4">
                                            <button type="button" class="btn btn-light btn-label previestab"
                                                data-previous="project-description-tab">
                                                <i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> Back
                                            </button>
                                            <button type="button" class="btn btn-success btn-label nexttab ms-auto"
                                                data-nexttab="images-tab">
                                                Next <i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="images" role="tabpanel"
                                        aria-labelledby="builder-details-tab">
                                        {{-- <div>
                                            <h5>Project Images</h5>
                                            <p class="text-muted">Upload Project Images</p>
                                        </div> --}}

                                        {{-- <div class="col-md-6">
                                            {!! Form::label('images', 'Select Images', ['class' => 'form-label']) !!}
                                            {!! Form::file('images[]', old('images[]'), ['multiple' => true, 'class' => 'form-control', 'id' => 'images_0']) !!}
                                        </div> --}}
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title mb-0">Project Images</h4>
                                                </div><!-- end card header -->

                                                <div class="card-body">
                                                    <div class="dropzone">
                                                        <div class="fallback">
                                                            {!! Form::file('images[]', ['multiple' => true, 'class' => 'form-control', 'id' => 'images']) !!}
                                                        </div>
                                                        <div class="dz-message needsclick">
                                                            <div class="mb-3">
                                                                <i class="display-4 text-muted ri-upload-cloud-2-fill"></i>
                                                            </div>

                                                            <h4>Drop files here or click to upload.</h4>
                                                        </div>

                                                        <ul class="list-unstyled mb-0" id="dropzone-preview">
                                                            <li class="mt-2" id="dropzone-preview-list">
                                                                <!-- This is used as the file preview template -->
                                                                <div class="border rounded">
                                                                    <div class="d-flex p-2">
                                                                        <div class="flex-shrink-0 me-3">
                                                                            <div class="avatar-sm bg-light rounded">
                                                                                <img data-dz-thumbnail
                                                                                    class="img-fluid rounded d-block"
                                                                                    src="assets/images/new-document.png"
                                                                                    alt="Dropzone-Image" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="flex-grow-1">
                                                                            <div class="pt-1">
                                                                                <h5 class="fs-14 mb-1" data-dz-name>&nbsp;
                                                                                </h5>
                                                                                <p class="fs-13 text-muted mb-0"
                                                                                    data-dz-size>
                                                                                </p>
                                                                                <strong class="error text-danger"
                                                                                    data-dz-errormessage></strong>
                                                                            </div>
                                                                        </div>
                                                                        <div class="flex-shrink-0 ms-3">
                                                                            <button data-dz-remove
                                                                                class="btn btn-sm btn-danger">Delete</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                        <!-- end dropzon-preview -->
                                                    </div>
                                                    <!-- end card body -->
                                                </div>
                                                <!-- end card -->
                                            </div>

                                            <div class="d-flex align-items-start gap-3 mt-4">
                                                <button type="button" class="btn btn-light btn-label previestab"
                                                    data-previous="builder-details-tab">
                                                    <i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i>
                                                    Back
                                                </button>
                                                <button type="button" class="btn btn-success btn-label nexttab ms-auto"
                                                    data-nexttab="amenities-tab">
                                                    Next <i
                                                        class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="amenities" role="tabpanel"
                                            aria-labelledby="amenities-tab">
                                            <div>
                                                <h5>Amenities</h5>
                                                <p class="text-muted">Fill Amenities</p>
                                            </div>

                                            <div class="hstack gap-2 flex-wrap">

                                                @foreach ($amenities as $item)
                                                    <input type="checkbox" class="btn-check" id="btn-check-outlined"
                                                        value="{{ $item->id }} " name="amenities_id">
                                                    <label class="btn btn-outline-primary shadow-none"
                                                        for="btn-check-outlined">{!! $item->name !!}</label>
                                                @endforeach



                                            </div>



                                            <div class="d-flex align-items-start gap-3 mt-4">
                                                <button type="button" class="btn btn-light btn-label previestab"
                                                    data-previous="images-tab"><i
                                                        class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i>
                                                    Back </button>
                                                <button type="submit" class="btn btn-primary btn-label right ms-auto">
                                                    Submit <i class="ri-check-line label-icon align-middle fs-16 ms-2"></i>
                                                </button>
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
    </div>



    {{-- <script>
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
    </script> --}}
    {{-- <script>
        const propertyTypeSelect = document.getElementById('propertytype_id_0');
        // console.log(propertyTypeSelect);
        const subPropertyTypeSelect = document.getElementById('subpropertytype_id_0');

        // Function to update the second select box based on the selected options in the first one
        function updateSubproperty() {
            const selectedOptions = Array.from(propertyTypeSelect.selectedOptions);
            subPropertyTypeSelect.innerHTML = ''; // Clear current options

            selectedOptions.forEach(option => {
                const newOption = document.createElement('option');
                // console.log(newOption);
                newOption.value = option.value;
                newOption.text = option.text;
                subPropertyTypeSelect.appendChild(newOption);
            });
        }

        // Listen for changes in the first select box and update the second one accordingly
        propertyTypeSelect.addEventListener('change', updateSubproperty);
    </script> --}}
    <script>
        $(document).ready(function() {
            var selectedPropertyTypes = []; // Array to store selected property types from Table 1

            // Function to initialize handlers for each table
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

                    // If it's Table 2, update the dropdown with the selected property types
                    if (tableSelector === "#sortable-table2") {
                        updateTable2Dropdowns();
                    }
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

            // Function to handle property type selection in Table 1
            $(document).ready(function() {
                const selectedPropertyTypes = []; // Array to store selected property types with IDs

                // Function to handle property type selection in Table 1
                $(document).on("change", "#sortable-table1 .form-select", function() {
                    var selectedValue = $(this).val();
                    var selectedText = $(this).find("option:selected")
                        .text(); // Get the text of the selected option
                    var selectedId = $(this).find("option:selected")
                        .val(); // Get the ID of the selected option

                    // Add the selected text and ID to the array if it doesn't exist
                    if (selectedValue && !selectedPropertyTypes.some(item => item.id ===
                            selectedId)) {
                        selectedPropertyTypes.push({
                            id: selectedId,
                            text: selectedText
                        });
                    }

                    updateTable2Dropdowns();
                });

                // Function to update dropdowns in Table 2 with selected text from Table 1
                function updateTable2Dropdowns() {
                    $("#sortable-table2 select.form-select").each(function() {
                        var selectElement = $(this);
                        selectElement.empty(); // Clear previous options
                        selectElement.append(
                            '<option value="">Select Sub property types</option>'
                        ); // Default option

                        console.log(selectedPropertyTypes);
                        // Populate the select options with the text values from Table 1
                        $.each(selectedPropertyTypes, function(index, item) {
                            selectElement.append('<option value="' + item.id + '">' + item
                                .text + '</option>');
                        });
                    });
                }


                // Initialize handlers for both tables (Your existing code for row handling)
                initializeTableHandlers("#sortable-table1", "#auto_value1");
                initializeTableHandlers("#sortable-table2", "#auto_value2");
            });
        });
    </script>
@endsection
