<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} @hasSection('title') | @yield('title') @endif</title>

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/font-awesome/4.5.0/css/font-awesome.min.css') }}" />

    <!-- text fonts -->
    <link rel="stylesheet" href="{{ asset('assets/css/fonts.googleapis.com.css') }}" />

    <!-- ace styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/ace.min.css') }}" class="ace-main-stylesheet" id="main-ace-style" />

    <link rel="stylesheet" href="{{ asset('assets/css/ace-skins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/ace-rtl.min.css') }}" />

    <!-- ace settings handler -->
    <script src="{{ asset('assets/js/ace-extra.min.js') }}"></script>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @stack('style')
</head>

<body class="no-skin">
    <div id="navbar" class="navbar navbar-default ace-save-state">
        <div class="navbar-container ace-save-state" id="navbar-container">
            <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
                <span class="sr-only">Toggle sidebar</span>

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>
            </button>

            <div class="navbar-header pull-left">
                <a href="{{ route('home') }}" class="navbar-brand">
                    <small>
                        <i class="fa fa-leaf"></i>
                        {{ config('app.name', 'Laravel') }}
                    </small>
                </a>
            </div>

            <div class="navbar-buttons navbar-header pull-right" role="navigation">
                @auth
                <ul class="nav ace-nav">
                    <li class="light-blue dropdown-modal">
                        <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                            <img class="nav-user-photo" src="{{ asset('assets/images/avatars/user.jpg') }}" alt="Jason's Photo" />
                            <span class="user-info">
                                <small>Welcome,</small>
                                {{ Auth::user()->name }}
                            </span>

                            <i class="ace-icon fa fa-caret-down"></i>
                        </a>

                        <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="ace-icon fa fa-power-off"></i>
                                    Logout
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                @endauth
            </div>
        </div><!-- /.navbar-container -->
    </div>

    <div class="main-container ace-save-state" id="main-container">
        <script type="text/javascript">
            try {
                ace.settings.loadState('main-container')
            } catch (e) {}
        </script>

        <div id="sidebar" class="sidebar responsive ace-save-state">
            <script type="text/javascript">
                try {
                    ace.settings.loadState('sidebar')
                } catch (e) {}
            </script>

            <ul class="nav nav-list">
                <li class="@if(Route::is('home')) active @endif">
                    <a href="{{ route('home') }}">
                        <i class="menu-icon fa fa-tachometer"></i>
                        <span class="menu-text"> Dashboard </span>
                    </a>

                    <b class="arrow"></b>
                </li>

                @if(Auth::user()->isAdmin())
                <li class="@if(Route::is('questions.*')) active open @endif">
                    <a href="#" class="dropdown-toggle">
                        <i class="menu-icon fa fa-list"></i>
                        <span class="menu-text"> Questions</span>

                        <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <b class="arrow"></b>

                    <ul class="submenu">
                        <li class="@if(Route::is('questions.index') || Route::is('questions.edit') || Route::is('questions.show')) active @endif">
                            <a href="{{ route('questions.index') }}">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Question List
                            </a>

                            <b class="arrow"></b>
                        </li>

                        <li class="@if(Route::is('questions.create')) active @endif">
                            <a href="{{ route('questions.create') }}">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Add Question
                            </a>

                            <b class="arrow"></b>
                        </li>
                    </ul>
                </li>

                <li class="@if(Route::is('user-tests.*')) active @endif">
                    <a href="{{ route('user-tests.manage') }}">
                        <i class="menu-icon fa fa-pencil-square-o"></i>
                        <span class="menu-text"> Tests </span>
                    </a>

                    <b class="arrow"></b>
                </li>
                @endif
            </ul><!-- /.nav-list -->

            <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
                <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
            </div>
        </div>

        <div class="main-content">
            <div class="main-content-inner">

                @hasSection('breadcrumb') @yield('breadcrumb') @endif

                <div class="page-content">
                    @if (session('success'))
                    <div class="alert alert-block alert-success auto-close">
                        <button type="button" class="close" data-dismiss="alert">
                            <i class="ace-icon fa fa-times"></i>
                        </button>
                        <p>
                            <strong>
                                <i class="ace-icon fa fa-check"></i>
                                Well done!
                            </strong>
                            {{ session('success') }}
                        </p>
                    </div>
                    @endif

                    @if (session('error'))
                    <div class="alert alert-block alert-danger auto-close">
                        <button type="button" class="close" data-dismiss="alert">
                            <i class="ace-icon fa fa-times"></i>
                        </button>
                        <p>
                            <strong>
                                <i class="ace-icon fa fa-times"></i>
                                Oh Snap!
                            </strong>
                            {{ session('error') }}
                        </p>
                    </div>
                    @endif

                    @yield('content')
                </div><!-- /.page-content -->
            </div>
        </div><!-- /.main-content -->

        <div class="footer">
            <div class="footer-inner">
                <div class="footer-content">
                    <span class="bigger-120">
                        <span class="blue bolder">{{ config('app.name', 'Laravel') }}</span>
                        &copy; {{ now()->format('Y') }}-{{ now()->addYear()->format('Y') }}
                    </span>
                </div>
            </div>
        </div>

        <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
            <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
        </a>
    </div><!-- /.main-container -->

    <!-- basic scripts -->
    <script src="{{ asset('assets/js/jquery-2.1.4.min.js') }}"></script>

    <script type="text/javascript">
        if ('ontouchstart' in document.documentElement) document.write("<script src='{{ asset('assets/js/jquery.mobile.custom.min.js') }}'>" + "<" + "/script>");
    </script>

    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

    <!-- page specific plugin scripts -->

    <!-- Sweet Alert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- jquery form validator -->
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>

    <!-- ace scripts -->
    <script src="{{ asset('assets/js/ace-elements.min.js') }}"></script>
    <script src="{{ asset('assets/js/ace.min.js') }}"></script>

    <!-- Global Script -->
    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
                }
            });

            let $closableAlerts = $(".alert.auto-close")

            if ($closableAlerts) {
                setTimeout(function() {
                    $closableAlerts.slideUp("slow");
                }, 5000); // mili-seconds
            }

        });
    </script>

    <!-- Page Specific Script -->
    @stack('script')
</body>

</html>