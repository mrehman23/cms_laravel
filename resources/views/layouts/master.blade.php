<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ !empty($app_name) ? $app_name->value : config()->get('app.name') }}" />
    <meta name="author" content="{{ !empty($app_name) ? $app_name->value : config()->get('app.name') }}" />
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    <title>{{ !empty($app_name) ? $app_name->value : config()->get('app.name') }} | @yield('title')</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset(!empty($favicon) ? $favicon->value : 'kd/favicon.png')}}">
    <link rel="stylesheet" href="{{ asset('vendor/kdladmin/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/kdladmin/font-awesome.min.css') }}">
    <script src="{{ asset('vendor/kdladmin/jquery-3.6.0.min.js') }}"></script>
    @yield('extra-css')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel" style="background: #e64534 !important;color: #fff;">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img class="lozad" src="{{asset(!empty($web_logo) ? $web_logo->value : 'kd/logo.png')}}" alt="Logo" style="max-height:40px;">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        @foreach (menuList() as $menu)
                            <li><a class="nav-link" href="{{Route::has($menu->slug) ? route($menu->slug) : 'javascript:void(0);'}}">{{Str::replaceArray('-',[' '],Str::Title($menu->name))}}</a></li>
                        @endforeach
                        @guest
                            <li><a class="nav-link" href="{{ url('/login') }}">Login</a></li>
                            <li><a class="nav-link" href="{{ url('/register') }}">Register</a></li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('/logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            @if (Session::has('flash_message'))
                <div class="container">
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ Session::get('flash_message') }}
                    </div>
                </div>
            @endif
            @yield('content')
        </main>
        <hr/>
        @include('layouts.partials.footer')
    </div>
    @yield('scripts')

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        }
    });
</script>
</body>
</html>
