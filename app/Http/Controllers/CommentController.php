<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CommentController extends Controller
{
    public function create(Request $request, $projectId, $taskId)
    {
        Comment::create([
            'text' => $request->comment,
            'user_id' => Auth::user()->id,
            'task_id' => $taskId,
            'project_id' => $projectId,
            'company_id' => Auth::user()->company_id,
        ]);
    }

    public function get($projectId, $taskId)
    {
        $comments = Comment::where([
            'company_id' => Auth::user()->company_id,
            'project_id' => $projectId,
            'task_id' => $taskId,
        ])->get();

        return view('comments', compact('comments'));
    }
}
