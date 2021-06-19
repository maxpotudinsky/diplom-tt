<div class="modal fade" id="task-id{{$task->id}}" tabindex="-1"
     role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">{{$task->name}}<span
                        class="text-info"> ({{$task->time}}ч.)</span>
                </h5>
                <button type="button" class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <p><b>Проект: </b>{{$task->project->name}}</p>
                    </div>
                    <div class="col-6">
                        <small
                            class="float-end">@if($task->updated_at == null){{$task->created_at}}@else{{$task->updated_at}}@endif</small>
                    </div>
                </div>
                <p><b>Лимит: </b><span class="text-danger">({{$task->limit}}ч.)</span></p>
                <p><b>Статус: </b><span class="
                            @if($task->status_id == 2) text-primary @endif
                    @if($task->status_id == 3) darkOrange @endif
                    @if($task->status_id == 4) text-success @endif">{{$task->taskStatus->name}}</span></p>
                <p><b>Описание: </b>{{$task->text}}</p>
                <p><b>Цена: </b>{{$task->price}} руб.</p>
                <p><b>Важность (-100/100): </b><span class="text-success">{{$task->importance}}</span></p>
                <div class="mb-3 row">
                    <div class="col-4 col-md-4 col-lg-4 col-xl-4">
                    @foreach($directors as $director)
                        @if($director->id == $task->roles[0]->pivot->user_id)
                            <!-- Вывод постановщика задачи -->
                                <p><b>Пост:</b> <span class="darkOrange">{{$director->name}}</span></p>
                            @endif
                        @endforeach
                    </div>
                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    @foreach($executors as $executor)
                        @if($executor->id == $task->roles[1]->pivot->user_id)
                            <!-- Вывод исполнителя задачи -->
                                <p><b>Исп:</b> <span class="darkOrange">{{$executor->name}}</span></p>
                            @endif
                        @endforeach
                    </div>
                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    @foreach($customers as $customer)
                        @if($customer->id == $task->roles[2]->pivot->user_id)
                            <!-- Вывод заказчика задачи -->
                                <p><b>Зак:</b> <span class="darkOrange">{{$customer->name}}</span></p>
                            @endif
                        @endforeach
                    </div>
                </div>
                <!-- Блок комментариев -->
                <div id="comments">
                    <h5 class="font-weight-bold">Комментарии:</h5>
                    <div class="p-2 comments"
                         style="border-radius: 8px; max-height: 240px; overflow-y: scroll"></div>
                </div>
            </div>
            <form
                action="{{route('comment', $task->id)}}"
                method="post"
                class="modal-footer">
                @csrf
                <label for="comment-id{{$task->id}}" class="d-none">Ваш
                    комментарий:</label>
                <textarea class="form-control comment"
                          name="comment"
                          id="kanban-comment-id{{$task->id}}"
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
