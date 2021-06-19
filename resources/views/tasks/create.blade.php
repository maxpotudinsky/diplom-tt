@extends('layouts.main')

@section('title', 'Добавление задачи')

<!-- Хлебные крошки -->
@php
    $breadcrumbs = [
        [
            'name' => 'Задачи',
            'url' => '/tasks'
        ],[
            'name' => 'Добавление задачи',
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
                    <!-- Форма добавления задачи -->
                    <form action="{{route('tasks.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
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
                        <!-- Поле название -->
                        <div class="form-group">
                            <label for="name" class="form-label">Название</label>
                            <input type="text" class="form-control{{($errors->first('name') ? " border-danger" : "")}}"
                                   id="name" name="name" required>
                        </div>
                        <fieldset class="form-group">
                            <legend>Общее</legend>
                            <div class="row">
                                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                    <!-- Поле общий (ч/ч) -->
                                    <div class="form-group">
                                        <label for="time" class="form-label">Общий (ч/ч)</label>
                                        <input type="number"
                                               class="form-control{{($errors->first('time') ? " border-danger" : "")}}"
                                               id="time" name="time" required
                                               min="1">
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                    <!-- Поле фактический (ч/ч) -->
                                    <div class="form-group">
                                        <label for="fact_time" class="form-label">Фактический (ч/ч)</label>
                                        <input type="number"
                                               class="form-control{{($errors->first('fact_time') ? " border-danger" : "")}}"
                                               id="fact_time" name="fact_time" required
                                               min="1">
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                    <!-- Поле стоимость (руб.) -->
                                    <div class="form-group">
                                        <label for="price" class="form-label">Стоимость (руб.)</label>
                                        <input type="number"
                                               class="form-control{{($errors->first('price') ? " border-danger" : "")}}"
                                               id="price" name="price" required
                                               min="0">
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <div class="row">
                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <!-- Список пользователей для роли исполнитель -->
                                <div class="form-group">
                                    <label for="executor">Исполнитель:</label>
                                    <select class="form-control" id="executor" name="executor">
                                        @foreach ($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <!-- Список проектов текущей компании -->
                                <div class="form-group">
                                    <label for="project" class="form-label">Проект:</label>
                                    <select class="form-control{{($errors->first('project') ? " border-danger" : "")}}"
                                            id="project" name="project" required>
                                        @foreach ($projects as $project)
                                            <option value="{{$project->id}}">{{$project->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <!-- Список пользователей для роли заказчик -->
                                <div class="form-group">
                                    <label for="customer" class="form-label">Заказчик:</label>
                                    <select class="form-control" id="customer" name="customer">
                                        @foreach ($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <fieldset class="form-group">
                            <legend>Дополнительно</legend>
                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <!-- Поле лимит (ч/ч) -->
                                    <div class="form-group">
                                        <label for="limit" class="form-label">Лимит (ч/ч):</label>
                                        <input type="number"
                                               class="form-control{{($errors->first('limit') ? " border-danger" : "")}}"
                                               id="limit" name="limit" required
                                               min="1">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <!-- Поле важность (ч/ч) -->
                                    <div class="form-group">
                                        <label for="importance" class="form-label">Важность:</label>
                                        <select
                                            class="form-control{{($errors->first('importance') ? " border-danger" : "")}}"
                                            id="importance" name="importance" required>
                                            {{($step = 110)}}
                                            @for($i = 20; $i >= 0; $i--)
                                                {{$step = $step - 10}}
                                                <option @if($step == 10) selected @endif>{{$step}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                            <!-- Поле описание (ч/ч) -->
                        <div class="form-group">
                            <label for="text">Описание</label>
                            <textarea class="form-control{{($errors->first('text') ? " border-danger" : "")}}" rows="5"
                                      id="text" name="text" required></textarea>
                        </div>
                            <!-- Поле файл (ч/ч) -->
                        <div class="form-group">
                            <label for="file">Файл</label>
                            <input type="file" class="form-control" id="file" name="files[]" multiple>
                        </div>
                            <!-- Кнопка добавить задачу -->
                        <div class="form-group">
                            <input type="submit" class="mb-3 float-end btn btn-warning" value="Добавить задачу">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
