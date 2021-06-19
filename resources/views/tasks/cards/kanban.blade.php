@foreach($tasks as $task)
    @if($task->is_active && $task->project_id == $project->id && $task->status_id == $taskStatus->id)
        <!-- Задачи в виде карточек -->
        <div id="{{$task->id}}" data-toggle="modal"
             data-target="#task-id{{$task->id}}"
             class="card js-card card-outline @if($task->status_id == 1) card-secondary @endif
             @if($task->status_id == 2) card-primary @endif
             @if($task->status_id == 3) card-warning @endif
             @if($task->status_id == 4) card-success @endif card-modal" draggable="true"
             style="cursor: all-scroll;">
            <div class="card-header"><b class="">{{$task->name}}</b><br><span class="text-info"> ({{$task->time}}ч.)</span>&#8194;&#8260;&#8194;<span class="text-success">({{$task->importance}})</span>
                <!-- Проверка пользователя на роль постановщик -->
            @if(Auth::user()->id == $task->roles[0]->pivot->user_id)
                <!-- Возможность постановщиков редактировать свои задачи -->
                    <div class="card-tools">
                        <a href="{{route('tasks.show', $task->id)}}" class="btn btn-tool">
                            <i class="fas fa-pen"></i>
                        </a>
                    </div>
                @endif
            </div>
            <div class="card-body">
            @foreach($executors as $executor)
                @if($executor->id == $task->roles[1]->pivot->user_id)
                    <!-- Вывод исполнителя задачи -->
                        <p class="card-text cut-text"><b>Описание: </b>{{$task->text}}</p>
                        <p class="card-text"><b>Исполнитель: </b><span class="darkOrange">{{$executor->name}}</span></p>
                    @endif
                @endforeach
                <small class="float-end">@if($task->updated_at == null){{$task->created_at}}@else{{$task->updated_at}}@endif</small>
            </div>
        </div>
        <!-- Всплывающее окно с подробной информацией задачи -->
        @include('tasks.cards.modal')
    @endif
@endforeach
