@extends('layouts.main')

@section('title', 'Профиль')

<!-- Хлебные крошки -->
@php
    $breadcrumbs = [
        [
            'name' => 'Профиль',
            'url' => null
        ]
    ];
@endphp

@section('content')
    <div class="content">
        <!-- Обертка контента -->
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <!-- Форма редактирования профиля -->
                    <form action="{{route('profile.update', Auth::user()->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="p-3 card">
                            <div class="row">
                                <div class="col-sm-3 col-md-2 col-lg-2 col-xl-2">
                                    <div class="text-center">
                                        <!-- Проверка на наличие фотографии пользователя -->
                                        @if(isset(Auth::user()->photo))
                                            <!-- Фотография пользователя -->
                                            <img class="img-fluid img-circle elevation-3" src="{{Auth::user()->photo}}"
                                                 alt="User profile picture" style="width: 100px; height: 100px;">
                                        @else
                                            <img class="img-fluid img-circle elevation-3" src="/dist/img/user2-160x160.jpg"
                                                 alt="User profile picture" style="width: 100px; height: 100px;">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-9 col-md-10 col-lg-10 col-xl-10">
                                    <!-- Поле добавления фотографии пользователя -->
                                    <div class="form-group">
                                        <label for="photo">Фото</label>
                                        <input type="file" class="form-control" id="photo" name="photo" accept="image/jpeg, image/png">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Проверка на наличие ошибок при отправке формы -->
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h6><i class="icon fas fa-exclamation-triangle"></i> Внимание!</h6>
                                <ul>
                                    <!-- Вывод ошибок при их наличии -->
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <!-- Сообщение об удачном редактировании профиля -->
                        @if(session()->has('message-success'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h6><i class="icon far fa-check-circle"></i>{{ session()->get('message-success') }}</h6>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <!-- Поле имя -->
                                <div class="form-group">
                                    <label for="name" class="form-label">Имя</label>
                                    <input type="text"
                                           class="form-control{{($errors->first('name') ? " border-danger" : "")}}"
                                           id="name" name="name" value="{{$user->name}}" required>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <!-- Поле телефон -->
                                <div class="form-group">
                                    <label for="phone" class="form-label">Телефон</label>
                                    <input type="number"
                                           class="form-control{{($errors->first('phone') ? " border-danger" : "")}}"
                                           id="phone" name="phone" value="{{$user->phone}}" required>
                                </div>
                            </div>
                        </div>
                        <!-- Поле e-mail -->
                        <div class="form-group">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email"
                                   class="form-control{{($errors->first('email') ? " border-danger" : "")}}"
                                   id="email" name="email" value="{{$user->email}}" required>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <!-- Поле пароль -->
                                <div class="form-group">
                                    <label for="password" class="form-label">Пароль</label>
                                    <input type="password"
                                           class="form-control{{($errors->first('password') ? " border-danger" : "")}}"
                                           id="password" name="password" required>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <!-- Поле новый пароль -->
                                <div class="form-group">
                                    <label for="password" class="form-label">Новый пароль</label>
                                    <input type="password"
                                           class="form-control{{($errors->first('new_password') ? " border-danger" : "")}}"
                                           id="new_password" name="new_password" required>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <!-- Поле повтор нового пароля -->
                                <div class="form-group">
                                    <label for="password_confirmation" class="form-label">Повтор нового пароля</label>
                                    <input type="password"
                                           class="form-control{{($errors->first('password_confirmation') ? " border-danger" : "")}}"
                                           id="password_confirmation" name="password_confirmation" required>
                                </div>
                            </div>
                        </div>
                        <!-- Кнопка обновить профиль -->
                        <div class="form-group">
                            <input type="submit" class="mb-3 float-end btn btn-warning" value="Обновить профиль">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
