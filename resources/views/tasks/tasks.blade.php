@extends('layouts.admin')

@section('title', 'Задачи')

@php
    $breadcrumbs = [
        [
            'name' => 'Задачи',
            'url' => null
        ]
    ];
@endphp

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <a href="{{route('tasks.create')}}" class="btn btn-warning mb-2">Добавить задачу</a>
                </div>
                <div class="col-lg-6">
                    @if(session()->has('message-success'))
                        <div class="alert alert-success">
                            {{ session()->get('message-success') }}
                        </div>
                    @endif
                </div>
            </div>
            <table class="table mt-3">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Название</th>
                    <th scope="col">Описание</th>
                    <th scope="col">Архив</th>
                    <th scope="col">Общий (ч/ч)</th>
                    <th scope="col">Внутренний (ч/ч)</th>
                    <th scope="col">Стоимость</th>
                    <th scope="col">Лимит (ч/ч)</th>
                    <th scope="col">Важность</th>
                    <th scope="col">Проект</th>
                    <th scope="col">Операции</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tasks as $task)
                    <tr>
                        <th scope="row">{{$task->id}}</th>
                        <td>{{$task->name}}</td>
                        <td>{{$task->text}}</td>
                        <td><form action="{{route('tasks.edit', $task->id)}}" method="get">
                                <input type="checkbox" @if($task->is_active == 0) checked @endif onclick="this.form.submit()">
                            </form>
                        </td>
                        <td>{{$task->time}}</td>
                        <td>{{$task->fact_time}}</td>
                        <td>{{$task->price}}</td>
                        <td>{{$task->limit}}</td>
                        <td>{{$task->importance}}</td>
                        <td>{{$task->project->name}}</td>
                        <td><a href="{{route('tasks.show', $task->id)}}" class="text-decoration-none text-success">Редактировать</a>&#8194;&#8260;&#8194;
                            <a href="{{route('tasks.destroy', $task->id)}}" class="text-decoration-none text-danger"
                               onclick="event.preventDefault();
                                   document.getElementById('task-{{$task->id}}-destroy').submit();">Удалить</a>
                            <form id="task-{{$task->id}}-destroy" action="{{route('tasks.destroy', $task->id)}}"
                                  method="post" class="d-none">
                                @csrf
                                <input type="hidden" name="_method" value="delete"/>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">{{$tasks->links()}}</div>
{{--            <div style="position: absolute; top: calc(100vh - 120px); left: 50%; right: 50%;">{{$tasks->links()}}</div>--}}
        </div>
    </div>
@endsection
