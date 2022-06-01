<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ !empty($app_name) ? $app_name->value : config()->get('app.name') }}" />
    <meta name="author" content="{{ !empty($app_name) ? $app_name->value : config()->get('app.name') }}" />
    <meta name="_token" content="{{ csrf_token() }}" />
    <title>{{ !empty($app_name) ? $app_name->value : config()->get('app.name') }} | @yield('title')</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset(!empty($favicon) ? $favicon->value : 'kd/favicon.png')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{asset('kdassets/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    {{-- <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{asset('kdassets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}"> --}}
    <link rel="stylesheet" href="{{asset('kdassets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('kdassets/plugins/jqvmap/jqvmap.min.css')}}"> --}}
    <link rel="stylesheet" href="{{asset('kdassets/dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('kdassets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <link rel="stylesheet" href="{{asset('kdassets/plugins/daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{asset('kdassets/plugins/summernote/summernote-bs4.min.css')}}">
    <script src="{{ asset('vendor/kdladmin/jquery-3.6.0.min.js') }}"></script>
    @yield('extra-css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{url('/')}}" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">{{count(notifications())}}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">You have {{count(notifications())}} Notifications</span>
                <div class="dropdown-divider"></div>
                @if(count(notifications()) > 0)
                    @foreach(notifications() as $notification)
                    <a href="{{ route('admin.notification',['id'=>$notification->notify_id]) }}" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> {{ $notification->notify_title }}
                        <span class="float-right text-muted text-sm">3 mins</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    @endforeach
                @endif
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li>
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
            <img src="{{asset('kdassets/dist/img/default-user.jpg')}}" class="user-image img-circle elevation-2" alt="User Image">
            <span class="d-none d-md-inline">{{ !empty(Auth::user()->name) ? Auth::user()->name : '' }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <li class="user-header bg-primary">
                    <img src="{{asset('kdassets/dist/img/default-user.jpg')}}" class="img-circle elevation-2" alt="User Image">
                    <p>{{ !empty(Auth::user()->name) ? Auth::user()->name : '' }} - IT Manager<small>Member since {{ !empty(Auth::user()->created_at) ? Auth::user()->created_at : '' }}</small></p>
                </li>
                <li class="user-footer">
                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                    <a href="{{ route('logout') }}" class="btn btn-default btn-flat float-right">Sign out</a>
                </li>
            </ul>
        </li>
    </ul>
  </nav>

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{url('/')}}" class="brand-link">
      <img src="{{asset(!empty($web_logo) ? $web_logo->value : 'kd/logo.png')}}" alt="{{!empty($app_name) ? $app_name->value : config()->get('app.name')}}" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{!empty($app_name) ? $app_name->value : config()->get('app.name')}}</span>
    </a>
    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-header">Menu</li>
            <li class="nav-item active"><a href="pages/gallery.html" class="nav-link"><i class="nav-icon fas fa-tachometer-alt"></i><p>Dashboard</p></a></li>
            <li class="nav-item"><a href="{{route('admin.settings.index')}}" class="nav-link"><i class="nav-icon fa fa-book"></i><p>Setting</p></a></li>
            <li class="nav-item">
                <a href="#" class="nav-link "><i class="nav-icon fas fa-book"></i><p>Pages<i class="right fas fa-angle-left"></i></p></a>
                <ul class="nav nav-treeview">
                    <li class="nav-item"><a href="{{route('admin.pages.index')}}" class="nav-link active"><i class="far fa-circle nav-icon"></i><p>List</p></a></li>
                    <li class="nav-item"><a href="{{route('admin.pages.create')}}" class="nav-link active"><i class="far fa-circle nav-icon"></i><p>Create</p></a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link "><i class="nav-icon fas fa-user"></i><p>User Management<i class="right fas fa-angle-left"></i></p></a>
                <ul class="nav nav-treeview">
                    <li class="nav-item"><a href="{{route('kd.permission.index')}}" class="nav-link active"><i class="far fa-circle nav-icon"></i><p>Permissions</p></a></li>
                    <li class="nav-item"><a href="{{route('kd.user.index')}}" class="nav-link active"><i class="far fa-circle nav-icon"></i><p>Users</p></a></li>
                    <li class="nav-item"><a href="{{route('kd.assignment.index')}}" class="nav-link active"><i class="far fa-circle nav-icon"></i><p>Assignment</p></a></li>
                </ul>
            </li>
            <li class="nav-header">Others</li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                <i class="nav-icon far fa-circle text-danger"></i>
                <p class="text">Important</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                <i class="nav-icon far fa-circle text-warning"></i>
                <p>Warning</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                <i class="nav-icon far fa-circle text-info"></i>
                <p>Informational</p>
                </a>
            </li>
        </ul>
      </nav>
    </div>
  </aside>
  <div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
      <div class="container-fluid">
        @if (Session::has('flash_message'))
            <div class="container">
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ Session::get('flash_message') }}
                </div>
            </div>
        @endif
        @if($errors->any())
          <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }} <br />
            @endforeach
          </div>
        @endif
        @yield('content')
        <x-toast title="Success" :message="Session::get('success')" type="success" />
        <x-toast title="Error" :message="Session::get('error')" type="error" />
      </div>
    </section>
  </div>
  @include('admin.partials.footer')
</div>

<script src="{{asset('kdassets/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('kdassets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="{{asset('kdassets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
{{-- <script src="{{asset('kdassets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script> --}}
<script src="{{asset('kdassets/plugins/summernote/summernote-bs4.min.js')}}"></script>
<script src="{{asset('kdassets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<script src="{{asset('kdassets/dist/js/adminlte.js')}}"></script>

<script src="{{asset('kdassets/js/jqueryblockui.js')}}" type="text/javascript"></script>
<script src="{{asset('kdassets/plugins/select2/select2.full.min.js')}}"></script>
<script src="{{asset('kdassets/js/moment.min.js')}}"></script>
<script src="{{asset('kdassets/plugins/daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('kdassets/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
<link href="{{asset('kdassets/plugins/datatables/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{asset('kdassets/plugins/datatables/buttons.dataTables.min.css')}}" rel="stylesheet">
<script src="{{asset('kdassets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('kdassets/plugins/datatables/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('kdassets/plugins/datatables/buttons.print.min.js')}}"></script>
<script src="{{asset('kdassets/plugins/datatables/jszip.min.js')}}"></script>
<script src="{{asset('kdassets/plugins/datatables/pdfmake.min.js')}}"></script>
<script src="{{asset('kdassets/plugins/datatables/vfs_fonts.js')}}"></script>
<script src="{{asset('kdassets/plugins/datatables/buttons.html5.min.js')}}"></script>

<script type="text/javascript">
    $(function () {
        $(".select2").select2();
        $(".kddate").datepicker({
            format: 'dd-mm-yyyy',
            todayHighlight:'TRUE',
            autoclose: true
        }).datepicker("setDate", new Date());
        genDateRange('kdRdate','','');
        DynkdDT('kdTable');
        DynkdDTExp('kdTableExp');
    });
    function genDateRange(id,start,end) {
        var start = (start=="" ? moment().subtract(29, 'days') : start);
        var end = (end=="" ? moment() : end);
        function cb(start, end) {
            $('.'+id+' span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
        $('.'+id).daterangepicker({
            locale: {
                format: 'DD-MM-YYYY'
            },
            startDate: start,
            endDate: end,
            ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);
    }
    function DynkdDT(id) {
        $('.'+id).DataTable({
            'order': [],
            "paging" : false,
            "searching" : true,
            "ordering" : true,
            "info" : true
        });
    }
    function DynkdDTExp(id) {
        $('.'+id).DataTable({
            dom: 'Bfrtip',
            buttons: [
                { extend: 'excel', footer: true },
                { extend: 'print', footer: true }
            ],
            'order': [],
            'paging' : false,
            'searching' : true,
            'ordering' : true,
            'info' : true
        });
    }
    $.ajaxPrefilter(function (options, originalOptions, jqXHR) {
        if (!options.crossDomain) {
            var token = $('meta[name="_token"]').attr('content');
            if (token) {
                jqXHR.setRequestHeader('X-CSRF-Token', token);
                jqXHR.setRequestHeader('Developed-By', "MATI UR REHMAN");
            }
        }
    });
    var Loading = {
        blockUI: function () {
            $.blockUI({
                message: '<div style="display:block;width: 20%;background: #FFF;border: 9px solid #e4e2e7;border-radius: 3px;-webkit-border-radius: 3px;-moz-border-radius: 3px;-webkit-box-shadow: 0 2px 3px rgba(0,0,0,0.3);-moz-box-shadow: 0 2px 3px rgba(0,0,0,0.3);box-shadow: 0 2px 3px rgba(0,0,0,0.3);text-align: center;padding: 15px;margin-top: -100px;position: fixed;top: 324px;left: 40%;right: 40%;z-index: 99999;"><p>Please Wait.</p><br /><img src="{{asset("kdassets/images/searching.gif")}}"/><p><small>We&#39;ll be just a moment...</small></p></div>',
                css: {
                    position: 'static'
                },
                overlayCSS: {
                    backgroundColor: 'black',
                    opacity: 0.6,
                    cursor: 'wait'
                }
            });
        },
        unblockUI: function () {
            $.unblockUI();
        }
    };
    $(document).ajaxStart(Loading.blockUI).ajaxStop(Loading.unblockUI);
</script>
@yield('extra-js')
</body>
</html>
