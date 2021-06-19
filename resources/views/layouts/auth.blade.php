<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Заголовок страницы -->
    <title>Task Tracker | Добро пожаловать</title>

    <!-- ОБЯЗАТЕЛЬНЫЕ ССЫЛКИ -->

    <!-- Иконка сайта -->
    <link rel="shortcut icon" href="/img/logo.png" type="image/png">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="/dist/css/adminlte.min.css">

    <!-- ОБЯЗАТЕЛЬНЫЕ СКРИПТЫ -->

    <!-- jQuery -->
    <script src="/plugins/jquery/jquery.min.js" defer></script>
    <!-- Bootstrap 4 -->
    <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js" defer></script>
    <!-- AdminLTE App -->
    <script src="/dist/js/adminlte.min.js" defer></script>
    <!-- AdminLTE for demo purposes -->
    <script src="/dist/js/demo.js" defer></script>
</head>
<body class="hold-transition layout-top-nav dark-mode">
<div class="wrapper">

    <!-- Навигация -->
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
        <div class="container">
            <!-- Логотип сайта -->
            <a href="{{url('/')}}" class="navbar-brand">
                <img src="/img/logo.png" alt="logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Task Tracker</span>
            </a>
            <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                <!-- Навигация по страницам сайта -->
                <ul class="navbar-nav">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Вход') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Регистрация') }}</a>
                            </li>
                        @endif
                    @endguest
                </ul>
            </div>

            <!-- Ссылка на опциии -->
            <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Контент подгружаемой страницы -->
    <div class="content-wrapper">

        <div class="content-header mb-2">

        </div>

    @yield('content')

    </div>

    <!-- Опции -->
    <aside class="control-sidebar control-sidebar-dark"></aside>

    <!-- Подвал сайта -->
    <footer class="main-footer">
        <!-- Обертка подвала-->
        <div class="container">
            <!-- Название и год создания сайта справа -->
            <div class="float-right d-none d-sm-inline">
                <strong>Task Tracker 2021</strong>
            </div>
            <!-- Копирайт слева-->
            <strong>Copyright &copy; 2021 <a href="{{url('/')}}">Task Tracker</a>.</strong> Все права защищены.
        </div>
    </footer>
</div>

</body>
</html>
