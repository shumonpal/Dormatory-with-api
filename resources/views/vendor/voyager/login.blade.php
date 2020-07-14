<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" dir="{{ __('voyager::generic.is_rtl') == 'true' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="none" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="admin login">
    <title>Admin - {{ Voyager::setting("admin.title") }}</title>
    <link rel="stylesheet" href="{{ voyager_asset('css/app.css') }}">
    @if (__('voyager::generic.is_rtl') == 'true')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.4.0/css/bootstrap-rtl.css">
    <link rel="stylesheet" href="{{ voyager_asset('css/rtl.css') }}">
    @endif
    @php
        $body_bg = Voyager::setting("admin.bg_color", "#FFFFFF");
        $body_login_sidebar_border_top = config('voyager.primary_color', '#22A7F0');
        $registrationContainer_display = session('regi_failed') ? 'block': 'none';
    @endphp
    <style>
        
        body {
            background-image:url('{{ Voyager::image( Voyager::setting("admin.bg_image"), voyager_asset("images/bg.jpg") ) }}');

            background-color: {{$body_bg}};
        }

        body.login .login-sidebar {
            border-top:5px solid {{$body_login_sidebar_border_top}};
        }

        @media (max-width: 767px) {
            body.login .login-sidebar {
                border-top: 0px !important;

                border-left:5px solid {{$body_login_sidebar_border_top}};
            }
        }

        body.login .form-group-default.focused {
            border-color: {{$body_login_sidebar_border_top}};;
        }

        .login-button,
        .bar:before,
        .bar:after {
            background: {{$body_login_sidebar_border_top}};
        }

        .remember-me-text {
            padding: 0 5px;
        }

        #registrationContainer {
            position: absolute;
            z-index: 10;
            width: 100%;
            padding: 30px;
            top: 25%;
            margin-top: -150px;

            display: {{$registrationContainer_display}};
        }

        #registrationContainer input {
            border: .5px solid #ccccccd9;
        }
    </style>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
</head>

<body class="login">
    <div class="container-fluid">
        <div class="row">
            <div class="faded-bg animated"></div>
            <div class="hidden-xs col-sm-7 col-md-8">
                <div class="clearfix">
                    <div class="col-sm-12 col-md-10 col-md-offset-2">
                        <div class="logo-title-container">
                            <?php $admin_logo_img = Voyager::setting('admin.icon_image', ''); ?>
                            @if($admin_logo_img == '')
                            <img class="img-responsive pull-left flip logo hidden-xs animated fadeIn"
                                src="{{ voyager_asset('images/logo-icon-light.png') }}" alt="Logo Icon">
                            @else
                            <img class="img-responsive pull-left flip logo hidden-xs animated fadeIn"
                                src="{{ Voyager::image($admin_logo_img) }}" alt="Logo Icon">
                            @endif
                            <div class="copy animated fadeIn">
                                <h1>{{ Voyager::setting('admin.title', 'Voyager') }}</h1>
                                <p>{{ Voyager::setting('admin.description', __('voyager::login.welcome')) }}</p>
                            </div>
                        </div> <!-- .logo-title-container -->
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-5 col-md-4 login-sidebar">
                <div class="login-container" id="loginContainer"
                    style="display:{{session('regi_failed') ? 'none' : 'block'}}">
                    @if(session('registrationSuccess'))
                    <div class="alert alert-success" role="alert">{{session('registrationSuccess')}}. Please log in
                    </div>
                    @endif
                    <p>{{ __('voyager::login.signin_below') }} </p>

                    <form action="{{ route('voyager.login') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group form-group-default" id="emailGroup">
                            <label>{{ __('voyager::generic.email') }}</label>
                            <div class="controls">
                                <input type="text" name="email" id="email" value="{{ old('email') }}"
                                    placeholder="{{ __('voyager::generic.email') }}" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group form-group-default" id="passwordGroup">
                            <label>{{ __('voyager::generic.password') }}</label>
                            <div class="controls">
                                <input type="password" name="password"
                                    placeholder="{{ __('voyager::generic.password') }}" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group" id="rememberMeGroup">
                            <div class="controls">
                                <input type="checkbox" name="remember" id="remember" value="1"><label for="remember"
                                    class="remember-me-text">{{ __('voyager::generic.remember_me') }}</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-block login-button">
                                <span class="signingin hidden"><span class="voyager-refresh"></span>
                                    {{ __('voyager::login.loggingin') }}...</span>
                                <span class="signin">{{ __('voyager::generic.login') }}</span>
                            </button>
                        </div>

                        <div class="form-group">
                            <label style="margin-top: 15px;margin-left: 15px;">Don't have you account?
                                <a onclick="showRegistrationForm()">Create</a> It free!</label>
                        </div>


                    </form>

                    <div style="clear:both"></div>

                    @if(!$errors->isEmpty())
                    <div class="alert alert-red">
                        <ul class="list-unstyled">
                            @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                </div> <!-- .login-container -->

                <div id="registrationContainer">

                    <p>Registration Form</p>

                    <form action="{{ route('registration') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="role_id" value="2">
                        <div class="form-group">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Company Name"
                                value="{{ old('name', $dataTypeContent->name ?? '') }}">
                        </div>

                        <div class="form-group">
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="{{ __('voyager::generic.email') }}"
                                value="{{ old('email', $dataTypeContent->email ?? '') }}">
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Password" value="" autocomplete="new-password">
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" id="country" name="country" placeholder="Country"
                                value="{{ old('country', $dataTypeContent->country ?? '') }}">
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" id="city" name="city" placeholder="City"
                                value="{{ old('city', $dataTypeContent->city ?? '') }}">
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" id="address" name="address" placeholder="Address"
                                value="{{ old('address', $dataTypeContent->address ?? '') }}">
                        </div>

                        <div class="form-group">
                            <input type="number" class="form-control" id="post_code" name="post_code"
                                placeholder="Postal Code"
                                value="{{ old('post_code', $dataTypeContent->post_code ?? '') }}">
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone"
                                value="{{ old('phone', $dataTypeContent->phone ?? '') }}">
                        </div>


                        <button type="submit" class="btn btn-block login-button">
                            <span class="signin">Registration</span>
                        </button>

                        <div class="form-group">
                            <label style="margin-top: 15px;margin-left: 15px;">If you have account?
                                <a onclick="showLoginForm()">Login</a></label>
                        </div>

                    </form>

                    <div style="clear:both"></div>

                    @if(!$errors->isEmpty())
                    <div class="alert alert-red">
                        <ul class="list-unstyled">
                            @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif


                </div> <!-- .registration-container -->

            </div> <!-- .login-sidebar -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->

    <script>
        var btn = document.querySelector('button[type="submit"]');
    var form = document.forms[0];
    var email = document.querySelector('[name="email"]');
    var password = document.querySelector('[name="password"]');
    btn.addEventListener('click', function(ev){
        if (form.checkValidity()) {
            btn.querySelector('.signingin').className = 'signingin';
            btn.querySelector('.signin').className = 'signin hidden';
        } else {
            ev.preventDefault();
        }
    });
    email.focus();
    document.getElementById('emailGroup').classList.add("focused");

    // Focus events for email and password fields
    email.addEventListener('focusin', function(e){
        document.getElementById('emailGroup').classList.add("focused");
    });
    email.addEventListener('focusout', function(e){
       document.getElementById('emailGroup').classList.remove("focused");
    });

    password.addEventListener('focusin', function(e){
        document.getElementById('passwordGroup').classList.add("focused");
    });
    password.addEventListener('focusout', function(e){
       document.getElementById('passwordGroup').classList.remove("focused");
    });



    function showRegistrationForm(){
        var regiForm = document.getElementById("registrationContainer");
        var logForm = document.getElementById("loginContainer");
            regiForm.style.display = "block";
            logForm.style.display = "none";
    }

    function showLoginForm(){
        var regiForm = document.getElementById("registrationContainer");
        var logForm = document.getElementById("loginContainer");
            logForm.style.display = "block";
            regiForm.style.display = "none";
    }

    </script>
</body>

</html>