@extends('layouts.admin')

@section('title', 'Пользователи')

@php
    $breadcrumbs = [
        [
            'name' => 'Пользователи',
            'url' => null
        ]
    ];
@endphp

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <a href="{{route('users.create')}}" class="btn btn-warning mb-2">Добавить пользователя</a>
                </div>
                <div class="col-lg-6">
                    @if(session()->has('message-success'))
                        <div class="alert alert-success">
                            {{ session()->get('message-success') }}
                        </div>
                    @elseif(session()->has('message-error'))
                        <div class="alert alert-danger">
                            {{ session()->get('message-error') }}
                        </div>
                    @endif
                </div>
            </div>
            <table class="table mt-3">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Имя</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Телефон</th>
                    <th scope="col">Хэш пароля</th>
                    <th scope="col">Операции</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <th scope="row">{{$user->id}}</th>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->phone}}</td>
                        <td>{{$user->password}}</td>
                        <td><a href="{{route('users.show', $user->id)}}" class="text-decoration-none text-success">Редактировать</a>&#8194;&#8260;&#8194;
                            <a href="{{route('users.destroy', $user->id)}}" class="text-decoration-none text-danger"
                               onclick="event.preventDefault();
                                   document.getElementById('user-{{$user->id}}-destroy').submit();">Удалить</a>
                            <form id="user-{{$user->id}}-destroy" action="{{route('users.destroy', $user->id)}}"
                                  method="post" class="d-none">
                                @csrf
                                <input type="hidden" name="_method" value="delete"/>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">{{$users->links()}}</div>
        </div>
    </div>
@endsection
