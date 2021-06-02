@foreach($comments as $comment)
    <div class="direct-chat-msg">
        <div class="direct-chat-info clearfix">
            <span class="direct-chat-name pull-left">{{$comment->user->name}}</span>
            <span class="direct-chat-timestamp pull-right">{{$comment->created_at}}</span>
        </div>
        <img class="direct-chat-img" src="/dist/img/user2-160x160.jpg" alt="message user image">
        <div class="direct-chat-text">
            {{$comment->text}}
        </div>
    </div>
@endforeach

