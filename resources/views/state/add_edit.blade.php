<div class="modal-header">
    <h5 class="modal-title" id="state-add-label">{{ $page_title }} {{ $module_name }}</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    {{ Form::model($data, ['route' => $route, 'id' => 'user-form', 'method' => $method]) }}
    <div class="mb-3">
        {!! Form::label('name', 'State Name', ['class' => 'form-label']) !!}
        {!! Form::text('name', old('name'), [
            'class' => 'form-control',
            'placeholder' => 'Enter State Name',
            'id' => 'name',
        ]) !!}
    </div>

    {{-- <div class="mb-3">
        {!! Form::label('code', 'State Code', ['class' => 'form-label']) !!}
        {!! Form::text('code', old('code'), [
            'class' => 'form-control',
            'placeholder' => 'Enter Code',
            'id' => 'code',
        ]) !!}
        @error('state_code')
            <div class="validation_error">{{ $message }}</div>
        @enderror
    </div> --}}

    <div class="mb-3">
        {!! Form::label('status', 'Status', ['class' => 'form-label']) !!}
        {!! Form::select('status', ['1' => 'Active', '2' => 'Inactive'], old('status'), [
            'class' => 'form-select',
            'id' => 'status',
        ]) !!}
    </div>

    <div class="text-end">
        {!! Form::submit('Submit', ['class' => 'btn-primary btn', 'id' => 'submit-button']) !!}
    </div>
    {!! Form::close() !!}
</div>
