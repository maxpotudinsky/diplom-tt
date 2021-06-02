<?php

namespace App\Http\Controllers;

use App\Filters\ProjectFilter;
use App\Project;
use App\Role;
use App\RoleTask;
use App\Task;
use App\TaskStatus;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
//    public function get(ProjectFilter $request)
//    {
//        $projects = Project::where(['company_id' => Auth::user()->company_id])->filter($request)->get();
//        $taskStatuses = TaskStatus::where('id', '!=', 5)->get();
//        $tasks = Task::where(['company_id' => Auth::user()->company_id])->get();
//        $users = User::where(['company_id' => Auth::user()->company_id])->get();
//
//        return view('getProjects', compact( 'projects', 'taskStatuses', 'tasks', 'users'));
//    }

    public function index(ProjectFilter $request)
    {
        $projectsSel = Project::where(['company_id' => Auth::user()->company_id])->get();
        $projects = Project::where(['company_id' => Auth::user()->company_id])->filter($request)->get();
        $taskStatuses = TaskStatus::where('id', '!=', 5)->get();
        $tasks = Task::where(['company_id' => Auth::user()->company_id])->get();
        $users = User::where(['company_id' => Auth::user()->company_id])->get();

//        foreach ($tasks as $task) {
//            $users = User::where(['company_id' => Auth::user()->company_id, 'id' => $task->roles[0]->pivot->user_id])->get();
//        }

//        $users = User::where(['company_id' => Auth::user()->company_id])->get();

        $executor = Role::find(2);

//        $task = Task::find(1);
//dd($task->roles);
//        foreach ($task->roles as $role) {
//            dd($role->pivot->user_id);
//        }

//        $tasks = Task::where(['company_id' => Auth::user()->company_id])->get();
//        foreach ($tasks as $task) {
//            $executors = RoleTask::where(['task_id' => $task->id])->first()->pluck('user_id');
//        }
//        $director = RoleTask::where(['task_id' => $id])->get()->last();

        return view('home', compact('projectsSel', 'projects', 'taskStatuses', 'tasks', 'users', 'executor'));
    }
}
