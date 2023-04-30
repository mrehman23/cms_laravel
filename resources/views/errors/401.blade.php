<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
<head>
    <meta charset="utf-8" />
    <title>401</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{asset('kdassets/images/favicon.png')}}">
    <script src="{{asset('kdassets/js/layout.js')}}"></script>
    <link href="{{asset('kdassets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('kdassets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('kdassets/css/app.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('kdassets/css/custom.min.css')}}" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="auth-page-wrapper py-5 d-flex justify-content-center align-items-center min-vh-100">
        <div class="auth-page-content overflow-hidden p-0">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-xl-4 text-center">
                        <div class="error-500 position-relative">
                            <img src="{{asset('kdassets/images/error500.png')}}" alt="" class="img-fluid error-500-img error-img" />
                            <h1 class="title text-muted">401</h1>
                        </div>
                        <div>
                            <h4>Permission Denied!</h4>
                            <a href="{{URL::previous()}}" class="btn btn-success"><i class="mdi mdi-home me-1"></i>Back</a>
                            <a href="{{route('logout')}}" class="btn btn-danger"><i class="mdi mdi-lock me-1"></i>Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
