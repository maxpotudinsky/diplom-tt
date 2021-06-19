@extends('layouts.main')

@section('title', 'Задачи')

{{session()->put('links', request()->path())}}

<!-- Хлебные крошки -->
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
        <!-- Обертка контента -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <!-- Кнопка добавить задачу -->
                    <a href="{{route('tasks.create')}}" class="btn btn-warning mb-2">Добавить задачу</a>
                </div>
                <div class="col-lg-6">
                    <!-- Сообщение об удачном редактировании задачи -->
                    @if(session()->has('message-success'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h6><i class="icon far fa-check-circle"></i>{{ session()->get('message-success') }}</h6>
                        </div>
                    @endif
                </div>
            </div>
            <!-- Таблица с задачами -->
            <table class="table mt-3">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Задача</th>
                    <th scope="col">Проект</th>
                    <th scope="col">Описание</th>
                    <th scope="col">Общее время</th>
                    <th scope="col">Факт. время</th>
                    <th scope="col">Стоимость</th>
                    <th scope="col">Лимит</th>
                    <th scope="col">Важность</th>
                    <th scope="col">Архив</th>
                    <th scope="col">Операции</th>
                </tr>
                </thead>
                <tbody>
                <!-- Вывод задач в таблицу -->
                @foreach($tasks as $task)
                    <tr>
                        <th scope="row">{{$task->id}}</th>
                        <td>{{$task->name}}</td>
                        <td>{{$task->project->name}}</td>
                        <td>{{$task->text}}</td>
                        <td>{{$task->time}} (ч/ч)</td>
                        <td>{{$task->fact_time}} (ч/ч)</td>
                        <td>{{$task->price}} руб.</td>
                        <td>{{$task->limit}} (ч/ч)</td>
                        <td class="text-center">{{$task->importance}}</td>
                        <td>
                            <!-- Помещение задачи в архив -->
                            <form action="{{route('tasks.edit', $task->id)}}" method="get" class="text-center">
                                <input type="checkbox" @if($task->is_active == 0) checked @endif onclick="this.form.submit()">
                            </form>
                        </td>
                        <!-- Опции -->
                        <td>
                            <div class="btn-group">
                                <!-- Опция редактировать задачу -->
                                <a href="{{route('tasks.show', $task->id)}}" class="btn btn-success">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                    </svg>
                                </a>
                                <!-- Опция удалить задачу -->
                                <a href="{{route('tasks.destroy', $task->id)}}" class="btn btn-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <!-- Пагинация таблицы с задачами -->
            <div class="d-flex justify-content-center">{{$tasks->links()}}</div>
        </div>
    </div>
@endsection
