@extends('layouts.admin')

@section('title', 'Проекты')

@php
    $breadcrumbs = [
        [
            'name' => 'Проекты',
            'url' => null
        ]
    ];
@endphp

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <a href="{{route('projects.create')}}" class="btn btn-warning mb-2">Добавить проект</a>
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
                    <th scope="col">Бюджет</th>
                    <th scope="col">Описание</th>
                    <th scope="col">Архив</th>
                    <th scope="col">Код</th>
                    <th scope="col">Операции</th>
                </tr>
                </thead>
                <tbody>
                @foreach($projects as $project)
                    <tr>
                        <th scope="row">{{$project->id}}</th>
                        <td>{{$project->name}}</td>
                        <td>{{$project->budget}}</td>
                        <td>{{$project->text}}</td>
                        <td><form action="{{route('projects.edit', $project->id)}}" method="get">
                                <input type="checkbox" @if($project->is_active == 0) checked @endif onclick="this.form.submit()">
                            </form>
                        </td>
                        <td>{{$project->code}}</td>
                        <td><a href="{{route('projects.show', $project->id)}}"
                               class="text-decoration-none text-success">Редактировать</a>&#8194;&#8260;&#8194;
                            <a href="{{route('projects.destroy', $project->id)}}"
                               class="text-decoration-none text-danger" onclick="event.preventDefault();
                                document.getElementById('project-{{$project->id}}-destroy').submit();">Удалить</a>
                            <form id="project-{{$project->id}}-destroy"
                                  action="{{route('projects.destroy', $project->id)}}" method="post" class="d-none">
                                @csrf
                                <input type="hidden" name="_method" value="delete"/>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">{{$projects->links()}}</div>
        </div>
    </div>
@endsection
