<?php

namespace App\Http\Controllers;

use App\Filters\ProjectFilter;
use App\Project;
use App\RoleTask;
use App\Task;
use App\TaskStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(ProjectFilter $request)
    {
        $projects = Project::where(['company_id' => Auth::user()->company_id])->filter($request)->get();
        $taskStatuses = TaskStatus::where('id', '!=', 5)->get();
        $tasks = Task::where(['company_id' => Auth::user()->company_id])->get();
//        $tasks = Task::where(['company_id' => Auth::user()->company_id])->get();
//        foreach ($tasks as $task) {
//            $executors = RoleTask::where(['task_id' => $task->id])->first()->pluck('user_id');
//        }
//        $director = RoleTask::where(['task_id' => $id])->get()->last();

        return view('home', compact('projects', 'taskStatuses', 'tasks'));
    }
}
