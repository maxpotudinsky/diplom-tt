@foreach($comments as $comment)
    <!-- Комментарии -->
    <div class="direct-chat-msg">
        <div class="direct-chat-info clearfix">
            <span class="direct-chat-name pull-left">{{$comment->user->name}}</span>
            <span class="direct-chat-timestamp pull-right">{{$comment->created_at}}</span>
        </div>
        @if(isset($comment->user->photo))
            <img class="direct-chat-img" src="{{$comment->user->photo}}" style="width: 35px; height: 35px;"
                 alt="comment user image">
        @else
            <img class="direct-chat-img" src="/dist/img/user2-160x160.jpg" alt="comment user image">
        @endif
        <div class="direct-chat-text">
            {{$comment->text}}
        </div>
    </div>
@endforeach

