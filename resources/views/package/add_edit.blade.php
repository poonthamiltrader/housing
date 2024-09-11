<div class="modal-header">
    <h5 class="modal-title" id="state-add-label">{{ $page_title }} {{ $module_name }}</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    {{ Form::model($data, ['route' => $route, 'id' => 'user-form', 'method' => $method, 'class' => 'row g-3']) }}

    <div class="row">
        <div class="col-md-6 mb-3">
            {!! Form::label('name', 'Name', ['class' => 'form-label']) !!}
            {!! Form::text('name', old('name'), [
                'class' => 'form-control',
                'placeholder' => 'Enter Name',
                'id' => 'name',
            ]) !!}
        </div>
        <div class="col-md-6 mb-3">
            {!! Form::label('price', 'Price', ['class' => 'form-label']) !!}
            {!! Form::text('price', old('price'), [
                'class' => 'form-control',
                'placeholder' => 'Enter Price',
                'id' => 'price',
            ]) !!}
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            {!! Form::label('period', 'Period', ['class' => 'form-label']) !!}
            {!! Form::text('period', old('period'), [
                'class' => 'form-control',
                'placeholder' => 'Enter Period',
                'id' => 'period',
            ]) !!}
        </div>
        <div class="col-md-6 mb-3">
            {!! Form::label('no_of_listing', 'No of Listing', ['class' => 'form-label']) !!}
            {!! Form::text('no_of_listing', old('no_of_listing'), [
                'class' => 'form-control',
                'placeholder' => 'Enter No of Listing',
                'id' => 'no_of_listing',
            ]) !!}
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            {!! Form::label('discount', 'Discount', ['class' => 'form-label']) !!}
            {!! Form::text('discount', old('discount'), [
                'class' => 'form-control',
                'placeholder' => 'Enter Discount',
                'id' => 'discount',
            ]) !!}
        </div>
        <div class="col-md-6 mb-3">
            {!! Form::label('user_type', 'Select User Type', ['class' => 'form-label']) !!}
            {!! Form::select('user_type', ['1' => 'Seller', '2' => 'Buyer'], old('user_type'), [
                'class' => 'form-select',
                'placeholder' => 'Select User Type',
                'id' => 'user_type',
            ]) !!}
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            {!! Form::label('status', 'Status', ['class' => 'form-label']) !!}
            {!! Form::select('status', ['1' => 'Active', '2' => 'Inactive'], old('status'), [
                'class' => 'form-select',
                'id' => 'status',
            ]) !!}
        </div>
    </div>

    <div class="col-lg-12">
        <div class="text-end">
            {!! Form::submit('Submit', ['class' => 'btn btn-primary', 'id' => 'submit-button']) !!}
        </div>
    </div>
    <!--end col-->
    {{ Form::close() }}
</div>
