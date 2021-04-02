@extends('backend.layouts.app')

@section('main-content')
    <div class="hold-transition login-page">
        <div class="register-box">
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <a href="../../index2.html" class="h1"><b>Admin</b> Register</a>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">Register a new membership</p>

                    <form action="{{ route('admin.register') }}" method="POST" id="regiterValidate">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" name="name" class="form-control" placeholder="Full name">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                            <font style="color: red;">{{ ($errors->has('name'))? $errors->first('name') : " " }}</font>
                        </div>
                        <div class="input-group mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                            <font style="color: red;">{{ ($errors->has('email'))? $errors->first('email') : " " }}</font>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" name="phone_number" class="form-control" placeholder="Phone Number">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-phone"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            <font style="color: red;">{{ ($errors->has('password'))? $errors->first('password') : " " }}</font>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Retype password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            <font style="color: red;">{{ ($errors->has('password_confirmation'))? $errors->first('password_confirmation') : " " }}</font>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                                    <label for="agreeTerms">
                                        I agree to the <a href="#">terms</a>
                                    </label>
                                </div>
                                <font style="color: red;">{{ ($errors->has('terms'))? $errors->first('terms') : " " }}</font>
                            </div>
                            <!-- /.col -->
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block">Register</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>

                    <div class="social-auth-links text-center">
                        <a href="#" class="btn btn-block btn-primary">
                            <i class="fab fa-facebook mr-2"></i>
                            Sign up using Facebook
                        </a>
                        <a href="#" class="btn btn-block btn-danger">
                            <i class="fab fa-google-plus mr-2"></i>
                            Sign up using Google+
                        </a>
                    </div>

                    <a href="{{ route('admin.login') }}" class="text-center">I already have a membership</a>
                </div>
                <!-- /.form-box -->
            </div><!-- /.card -->
        </div>
        <!-- /.register-box -->
    </div>
    <script>
        $(function () {
            $('#regiterValidate').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    password: {
                        required: true,
                        minlength: 5
                    },
                    password_confirmation: {
                        required: true,
                        equalTo: '#password'
                    },
                    terms: {
                        required: true
                    },
                },
                messages: {
                    name: {
                        required: "Please enter a your name",
                    },
                    email: {
                        required: "Please enter a email address",
                        email: "Please enter a valid email address"
                    },
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long"
                    },
                    password_confirmation: {
                        required: "Please provide a confirm password",
                        equalTo: "Password does not match"
                    },
                    terms: "Please accept our terms"
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endsection
