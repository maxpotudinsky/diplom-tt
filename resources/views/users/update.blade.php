@extends('layouts.main')

@section('title', 'Редактирование пользователя')

<!-- Хлебные крошки -->
@php
    $breadcrumbs = [
            [
                'name' => 'Пользователи',
                'url' => '/users'
            ],[
                'name' => 'Редактирование пользователя',
                'url' => null
            ],
        ];
@endphp

@section('content')
    <div class="content">
        <!-- Обертка контента -->
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <!-- Форма редактирования пользователя -->
                    <form action="{{route('users.update', $user->id)}}" method="post">
                        @csrf
                        <input type="hidden" name="_method" value="put"/>
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
                    <!-- Поле имя -->
                        <div class="form-group">
                            <label for="name" class="form-label">Имя</label>
                            <input type="text" class="form-control{{($errors->first('name') ? " border-danger" : "")}}"
                                   id="name" name="name" value="{{$user->name}}" required>
                        </div>
                        <!-- Поле e-mail -->
                        <div class="form-group">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email"
                                   class="form-control{{($errors->first('email') ? " border-danger" : "")}}"
                                   id="email" name="email" value="{{$user->email}}" required>
                        </div>
                        <!-- Поле телефон -->
                        <div class="form-group">
                            <label for="phone" class="form-label">Телефон</label>
                            <input type="number"
                                   class="form-control{{($errors->first('phone') ? " border-danger" : "")}}"
                                   id="phone" name="phone" value="{{$user->phone}}" required>
                        </div>
                        <!-- Поле пароль -->
                        <div class="form-group">
                            <label for="password" class="form-label">Пароль</label>
                            <input type="password"
                                   class="form-control{{($errors->first('password') ? " border-danger" : "")}}"
                                   id="password" name="password" required>
                        </div>
                        <!-- Поле новый пароль -->
                        <div class="form-group">
                            <label for="password" class="form-label">Новый пароль</label>
                            <input type="password"
                                   class="form-control{{($errors->first('new_password') ? " border-danger" : "")}}"
                                   id="new_password" name="new_password" required>
                        </div>
                        <!-- Поле повтор нового пароля -->
                        <div class="form-group">
                            <label for="password_confirmation" class="form-label">Повтор нового пароля</label>
                            <input type="password"
                                   class="form-control{{($errors->first('password_confirmation') ? " border-danger" : "")}}"
                                   id="password_confirmation" name="password_confirmation" required>
                        </div>
                        <!-- Кнопка обновить пользователя -->
                        <div class="form-group">
                            <input type="submit" class="mb-3 float-end btn btn-warning" value="Обновить пользователя">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
