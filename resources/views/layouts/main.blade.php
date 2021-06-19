<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <!-- Токен для ajax -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Заголовок страницы -->
    <title>Task Tracker | @yield('title')</title>

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
    <!-- Основные стили -->
    <link rel="stylesheet" href="/css/main.css">

    <!-- ОБЯЗАТЕЛЬНЫЕ СКРИПТЫ -->

    <!-- jQuery -->
    <script src="/plugins/jquery/jquery.min.js" defer></script>
    <!-- Bootstrap 4 -->
    <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js" defer></script>
    <!-- AdminLTE App -->
    <script src="/dist/js/adminlte.min.js" defer></script>
    <!-- AdminLTE for demo purposes -->
    <script src="/dist/js/demo.js" defer></script>

    <!-- Основные скрипты шаблона -->
    <script src="/js/main.js" defer></script>
    <!-- Скрипты канбан -->
    <script src="/js/cards.js" defer></script>
    <!-- Скрипты комментариев -->
    <script src="/js/comments.js" defer></script>
</head>
<body class="hold-transition sidebar-mini dark-mode">
<div class="wrapper">

    <!-- Навигация -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Ссылки на страницы -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{route('home')}}" class="nav-link">Главная</a>
            </li>
            <!-- Проверка на авторизацию пользователя -->
            @if(Auth::check())
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{route('profile.index')}}" class="nav-link">Профиль</a>
                </li>
                <!-- Проверка на авторизацию пользователя как администратор -->
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
        @endif
        <!-- Выход из аккаунта -->
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{route('logout')}}" class="nav-link" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">{{ __('Выйти') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>

        <!-- Блок управления шаблоном сайта -->
        <ul class="navbar-nav ml-auto">
            <!-- Тёмная тема (вкл/выкл) -->
            <li class="nav-item dropdown">
                <a class="nav-link switcher" href="#">
                    <i class="fas fa-toggle-on"></i>
                </a>
            </li>
            <!-- Полноэкранный режим (вкл/выкл) -->
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <!-- Ссылка на опциии -->
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                    <i class="fas fa-th-large"></i>
                </a>
            </li>
        </ul>

    </nav>

    <!-- Главаная боковая панель -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Логотип сайта -->
        <a href="{{ url('/') }}" class="brand-link">
            <img src="/img/logo.png" alt="logo" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">Task Tracker</span>
        </a>

        <!-- Панель -->
        <div class="sidebar">
            <!-- Авторизованный пользователь -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                @if(isset(Auth::user()->photo))
                    <div class="image">
                        <img src="{{Auth::user()->photo}}" class="img-circle elevation-2" alt="User Image"
                             style="width: 35px; height: 35px;">
                    </div>
                @else
                    <div class="image">
                        <img src="/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                @endif
                <div class="info">
                    <a href="{{route('profile.index')}}" class="d-block">{{Auth::user()->name}}</a>
                </div>
            </div>

            <!-- Меню боковой панели -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-building"></i>
                            <p>
                                Компания
                                <span class="right badge badge-danger">{{Auth::user()->company->name}}</span>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item menu-open">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-compass"></i>
                            <p>
                                Навигация
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('home')}}" class="nav-link">
                                    <i class="fas fa-home nav-icon"></i>
                                    <p>Главная</p>
                                </a>
                            </li>
                            @if(Auth::check())
                                <li class="nav-item">
                                    <a href="{{route('profile.index')}}" class="nav-link">
                                        <i class="fas fa-user nav-icon"></i>
                                        <p>Профиль</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                    <!-- Админ панель -->
                    @if(Auth::check() && Auth::user()->admin)
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-users-cog"></i>
                                <p>
                                    Панель админа
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('tasks.index')}}" class="nav-link">
                                        <i class="fas fa-tasks nav-icon"></i>
                                        <p>Задачи</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('projects.index')}}" class="nav-link">
                                        <i class="fas fa-project-diagram nav-icon"></i>
                                        <p>Проекты</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('users.index')}}" class="nav-link">
                                        <i class="fas fa-users nav-icon"></i>
                                        <p>Пользователи</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </aside>

    <!-- Обертка контента -->
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <!-- Заголовок страницы -->
                    <div class="col-sm-6">
                        <h1 class="m-0">@yield('title')</h1>
                    </div>
                    <div class="col-sm-6">
                        <!-- Хлебные крошки -->
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Главная</a></li>
                            @if(isset($breadcrumbs))
                                @include('components.breadcrumbs', $breadcrumbs)
                            @endif
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        @yield('content')

    </div>

    <!-- Опции -->
    <aside class="control-sidebar control-sidebar-dark"></aside>

    <!-- Подвал сайта -->
    <footer class="main-footer">
        <!-- Название и год создания сайта справа -->
        <div class="float-right d-none d-sm-inline">
            <strong>Task Tracker 2021</strong>
        </div>
        <!-- Копирайт слева-->
        <strong>Copyright &copy; 2021 <a href="{{url('/')}}">Task Tracker</a>.</strong> Все права защищены.
    </footer>
</div>

</body>
</html>
