@extends('layouts.admin')

@section('title', 'Главная')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <a href="{{route('tasks.create')}}" class="btn btn-warning mb-3">Добавить задачу</a>
            {{--            <style>--}}
            {{--                .nav-pills .nav-link.active {--}}
            {{--                    background: #FFC107;--}}
            {{--                    color: black;--}}
            {{--                }--}}
            {{--                .nav-pills .nav-link.active:hover {--}}
            {{--                    color: black;--}}
            {{--                }--}}
            {{--            </style>--}}
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#stages">Стадии</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#list">Список</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#directors">Отобразить с постановщиками</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div id="stages" class="tab-pane active"><br>

                    <form action="{{route('home')}}" method="get" id="filter">
                        <div class="row">
                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <select class="form-select" name="project_id" onchange="this.form.submit()">
                                        <option disabled selected value="">Все проекты</option>
                                        @foreach($projects as $project)
                                            <option value="{{$project->id}}"
                                                    @if(isset($_GET['project_id'])) @if($_GET['project_id'] == $project->id) selected @endif @endif>{{$project->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <select class="form-select" name="executor_id">
                                        <option disabled selected value="">Все исполнители</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <select class="form-select" name="director_id">
                                        <option disabled selected value="">Все постановщики</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>

                    {{--                    <div id="projects">--}}
                    {{--                        @foreach($projects as $project)--}}
                    {{--                            <h4>Проект: &laquo;{{$project->name}}&raquo;</h4>--}}
                    {{--                            <div class="row">--}}
                    {{--                                @foreach($taskStatuses as $taskStatus)--}}
                    {{--                                    <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 jq-cell"--}}
                    {{--                                         data-status="{{$taskStatus->id}}" style="min-height: 300px;">--}}
                    {{--                                        <h5>{{$taskStatus->name}}</h5>--}}
                    {{--                                        <hr>--}}
                    {{--                                        <div class="card ajaxCell" id="55"></div>--}}
                    {{--                                        @if(isset($tasks))--}}
                    {{--                                        @foreach($tasks as $task)--}}
                    {{--                                            @if($task->project_id == $project->id && $task->status_id == $taskStatus->id)--}}
                    {{--                                                <div class="card jq-card" id="{{$task->id}}" data-card="{{$task->id}}"--}}
                    {{--                                                     data-status="{{$taskStatus->id}}"--}}
                    {{--                                                     style="z-index: 999; cursor: all-scroll;">--}}
                    {{--                                                    <div class="card-header">{{$task->name}}</div>--}}
                    {{--                                                    <div class="card-body">--}}
                    {{--                                                        <p class="card-text">Исполнитель: Максим П.</p>--}}
                    {{--                                                        <small class="float-end">{{$task->created_at}}</small>--}}
                    {{--                                                    </div>--}}
                    {{--                                                </div>--}}
                    {{--                                            @endif--}}
                    {{--                                        @endforeach--}}
                    {{--                                        @endif--}}
                    {{--                                    </div>--}}
                    {{--                                @endforeach--}}
                    {{--                            </div>--}}
                    {{--                            <hr>--}}
                    {{--                        @endforeach--}}
                    {{--                    </div>--}}

                    @foreach($projects as $project)
                        @if($project->is_active)
                            <h4 class="mb-3">Проект: &laquo;{{$project->name}}&raquo;</h4>
                            <div class="row">
                                @foreach($taskStatuses as $taskStatus)
                                    <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 js-cell" id="{{$taskStatus->id}}"
                                         style="min-height: 300px;">
                                        <h5>{{$taskStatus->name}}</h5>
                                        <hr>
                                        @foreach($tasks as $task)
                                            @if($task->is_active && $task->project_id == $project->id && $task->status_id == $taskStatus->id)
{{--                                                <a href="{{route('tasks.edit', $task->id)}}" id="{{$task->id}}"--}}
                                                <a href="" id="{{$task->id}}"
                                                   class="text-dark card js-card" draggable="true"
                                                   style="cursor: all-scroll;">
                                                    <div class="card-header">{{$task->name}}</div>
                                                    <div class="card-body">
                                                        <p class="card-text">Исполнитель: Максим П.</p>
                                                        <small class="float-end">{{$task->created_at}}</small>
                                                    </div>
                                                </a>
{{--                                                </a>--}}
                                            @endif
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                            <hr>
                        @endif
                    @endforeach

                </div>
                <div id="list" class="tab-pane fade"><br>
                    <div class="row">
                        <div class="col-6">
                            @foreach($tasks as $task)
                                @if($task->project->is_active && $task->is_active)
                                    <div class="card" id="{{$task->id}}" style="cursor: pointer;">
                                        <div class="card-header">{{$task->name}}</div>
                                        <div class="card-body">
                                            <span>{{$task->project->name}}&#8194;&#8260;&#8194;{{$task->taskStatus[0]->name}}&#8194;&#8260;&#8194;{{$task->created_at}}</span>
                                            <p class="card-text">Исполнитель: Максим П.</p>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div id="directors" class="tab-pane fade"><br>

                </div>
            </div>

        </div>
    </div>
@endsection
