@extends('layouts.master')

@section('adminlte_css')
    <link rel="stylesheet"
          href="{{ asset('vendor/adminlte/dist/css/skins/skin-' . config('adminlte.skin', 'blue') . '.min.css')}} ">
    @stack('css')
    <style type="text/css">
        .text-input {
            padding-top: 7px;
        }
    </style>
    @yield('css')
@stop

@section('body_class', 'skin-' . config('adminlte.skin', 'blue') . ' sidebar-mini ' . (config('adminlte.layout') ? [
    'boxed' => 'layout-boxed',
    'fixed' => 'fixed',
    'top-nav' => 'layout-top-nav'
][config('adminlte.layout')] : '') . (((isset($_COOKIE['collapse_sidebar']) && $_COOKIE['collapse_sidebar']) || config('adminlte.collapse_sidebar')) ? ' sidebar-collapse ' : ''))

@section('body')
    <div class="wrapper">

        <!-- Main Header -->
        <header class="main-header">
            @if(config('adminlte.layout') == 'top-nav')
                <nav class="navbar navbar-static-top">
                    <div class="container">
                        <div class="navbar-header">
                            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="navbar-brand">
                                {!! config('adminlte.logo', '<b>Admin</b>LTE') !!}
                            </a>
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                    data-target="#navbar-collapse">
                                <i class="fa fa-bars"></i>
                            </button>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                            <ul class="nav navbar-nav">
                                @each('adminlte::partials.menu-item-top-nav', $adminlte->menu(), 'item')
                            </ul>
                        </div>
                        <!-- /.navbar-collapse -->
                    @else
                        <!-- Logo -->
                            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="logo">
                                <!-- mini logo for sidebar mini 50x50 pixels -->
                                <span class="logo-mini">{!! config('adminlte.logo_mini', '<b>A</b>LT') !!}</span>
                                <!-- logo for regular state and mobile devices -->
                                <span class="logo-lg">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</span>
                            </a>

                            <!-- Header Navbar -->
                            <nav class="navbar navbar-static-top" role="navigation">
                                <!-- Sidebar toggle button-->
                                <a href="#" class="sidebar-toggle fa5" data-toggle="push-menu" role="button">
                                    <span class="sr-only">{{ trans('adminlte::adminlte.toggle_navigation') }}</span>
                                </a>
                            @endif
                            <!-- Navbar Right Menu -->
                                <div class="navbar-custom-menu">

                                    <ul class="nav navbar-nav">
                                        <li class="dropdown user user-menu">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                               aria-expanded="false">
                                                <img src="{{ Auth::user()->gravatar(25) }}" class="user-image"
                                                     alt="User Image">
                                                <span class="hidden-xs">{{ Auth::user()->name }}</span>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <!-- User image -->
                                                <li class="user-header">
                                                    <img src="{{ Auth::user()->gravatar(90) }}" class="img-circle"
                                                         alt="{{ Auth::user()->name }}">

                                                    <p>
                                                        {{ Auth::user()->name }}
                                                        <small>上次访问 {{ Auth::user()->created_at->format('Y-m-d H:i') }}</small>
                                                    </p>
                                                </li>
                                                <li class="user-footer">
                                                    <div class="pull-left">
                                                        <a href="{{ route('profile.index') }}"
                                                           class="btn btn-default btn-flat">个人信息</a>
                                                    </div>
                                                    <div class="pull-right">
                                                        @if(config('adminlte.logout_method') == 'GET' || !config('adminlte.logout_method') && version_compare(\Illuminate\Foundation\Application::VERSION, '5.3.0', '<'))
                                                            <a href="{{ url(config('adminlte.logout_url', 'auth/logout')) }}"
                                                               class="btn btn-default btn-flat">注销</a>
                                                        @else
                                                            <a href="#"
                                                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                                               class="btn btn-default btn-flat">注销</a>
                                                            <form id="logout-form"
                                                                  action="{{ url(config('adminlte.logout_url', 'auth/logout')) }}"
                                                                  method="POST" style="display: none;">
                                                                @if(config('adminlte.logout_method'))
                                                                    {{ method_field(config('adminlte.logout_method')) }}
                                                                @endif
                                                                {{ csrf_field() }}
                                                            </form>
                                                        @endif

                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                        @if (Auth::user()->isImpersonated() )
                                            <li class="user user-menu" style="background-color: darkred">
                                                <a href="{{ route('profile.leave-impersonate') }}">
                                                    <i class="fa fa-user-secret"></i>
                                                    <span class="hidden-xs">退出身份</span>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>

                                    <ul class="nav navbar-nav">
                                        <li>

                                        </li>
                                    </ul>
                                </div>
                            @if(config('adminlte.layout') == 'top-nav')
                    </div>
                    @endif
                </nav>
        </header>

    @if(config('adminlte.layout') != 'top-nav')
        <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">

                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">

                    <!-- Sidebar Menu -->
                    <ul class="sidebar-menu" data-widget="tree">
                        @each('adminlte::partials.menu-item', $adminlte->menu(), 'item')
                    </ul>
                    <!-- /.sidebar-menu -->
                </section>
                <!-- /.sidebar -->
            </aside>
    @endif

    <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @if(config('adminlte.layout') == 'top-nav')
                <div class="container">
                @endif

                <!-- Content Header (Page header) -->
                    <section class="content-header">
                        @yield('content_header')
                    </section>

                    <!-- Main content -->
                    <section class="content">

                        @yield('content')

                    </section>
                    <!-- /.content -->
                    @if(config('adminlte.layout') == 'top-nav')
                </div>
                <!-- /.container -->
            @endif
        </div>
        <!-- /.content-wrapper -->

        @hasSection('footer')
            <footer class="main-footer">
                @yield('footer')
            </footer>
        @endif

        @if(config('adminlte.right_sidebar') and (config('adminlte.layout') != 'top-nav'))
            <aside class="control-sidebar control-sidebar-{{config('adminlte.right_sidebar_theme')}}">
                @yield('right-sidebar')
            </aside>
            <!-- /.control-sidebar -->
            <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        @endif

    </div>
    <!-- ./wrapper -->
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @stack('js')
    @yield('js')
@stop
