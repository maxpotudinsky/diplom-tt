@extends('layouts.main')

@section('title', 'Редактирование проекта')

<!-- Хлебные крошки -->
@php
    $breadcrumbs = [
        [
            'name' => 'Проекты',
            'url' => '/projects'
        ],[
            'name' => 'Редактирование проекта',
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
                    <!-- Форма редактирования проекта -->
                    <form action="{{route('projects.update', $project->id)}}" method="post">
                        @csrf
                        <input type="hidden" name="_method" value="put" />
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
                            <input type="text" value="{{$project->name}}" class="form-control{{($errors->first('name') ? " border-danger" : "")}}" id="name" name="name" required>
                        </div>
                        <!-- Поле бюджет (в ч/ч) -->
                        <div class="form-group">
                            <label for="budget" class="form-label">Бюджет (в ч/ч)</label>
                            <input type="number" value="{{$project->budget}}" class="form-control{{($errors->first('budget') ? " border-danger" : "")}}" id="budget" name="budget" required min="1">
                        </div>
                        <!-- Описание -->
                        <div class="form-group">
                            <label for="text">Описание</label>
                            <textarea class="form-control{{($errors->first('text') ? " border-danger" : "")}}" rows="5" id="text" name="text" required>{{$project->text}}</textarea>
                        </div>
                        <!-- Кнопка обновить проект -->
                        <div class="form-group">
                            <input type="submit" class="mb-3 float-end btn btn-warning" value="Обновить проект">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
