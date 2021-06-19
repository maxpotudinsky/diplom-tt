<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    //Метод создания комментариев пользователей
    public function create(Request $request, $taskId)
    {
        Comment::create([
            'text' => $request->comment,
            'user_id' => Auth::user()->id,
            'task_id' => $taskId,
        ]);
    }

    //Метод подключения страницы комментариев пользователей и их получения
    public function get($taskId)
    {
        $comments = Comment::where([
            'task_id' => $taskId,
        ])->get();

        return view('comments', compact('comments'));
    }
}
