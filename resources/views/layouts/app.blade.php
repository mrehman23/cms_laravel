<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="{{ !empty($app_name) ? $app_name->value : config()->get('app.name') }}" />
    <meta name="author" content="{{ !empty($app_name) ? $app_name->value : config()->get('app.name') }}" />
    <meta name="_token" content="{{ csrf_token() }}" />
    <title>{{(!empty($page_name->name) ? $page_name->name.' | ' : '') . config('app.name', 'KD') }}</title>
    <link rel="shortcut icon" href="{{ asset('kdassets/images/favicon.png') }}">

    <link href="{{asset('kdassets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('kdassets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('kdassets/plugins/select2/select2.min.css')}}" rel="stylesheet" type="text/css" >
    <link href="{{asset('kdassets/css/app.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('kdassets/css/custom.min.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{asset('kdassets/js/jquery-2.2.3.min.js')}}"></script>
</head>
<body>
<div class="modal fade zoomIn" id="genModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-green">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -25px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"></div>
    </div>
  </div>
</div>
<div id="layout-wrapper">
    <header id="page-topbar">
        <div class="layout-width">
            <div class="navbar-header">
                <div class="d-flex">
                    <div class="navbar-brand-box horizontal-logo">
                        <a href="{{url('/')}}" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="{{asset('kd/logo.png')}}" alt="">
                            </span>
                            <span class="logo-lg">
                                <img src="{{asset('kd/logo.png')}}" alt="">
                            </span>
                        </a>
                        <a href="{{url('/')}}" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="{{asset('kd/logo.png')}}" alt="">
                            </span>
                            <span class="logo-lg">
                                <img src="{{asset('kd/logo.png')}}" alt="">
                            </span>
                        </a>
                    </div>
                    <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger" id="topnav-hamburger-icon">
                        <span class="hamburger-icon">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                    </button>
                </div>
                <div class="d-flex align-items-center">
                    <div class="ms-1 header-item d-none d-sm-flex">
                        <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" data-toggle="fullscreen"><i class='bx bx-fullscreen fs-22'></i></button>
                    </div>
                    <div class="ms-1 header-item d-none d-sm-flex">
                        <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode"><i class='bx bx-moon fs-22'></i></button>
                    </div>
                    <div class="dropdown topbar-head-dropdown ms-1 header-item" id="notificationDropdown">
                        <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
                            <i class='bx bx-bell fs-22'></i>
                            <span class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger">{{count(notifications())}}<span class="visually-hidden">unread messages</span></span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">

                            <div class="dropdown-head bg-primary bg-pattern rounded-top">
                                <div class="p-3">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0 fs-16 fw-semibold text-white"> Notifications </h6>
                                        </div>
                                        <div class="col-auto dropdown-tabs">
                                            <span class="badge badge-soft-light fs-13"> {{count(notifications())}} New</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="px-2 pt-2">
                                    <ul class="nav nav-tabs dropdown-tabs nav-tabs-custom" data-dropdown-tabs="true" id="notificationItemsTab" role="tablist">
                                        <li class="nav-item waves-effect waves-light">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#all-noti-tab" role="tab" aria-selected="true">
                                                All
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="tab-content position-relative" id="notificationItemsTabContent">
                                <div class="tab-pane fade show active py-2 ps-2" id="all-noti-tab" role="tabpanel">
                                    <div data-simplebar style="max-height: 300px;" class="pe-2">
                                    @if(count(notifications()) > 0)
                                        @foreach(notifications() as $notification)
                                            <div class="text-reset notification-item d-block dropdown-item position-relative">
                                            <div class="d-flex">
                                                <div class="avatar-xs me-3">
                                                    <span class="avatar-title bg-soft-info text-info rounded-circle fs-16">
                                                        <i class="bx bx-badge-check"></i>
                                                    </span>
                                                </div>
                                                <div class="flex-1">
                                                    <a href="{{ route('admin.notification',['id'=>$notification->notify_id]) }}" class="stretched-link">
                                                        <h6 class="mt-0 mb-2 lh-base">{{ $notification->notify_title }}</h6>
                                                    </a>
                                                    <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                        <span><i class="mdi mdi-clock-outline"></i> Just 30 sec ago</span>
                                                    </p>
                                                </div>
                                            </div>
                                            </div>
                                        @endforeach
                                        <div class="text-reset notification-item d-block dropdown-item position-relative">
                                            <div class="d-flex">
                                                <div class="avatar-xs me-3">
                                                    <span class="avatar-title bg-soft-info text-info rounded-circle fs-16">
                                                        <i class="bx bx-badge-check"></i>
                                                    </span>
                                                </div>
                                                <div class="flex-1">
                                                    <a href="#" class="stretched-link">
                                                        <h6 class="mt-0 mb-2 lh-base">Tes</h6>
                                                    </a>
                                                    <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                        <span><i class="mdi mdi-clock-outline"></i> Just 30 sec ago</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="my-3 text-center view-all">
                                        <button type="button" class="btn btn-soft-success waves-effect waves-light">View
                                            All Notifications <i class="ri-arrow-right-line align-middle"></i></button>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown ms-sm-3 header-item topbar-user">
                        <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="d-flex align-items-center">
                                <img class="rounded-circle header-profile-user" src="{{asset('kdassets/images/users/default-user.jpg')}}" alt="Header Avatar">
                                <span class="text-start ms-xl-2">
                                    <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{ !empty(Auth::user()->name) ? Auth::user()->name : '' }}</span>
                                    <span class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text">Employee</span>
                                </span>
                            </span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <h6 class="dropdown-header">Welcome {{ !empty(Auth::user()->name) ? Auth::user()->name : '' }}!</h6>
                            <a class="dropdown-item"><i class="mdi mdi-wallet text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Member Since : <b>{{ !empty(Auth::user()->created_at) ? Auth::user()->created_at : '' }}</b></span></a>
                            <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Profile</span></a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"><i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle" data-key="t-logout">Logout</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="app-menu navbar-menu">
        <div class="navbar-brand-box">
            <a href="{{url('/')}}" class="logo logo-dark">
                <span class="logo-sm">
                    <img src="{{asset('kd/logo.png')}}" alt="">
                </span>
                <span class="logo-lg">
                    <img src="{{asset('kd/logo.png')}}" alt="">
                </span>
            </a>
            <a href="{{url('/')}}" class="logo logo-light">
                <span class="logo-sm">
                    <img src="{{asset('kd/logo.png')}}" alt="">
                </span>
                <span class="logo-lg">
                    <img src="{{asset('kd/logo.png')}}" alt="">
                </span>
            </a>
            <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
                <i class="ri-record-circle-line"></i>
            </button>
        </div>
        <div id="scrollbar">
            <div class="container-fluid">
                <div id="two-column-menu"></div>
                <ul class="navbar-nav" id="navbar-nav">
                    @include('layouts.partials.sidebar')
                </ul>
            </div>
        </div>
        <div class="sidebar-background"></div>
    </div>
    <div class="vertical-overlay"></div>
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                @include('layouts.partials.breadcrumb')
                @yield('breadcrumb')
                @yield('heading')
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
                @if(session('success'))
                    @include('components.alertmessage', ['title' => 'Success', 'message' => session('success'), 'type' => 'success'])
                @endif
                @if(session('error'))
                    @include('components.alertmessage', ['title' => 'Error', 'message' => session('error'), 'type' => 'error'])
                @endif
                @yield('content')
            </div>
        </div>
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <strong>Copyright &copy; {{date('Y')}}</strong> All rights reserved.
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block">
                            Design & Develop by <a href="http://kreativedezine.com">Kreative Dezine</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
<button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top"><i class="ri-arrow-up-line"></i></button>
<div id="preloader">
    <div id="status">
        <div class="spinner-border text-primary avatar-sm" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</div>

<script src="{{asset('kdassets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('kdassets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset('kdassets/libs/node-waves/waves.min.js')}}"></script>
<script src="{{asset('kdassets/libs/feather-icons/feather.min.js')}}"></script>
<link href="{{asset('kdassets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
<script src="{{asset('kdassets/libs/sweetalert2/sweetalert2.min.js')}}"></script>
<script src="{{asset('kdassets/js/plugins.js')}}"></script>
<script src="{{asset('kdassets/js/app.js')}}"></script>

<script src="{{asset('kdassets/js/jqueryblockui.js')}}" type="text/javascript"></script>
<script src="{{asset('kdassets/plugins/select2/select2.min.js')}}"></script>
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
<script src="{{asset('kdassets/js/common.js')}}"></script>
<script type="text/javascript">
  $(function () {
      //Initialize Select2 Elements
      $(".select2").select2();
      genDatePicker('kddate','');
      genDateRange('kdRdate','','');
      DynkdDT('kdTable');
      DynkdDTExp('kdTableExp');
  });
  function genDatePicker(id,date) {
    $('.'+id).datepicker({
          format: 'dd-M-yyyy',
          todayHighlight:'TRUE',
          autoclose: true
      }).datepicker("setDate", date=="" ? new Date() : date);
  }
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
          "info" : false
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
          'info' : false
      });
  }
  $.ajaxPrefilter(function (options, originalOptions, jqXHR) {
      if (!options.crossDomain) {
          var token = $('meta[name="_token"]').attr('content');
          if (token) {
              jqXHR.setRequestHeader('X-CSRF-Token', token);
              jqXHR.setRequestHeader('Developed-By', "MATI UR REHMAN AND RIZWAN BAIG");
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
@yield('scripts')
@yield('footer')
</body>
</html>
