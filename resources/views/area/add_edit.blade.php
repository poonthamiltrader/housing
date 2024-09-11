<div class="modal-header">
    <h5 class="modal-title" id="state-add-label">{{ $page_title }} {{ $module_name }}</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    {{ Form::model($data, ['route' => $route, 'id' => 'user-form', 'method' => $method, 'class' => 'row g-3']) }}

    <div class="mb-3">
        {!! Form::label('name', 'Area Name', ['class' => 'form-label']) !!}
        {!! Form::text('name', old('name'), [
            'class' => 'form-control',
            'placeholder' => 'Enter Area Name',
            'id' => 'name',
        ]) !!}
    </div>

    {{-- <div class="mb-3">
            {!! Form::label('code', 'City Code', ['class' => 'form-label']) !!}
            {!! Form::text('code', old('code'), [
                'class' => 'form-control',
                'placeholder' => 'Enter Code',
                'id' => 'code',
            ]) !!}
            @error('code')
                <div class="validation_error">{{ $message }}</div>
            @enderror
        </div> --}}

    <div class="mb-3">
        {!! Form::label('state_id', 'Select State', ['class' => 'form-label']) !!}
        {!! Form::select(
            'state_id',
            isset($states) ? ['' => 'Select State'] + $states->toArray() : ['' => 'Select State'],
            old('state_id'),
            [
                'class' => 'form-select',
                'id' => 'state_id',
            ],
        ) !!}
    </div>

    <div class="mb-3">
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


    <div class="mb-3">
        {!! Form::label('status', 'Status', ['class' => 'form-label']) !!}
        {!! Form::select('status', ['1' => 'Active', '2' => 'Inactive'], old('status'), [
            'class' => 'form-select',
            'id' => 'status',
        ]) !!}
    </div>

    <div class="col-lg-12">
        <div class="text-end">
            {!! Form::submit('Submit', ['class' => 'btn btn-primary', 'id' => 'submit-button']) !!}
        </div>
    </div>
    <!--end col-->
    {{ Form::close() }}
</div>
