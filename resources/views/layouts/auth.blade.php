<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Task Tracker | Добро пожаловать</title>
    <link rel="shortcut icon" href="/img/logo.png" type="image/png">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="/dist/css/adminlte.min.css">

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="/plugins/jquery/jquery.min.js" defer></script>
    <!-- Bootstrap 4 -->
    <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js" defer></script>
    <!-- AdminLTE App -->
    <script src="/dist/js/adminlte.min.js" defer></script>
    <!-- AdminLTE for demo purposes -->
    <script src="/dist/js/demo.js" defer></script>
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
        <div class="container">
            <a href="{{url('/')}}" class="navbar-brand">
                <img src="/img/logo.png" alt="logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Task Tracker</span>
            </a>

            <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="{{route('home')}}" class="nav-link">Главная</a>
                    </li>
                    @guest
                        <li class="nav-item d-none d-sm-inline-block">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Вход') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item d-none d-sm-inline-block">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Регистрация') }}</a>
                            </li>
                        @endif
                    @else
                        @if(Auth::check() && Auth::user()->admin)
                            <li class="nav-item d-none d-sm-inline-block">
                                <a href="{{route('tasks.index')}}" class="nav-link">Задачи</a>
                            </li>
                            <li class="nav-item d-none d-sm-inline-block">
                                <a href="{{route('projects.index')}}" class="nav-link">Проекты</a>
                            </li>
                            <li class="nav-item d-none d-sm-inline-block">
                                <a href="{{route('users.index')}}" class="nav-link">Пользователи</a>
                            </li>
                        @endif
                        <li class="nav-item d-none d-sm-inline-block">
                            <a href="{{route('logout')}}" class="nav-link" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">{{ __('Выйти') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>

            <!-- Right navbar links -->
            <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- /.navbar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container mb-2">

            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

    @yield('content')

    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <div class="container">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                <strong>Task Tracker 2021</strong>
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
            reserved.
        </div>
    </footer>
</div>
<!-- ./wrapper -->

</body>
</html>
