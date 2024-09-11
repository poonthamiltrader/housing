<div class="modal-header">
    <h5 class="modal-title" id="state-add-label">{{ $page_title }} {{ $module_name }}</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    {{ Form::model($data, ['route' => $route, 'id' => 'user-form', 'method' => $method]) }}

    <div class="mb-3">
        {!! Form::label('name', 'Builder Name', ['class' => 'form-label']) !!}
        {!! Form::text('name', old('name'), [
            'class' => 'form-control',
            'placeholder' => 'Enter Builder Name',
            'id' => 'name',
        ]) !!}
    </div>
    <div class="mb-3">
        {!! Form::label('address1', 'Address ') !!}
        {!! Form::textarea('address_1', old('address_1'), [
            'class' => 'form-control',
            'rows' => 2,
            'placeholder' => 'Enter your Address here...',
            'id' => 'address_1',
        ]) !!}
    </div>
    <div class="mb-3">
        {!! Form::label('Mobile', 'Contact Number ') !!}
        {!! Form::number('Mobile', old('Mobile'), [
            'class' => 'form-control',
            'rows' => 2,
            'placeholder' => 'Enter Mobile Number',
            'id' => 'Mobile',
        ]) !!}
    </div>
    <div class="mb-3">
        {!! Form::label('description', 'Builder Description') !!}
        {!! Form::textarea('description', old('description'), [
            'class' => 'form-control',
            'rows' => 2,
            'placeholder' => 'Enter your description here...',
            'id' => 'description',
        ]) !!}
    </div>



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
