@extends('layouts.admin')

@section('title', 'Добавление пользователя')

@php
    $breadcrumbs = [
            [
                'name' => 'Пользователи',
                'url' => '/users'
            ],[
                'name' => 'Добавление пользователя',
                'url' => null
            ],
        ];
@endphp

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <form action="{{route('users.store')}}" method="post">
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h6><i class="icon fas fa-exclamation-triangle"></i> Внимание!</h6>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="name" class="form-label">Имя</label>
                            <input type="text" class="form-control{{($errors->first('name') ? " border-danger" : "")}}"
                                   id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email"
                                   class="form-control{{($errors->first('email') ? " border-danger" : "")}}"
                                   id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="form-label">Телефон</label>
                            <input type="number" class="form-control{{($errors->first('phone') ? " border-danger" : "")}}"
                                   id="phone" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-label">Пароль</label>
                            <input type="password"
                                   class="form-control{{($errors->first('password') ? " border-danger" : "")}}"
                                   id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation" class="form-label">Повтор пароля</label>
                            <input type="password"
                                   class="form-control{{($errors->first('password_confirmation') ? " border-danger" : "")}}"
                                   id="password_confirmation" name="password_confirmation" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="mb-3 float-end btn btn-warning" value="Добавить пользователя">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
