@foreach($projects as $project)
    @foreach($project->tasks as $task)
        @if($task->project->is_active && $task->is_active)
            <div class="card card-modal" id="{{$task->id}}" data-toggle="modal"
                 data-target="#list-task-id{{$task->id}}" style="cursor: pointer;">
                <div class="card-body">
                    <h5 class="card-title">{{$task->name}}</h5>
                    <p class="card-text">
                        <span>{{$task->project->name}}</span>&#8194;&#8260;&#8194;
                        <span>{{$task->taskStatus->name}}</span>&#8194;&#8260;&#8194;
                        <span>{{$task->created_at}}</span>&#8194;&#8260;&#8194;
                        @foreach($executors as $executor)
                            @if($executor->id == $task->roles[1]->pivot->user_id)
                                <span>Исполнитель: <span style="color: #FF8C00;">{{$executor->name}}</span></span>
                                &#8194;&#8260;&#8194;
                            @endif
                        @endforeach
                        @foreach($directors as $director)
                            @if($director->id == $task->roles[0]->pivot->user_id)
                                <span>Постановщик: <span style="color: #FF8C00;">{{$director->name}}</span></span>
                                &#8194;&#8260;&#8194;
                            @endif
                        @endforeach
                        <span>({{$task->time}}ч.)</span>
                    </p>
                </div>
            </div>
{{--            @include('tasks.cards.modal')--}}
        @endif
    @endforeach
@endforeach
