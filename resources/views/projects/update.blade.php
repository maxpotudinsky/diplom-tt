@extends('layouts.admin')

@section('title', 'Редактирование проекта')

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
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <form action="{{route('projects.update', $project->id)}}" method="post">
                        @csrf
                        <input type="hidden" name="_method" value="put" />
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="name" class="form-label">Название</label>
                            <input type="text" value="{{$project->name}}" class="form-control{{($errors->first('name') ? " border-danger" : "")}}" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="budget" class="form-label">Бюджет (в ч/ч)</label>
                            <input type="number" value="{{$project->budget}}" class="form-control{{($errors->first('budget') ? " border-danger" : "")}}" id="budget" name="budget" required min="1">
                        </div>
                        <div class="form-group">
                            <label for="text">Описание</label>
                            <textarea class="form-control{{($errors->first('text') ? " border-danger" : "")}}" rows="5" id="text" name="text" required>{{$project->text}}</textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="mb-3 float-end btn btn-warning" value="Обновить проект">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
