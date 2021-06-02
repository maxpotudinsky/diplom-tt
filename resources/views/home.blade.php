@extends('layouts.admin')

@section('title', 'Главная')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <a href="{{route('tasks.create')}}" class="btn btn-warning mb-3">Добавить задачу</a>
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
                                        @foreach($projectsSel as $projectSel)
                                            <option value="{{$projectSel->id}}"
                                                    @if(isset($_GET['project_id'])) @if($_GET['project_id'] == $projectSel->id) selected @endif @endif>{{$projectSel->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    {{--                                    {{dd($executor->tasks->first())}}--}}
                                    <select class="form-select" name="executor_id" onchange="this.form.submit()">
                                        <option disabled selected value="">Все исполнители</option>


                                        {{--                                            @foreach ($tasks as $task)--}}
                                        {{--                                        @foreach($users as $user)--}}
                                        {{--                                            @foreach($executor->tasks as $task)--}}
                                        {{--                                                @if($user->id == $task->pivot->user_id)--}}
                                        {{--                                                    <option value="{{$user->id}}">{{$user->name}}</option>--}}
                                        {{--                                                @endif--}}
                                        {{--                                            @endforeach--}}
                                        {{--                                        @endforeach--}}
                                        {{--                                            @endforeach--}}

                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach


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
                    <div id="projects">
                        @foreach($projects as $project)
                            @if($project->is_active)
                                <h4 class="mb-3" id="project-id{{$project->id}}">Проект:
                                    &laquo;{{$project->name}}&raquo;</h4>
                                <div class="row">
                                    @foreach($taskStatuses as $taskStatus)
                                        <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 js-cell"
                                             id="{{$taskStatus->id}}"
                                             style="min-height: 300px;">
                                            <h5>{{$taskStatus->name}}</h5>
                                            <hr>
                                            @foreach($tasks as $task)
                                                @if($task->is_active && $task->project_id == $project->id && $task->status_id == $taskStatus->id)
                                                    <div id="{{$task->id}}" data-toggle="modal"
                                                         data-target="#task-id{{$task->id}}"
                                                         class="card js-card" draggable="true"
                                                         style="cursor: all-scroll;">
                                                        <div class="card-header">{{$task->name}}</div>
                                                        <div class="card-body">
                                                            @foreach($users as $user)
                                                                @if($user->id == $task->roles->first()->pivot->user_id)
                                                                    <p class="card-text">
                                                                        Исполнитель: {{$user->name}}</p>
                                                                @endif
                                                            @endforeach
                                                            <small class="float-end">{{$task->created_at}}</small>
                                                        </div>
                                                    </div>
                                                    <div class="modal fade" id="task-id{{$task->id}}" tabindex="-1"
                                                         role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title font-weight-bold">{{$task->name}}</h5>
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal"
                                                                            aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p class="">Проект: {{$task->project->name}}</p>
                                                                    <p class="">Статус: {{$task->taskStatus->name}}</p>
                                                                    <p class="">Описание: {{$task->text}}</p>
                                                                    <p class="">Цена: {{$task->price}} руб.</p>
                                                                    <p class="">Важность
                                                                        (0/100): {{$task->importance}}</p>
                                                                    <div id="comments">
                                                                        <h5 class="font-weight-bold">Комментарии:</h5>
                                                                        <div class="p-2 comments"
                                                                             style="border-radius: 8px; max-height: 240px; overflow-y: scroll"></div>
                                                                    </div>
                                                                </div>
                                                                <form
                                                                    action="{{route('comment', [$task->project->id, $task->id])}}"
                                                                    method="post"
                                                                    class="modal-footer">
                                                                    @csrf
                                                                    <label for="comment-id{{$task->id}}" class="d-none">Ваш
                                                                        комментарий:</label>
                                                                    <textarea class="form-control comment"
                                                                              name="comment"
                                                                              id="comment-id{{$task->id}}"
                                                                              placeholder="Написать комментарий..."></textarea>
                                                                    <a class="text-warning sendComment"
                                                                       style="border: none; background: none">
                                                                        <svg width="30" height="30" viewBox="0 0 16 16"
                                                                             class="bi bi-arrow-right-circle-fill"
                                                                             fill="currentColor"
                                                                             xmlns="http://www.w3.org/2000/svg">
                                                                            <path fill-rule="evenodd"
                                                                                  d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-8.354 2.646a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L9.793 7.5H5a.5.5 0 0 0 0 1h4.793l-2.147 2.146z"/>
                                                                        </svg>
                                                                    </a>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                                <hr>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div id="list" class="tab-pane fade"><br>
                    <div class="row">
                        <div class="col-6">
                            @foreach($tasks as $task)
                                @if($task->project->is_active && $task->is_active)
                                    <div class="card" id="{{$task->id}}" style="cursor: pointer;">
                                        <div class="card-header">{{$task->name}}</div>
                                        <div class="card-body">
                                            <span>{{$task->project->name}}&#8194;&#8260;&#8194;{{$task->taskStatus->name}}&#8194;&#8260;&#8194;{{$task->created_at}}</span>
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
