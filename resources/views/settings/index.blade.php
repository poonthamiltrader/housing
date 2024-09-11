@extends('layouts.app')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xxl-12">
                        <div class="card mt-xxl-n7">
                            <div class="card-header">
                                <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails"
                                            role="tab">
                                            <i class="fas fa-home"></i> Settings
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#email-settings" role="tab">
                                            <i class="far fa-user"></i> Mail Settings
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body p-4">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                        {!! Form::model($data, [
                                            'route' => ['settings.update', $data->id],
                                            'id' => 'settings-form',
                                            'method' => 'PUT',
                                            'files' => true,
                                        ]) !!}
                                        <div class="row mb-3">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    {!! Form::label('company_logo', 'Company Logo', ['class' => 'form-label']) !!}
                                                    <div class="text-center">
                                                        <div
                                                            class="profile-user position-relative d-inline-block mx-auto mb-4">
                                                            <!-- Display the current logo or a default image if not set -->
                                                            <img id="company-logo-preview"
                                                                src="{{ $data->logo_path ? asset($data->logo_path) : asset('assets/images/default-avatar.jpg') }}"
                                                                class="rounded-circle avatar-xl img-thumbnail user-profile-image material-shadow"
                                                                alt="user-profile-image">

                                                            <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                                                {!! Form::file('company_logo', ['id' => 'profile-img-file-input', 'class' => 'profile-img-file-input']) !!}
                                                                <label for="profile-img-file-input"
                                                                    class="profile-photo-edit avatar-xs">
                                                                    <span
                                                                        class="avatar-title rounded-circle bg-light text-body material-shadow">
                                                                        <i class="ri-camera-fill"></i>
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    {!! Form::label('company_name', 'Company Name', ['class' => 'form-label']) !!}
                                                    {!! Form::text('company_name', old('company_name'), [
                                                        'class' => 'form-control',
                                                        'placeholder' => 'Enter company name',
                                                        'id' => 'company_name',
                                                    ]) !!}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    {!! Form::label('email', 'Email Address', ['class' => 'form-label']) !!}
                                                    {!! Form::email('email', old('email'), [
                                                        'class' => 'form-control',
                                                        'placeholder' => 'Enter your email',
                                                        'id' => 'email',
                                                    ]) !!}
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    {!! Form::label('gst_no', 'GST No', ['class' => 'form-label']) !!}
                                                    {!! Form::text('gst_no', old('gst_no'), [
                                                        'class' => 'form-control',
                                                        'placeholder' => 'Enter GST no',
                                                        'id' => 'gst_no',
                                                    ]) !!}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    {!! Form::label('ph_no', 'Phone Number', ['class' => 'form-label']) !!}
                                                    {!! Form::text('ph_no', old('ph_no'), [
                                                        'class' => 'form-control',
                                                        'placeholder' => 'Enter your phone number',
                                                        'id' => 'ph_no',
                                                    ]) !!}
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    {!! Form::label('date_format', 'Date Format', ['class' => 'form-label']) !!}
                                                    {!! Form::select('date_format', $dateFormats, old('date_format'), [
                                                        'class' => 'form-select',
                                                        'id' => 'date_format',
                                                    ]) !!}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    {!! Form::label('footer', 'Footer', ['class' => 'form-label']) !!}
                                                    {!! Form::text('footer', old('footer'), [
                                                        'class' => 'form-control',
                                                        'placeholder' => 'Enter your footer',
                                                        'id' => 'footer',
                                                    ]) !!}
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    {!! Form::label('footer_url', 'Footer URL', ['class' => 'form-label']) !!}
                                                    {!! Form::text('footer_url', old('footer_url'), [
                                                        'class' => 'form-control',
                                                        'id' => 'footer_url',
                                                    ]) !!}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    {!! Form::label('address', 'Address', ['class' => 'form-label']) !!}
                                                    {!! Form::textarea('address', old('address'), [
                                                        'class' => 'form-control',
                                                        'id' => 'address',
                                                        'rows' => 3,
                                                    ]) !!}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-end mt-3">
                                            {!! Form::submit('Update Changes', ['class' => 'btn btn-success']) !!}
                                        </div>
                                        {!! Form::close() !!}
                                    </div>

                                    <div class="tab-pane" id="email-settings" role="tabpanel">
                                        {!! Form::model($email_data, [
                                            'route' => ['settings.email_update', $email_data->id],
                                            'id' => 'email-settings-form',
                                            'method' => 'PUT',
                                        ]) !!}
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    {!! Form::label('mail_mailer', 'MAIL_MAILER', ['class' => 'form-label']) !!}
                                                    {!! Form::text('mail_mailer', old('mail_mailer'), [
                                                        'class' => 'form-control',
                                                        'placeholder' => 'Enter mail mailer',
                                                        'id' => 'mail_mailer',
                                                    ]) !!}
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    {!! Form::label('mail_host', 'MAIL_HOST', ['class' => 'form-label']) !!}
                                                    {!! Form::text('mail_host', old('mail_host'), [
                                                        'class' => 'form-control',
                                                        'placeholder' => 'Enter mail host',
                                                        'id' => 'mail_host',
                                                    ]) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    {!! Form::label('mail_encryption', 'MAIL_ENCRYPTION', ['class' => 'form-label']) !!}
                                                    {!! Form::select(
                                                        'mail_encryption',
                                                        ['' => 'Select Mail Encryption', 'TLS' => 'TLS', 'SSL' => 'SSL'],
                                                        old('mail_encryption'),
                                                        ['class' => 'form-select mb-3', 'id' => 'mail_encryption'],
                                                    ) !!}
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    {!! Form::label('mail_port', 'MAIL_PORT', ['class' => 'form-label']) !!}
                                                    {!! Form::text('mail_port', old('mail_port'), [
                                                        'class' => 'form-control',
                                                        'placeholder' => 'Enter mail port',
                                                        'id' => 'mail_port',
                                                        'readonly' => true,
                                                    ]) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    {!! Form::label('mail_username', 'MAIL_USERNAME', ['class' => 'form-label']) !!}
                                                    {!! Form::text('mail_username', old('mail_username'), [
                                                        'class' => 'form-control',
                                                        'placeholder' => 'Enter mail username',
                                                        'id' => 'mail_username',
                                                    ]) !!}
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    {!! Form::label('mail_password', 'MAIL_PASSWORD', ['class' => 'form-label']) !!}
                                                    {!! Form::password('mail_password', [
                                                        'class' => 'form-control',
                                                        'placeholder' => 'Enter mail password',
                                                        'id' => 'mail_password',
                                                    ]) !!}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    {!! Form::label('mail_from_address', 'MAIL_FROM_ADDRESS', ['class' => 'form-label']) !!}
                                                    {!! Form::text('mail_from_address', old('mail_from_address'), [
                                                        'class' => 'form-control',
                                                        'placeholder' => 'Enter mail from address',
                                                        'id' => 'mail_from_address',
                                                    ]) !!}
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    {!! Form::label('mail_from_name', 'MAIL_FROM_NAME', ['class' => 'form-label']) !!}
                                                    {!! Form::text('mail_from_name', old('mail_from_name'), [
                                                        'class' => 'form-control',
                                                        'placeholder' => 'Enter mail from name',
                                                        'id' => 'mail_from_name',
                                                    ]) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-end mt-3">
                                            {!! Form::submit('Update Email Settings', ['class' => 'btn btn-success']) !!}
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
    </div>

    <script>
        const showToast1 = (message, status) => {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: true,
                timer: 3000,
                timerProgressBar: true
            });
            Toast.fire({
                icon: status,
                title: message,
            });
        };
        document.addEventListener('DOMContentLoaded', function() {
            // submit
            async function handleFormSubmit(event) {
                event.preventDefault();

                const form = event.target;
                const formData = new FormData(form);

                try {
                    const response = await fetch(form.getAttribute('action'), {
                        method: form.getAttribute('method'),
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    if (!response.ok) {
                        const data = await response.json();
                        document.querySelectorAll(".error").forEach((el) => el.remove());

                        if (response.status === 422) {
                            for (const [key, value] of Object.entries(data.errors)) {
                                const input = document.querySelector(`[name="${key}"]`);
                                if (input) {
                                    input.insertAdjacentHTML(
                                        "afterend",
                                        `<span class="error">${value.join(', ')}</span>`
                                    );
                                }
                            }
                        } else if (response.status === 500) {
                            showToast("Error!", "Internal Server Error", "error");
                        } else {
                            if (response.redirected) {
                                console.warn("Request was redirected");
                            }
                        }
                    } else {
                        const data = await response.json();
                        showToast(data.message, "success");
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                    }
                } catch (error) {
                    showToast('There was an error with your submission.', "error");
                }
            }

            document.querySelectorAll('#settings-form, #email-settings-form').forEach(form => {
                form.addEventListener('submit', handleFormSubmit);
            });

            // onchange mail encryption
            const mailEncryptionSelect = document.getElementById('mail_encryption');
            const mailPortInput = document.getElementById('mail_port');

            mailEncryptionSelect.addEventListener('change', function() {
                const selectedValue = this.value;
                let portValue;

                switch (selectedValue) {
                    case 'TLS':
                        portValue = '587';
                        break;
                    case 'SSL':
                        portValue = '465';
                        break;
                    default:
                        portValue = '';
                        break;
                }

                mailPortInput.value = portValue;
            });
        });
    </script>
@endsection
