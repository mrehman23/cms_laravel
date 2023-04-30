<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    <title>{{ !empty($app_name) ? $app_name->value : config('app.name', 'KD') }}</title>
    <link rel="shortcut icon" href="{{ asset('kdassets/images/favicon.png') }}">
    <script src="{{ asset('kdassets/js/layout.js') }}"></script>
    <link href="{{ asset('kdassets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('kdassets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('kdassets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('kdassets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />

</head>
<body class="auth-body-bg">
    <div class="auth-page-wrapper pt-5">
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>
            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <a href="{{url('/')}}" class="d-inline-block auth-logo">
                                    <img src="{{asset('kd/logo.png')}}" alt="{{ config('app.name', 'KD') }}">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                @if (Session::has('flash_message'))
                    <div class="container">
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{ Session::get('flash_message') }}
                        </div>
                    </div>
                @endif
                <div class="login-logo">
                    <a href="">{{ config('app.name') }}</a>
                </div>
                @yield('content')
            </div>
        </div>
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0 text-muted">
                                <strong>Copyright &copy; {{date('Y')}}</strong> Develop by <a href="http://kreativedezine.com">Kreative Dezine</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    @yield('scripts')
</body>
</html>
