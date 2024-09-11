<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>Sign In | Housing</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('public/assets/images/favicon.ico') }}">

    <!-- Layout config Js -->
    <script src="{{ asset('public/assets/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('public/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('public/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('public/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ asset('public/assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />

    <style>
        .error_input {
            color: #ff0000;
            margin-left: 5px;
            font-size: 12px;
            font-weight: bold;
            display: none;
        }
    </style>
</head>

<body>

    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>

            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <a href="index.html" class="d-inline-block auth-logo">
                                    <img src="{{ asset('public/assets/images/logo-light.png') }}" alt=""
                                        height="20">
                                </a>
                            </div>
                            <p class="mt-3 fs-15 fw-medium">Admin Login</p>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">

                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Welcome Back !</h5>
                                    <p class="text-muted">Sign in to continue to Admin.</p>
                                </div>
                                <div class="row">
                                    <span class="error_input"></span>
                                </div>
                                <div class="p-2 mt-4">
                                    <form class="login-form" id="login-form" method="POST"
                                        action="{{ route('login') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="text" name="email"
                                                class="form-control @error('email') is-invalid @enderror" id="username"
                                                placeholder="Enter username">
                                            @error('email')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">

                                            <label class="form-label" for="password-input">Password</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input type="password" name="password"
                                                    class="form-control pe-5 password-input"
                                                    placeholder="Enter password" id="password-input">
                                                <button
                                                    class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted shadow-none password-addon"
                                                    type="button" id="password-addon"><i
                                                        class="ri-eye-fill align-middle"></i></button>
                                            </div>
                                        </div>

                                        <div class="mt-4">
                                            <button class="btn btn-success w-100" type="submit">Sign In</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0 text-muted">&copy;
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> @ Hawkeye Digitech
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="{{ asset('public/assets/js/pages/jquery.min.js') }}"></script>

    <script src="{{ asset('/public/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/public/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('/public/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('/public/assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('/public/assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('/public/assets/js/plugins.js') }}"></script>

    <!-- particles js -->
    <script src="{{ asset('/public/assets/libs/particles.js/particles.js') }}"></script>
    <!-- particles app js -->
    <script src="{{ asset('/public/assets/js/pages/particles.app.js') }}"></script>
    <!-- password-addon init -->
    <script src="{{ asset('/public/assets/js/pages/password-addon.init.js') }}"></script>

    <script>
        $('form#login-form').on('submit', function(e) {
            e.preventDefault();
            var _this = $(this);
            let data = new FormData(_this[0]);
            $('#loading').show();
            if (_this.find('input[name=_method]').val()) {
                var _method = _this.find('input[name=_method]').val();
            } else {
                var _method = 'POST';
            }
            _this.find('span.error_msg').remove();
            _this.find('div.form-group').removeClass('has-error');
            $.ajax({
                url: _this.attr('action'),
                type: 'post',
                data,
                processData: false,
                contentType: false,
                success: function(response) {

                    if (_method === "DELETE") {
                        // window.location.href = response.redirect_url;
                    } else {
                        window.location.href = response.redirect_url;
                    }
                },
                error: function(response) {
                    // alert(response.status);
                    _this.find('span.error_msg').remove();
                    _this.find('div.form-group').removeClass('has-error');
                    $('#loading').hide();
                    if (response.status === 422) {
                        //var response = $.parseJSON(response.responseText);
                        console.log(response.responseText);
                        $.each(response.errors, function(key, value) {
                            _this.find('input[name=' + key + '], select[name=' + key +
                                '], textarea[name=' + key + ']').parent().addClass(
                                'has-error');
                            _this.find('input[name=' + key + '], select[name=' + key +
                                '], textarea[name=' + key + ']').after(
                                '<span class="error_msg"> ' + value + ' </span>');
                        });
                    }
                    if (response.status === 401) {
                        var response = $.parseJSON(response.responseText);
                        $(".error_input").show();
                        $(".error_input").text(response.msg);
                        $('.error_input').delay(5000).fadeOut('slow');
                    }
                }
            })

        });
    </script>
</body>

</html>
