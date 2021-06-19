@extends('layouts.main')

@section('title', 'Главная')

{{session()->put('links', request()->path())}}

@section('content')
    <div class="content">
        <!-- Обертка контента -->
        <div class="container-fluid">
            @if($projects->first() != null)
                <a href="{{route('tasks.create')}}" class="btn btn-warning mb-3">Добавить задачу</a>
            @else
                @if(Auth::user()->admin)
                    <a href="{{route('projects.create')}}" class="btn btn-warning mb-3">Добавить проект</a>
            @endif
        @endif
        <!-- Переключатели вкладок -->
            <ul class="nav nav-tabs">
                <!-- Переключатель канбан-доска -->
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#kanban-board">Канбан-доска</a>
                </li>
                <!-- Переключатель список -->
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#list">Список</a>
                </li>
            </ul>
            <!-- Панель вкладок -->
            <div class="tab-content">
                <!-- Вкладка канбан-доска -->
                <div id="kanban-board" class="tab-pane active"><br>
                    <!-- Фильтры проектов -->
                    <form action="{{route('home')}}" method="get" id="filter">
                        <!-- Ряд колонок с фильтром -->
                        <div class="row">
                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <!-- Фильтр по проектам -->
                                    <select class="form-select" name="project_id" onchange="this.form.submit()">
                                        <option selected value="">Все проекты</option>
                                        @foreach($projectsSel as $projectSel)
                                            <option value="{{$projectSel->id}}"
                                                    @if(isset($_GET['project_id'])) @if($_GET['project_id'] == $projectSel->id) selected @endif @endif>{{$projectSel->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <!-- Фильтр по исполнителям -->
                                    <select class="form-select" name="executor_id" onchange="this.form.submit()">
                                        <option selected value="">Все исполнители</option>
                                        @foreach($executors as $executor)
                                            <option value="{{$executor->id}}"
                                                    @if(isset($_GET['executor_id'])) @if($_GET['executor_id'] == $executor->id) selected @endif @endif>{{$executor->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <!-- Фильтр по постановщикам -->
                                    <select class="form-select" name="director_id" onchange="this.form.submit()">
                                        <option selected value="">Все постановщики</option>
                                        @foreach($directors as $director)
                                            <option value="{{$director->id}}"
                                                    @if(isset($_GET['director_id'])) @if($_GET['director_id'] == $director->id) selected @endif @endif>{{$director->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- Проекты -->
                    <div id="projects">
                        @foreach($projects as $project)
                            @if($project->is_active)
                                <h4 class="mb-3" id="project-id{{$project->id}}">Проект:
                                    &laquo;{{$project->name}}&raquo;</h4>
                                <div class="row">
                                @foreach($taskStatuses as $taskStatus)
                                    <!-- Колонки статусов задач -->
                                        <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                                            <div class="card card-row @if($taskStatus->id == 1) card-secondary @endif
                                            @if($taskStatus->id == 2) card-primary @endif
                                            @if($taskStatus->id == 3) card-warning @endif
                                            @if($taskStatus->id == 4) card-success @endif">
                                                <div class="card-header">
                                                    <!-- Имя статуса задачи -->
                                                    <h3 class="card-title">
                                                        {{$taskStatus->name}}
                                                    </h3>
                                                </div>
                                                <div class="card-body js-cell" id="{{$taskStatus->id}}">
                                                    <!-- Подключение данных вкладки канбан-доска -->
                                                    @include('tasks.cards.kanban')
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <hr>
                            @endif
                        @endforeach
                    </div>
                </div>
                <!-- Вкладка список-->
                <div id="list" class="tab-pane fade"><br>
                    <!-- Подключение данных вкладки список -->
                    @include('tasks.cards.list')
                </div>
            </div>
        </div>
    </div>
@endsection
