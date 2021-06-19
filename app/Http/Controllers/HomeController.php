<?php

namespace App\Http\Controllers;

use App\Filters\ProjectFilter;
use App\Filters\TaskFilter;
use App\Project;
use App\Task;
use App\TaskStatus;
use App\User;
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

    //Метод подключения главной страницы
    public function index(ProjectFilter $filterProject, TaskFilter $filterTask)
    {
        $projectsSel = Project::where(['company_id' => Auth::user()->company_id, 'is_active' => 1])->get();
        $projects = Project::where(['company_id' => Auth::user()->company_id])->filter($filterProject)->get();
        $tasks = Task::with('roles')->where(['company_id' => Auth::user()->company_id])->filter($filterTask)->get();
        $taskStatuses = TaskStatus::where('id', '!=', 5)->get();
        $user = User::where(['company_id' => Auth::user()->company_id])->get();

        $director_ids = collect();
        $executor_ids = collect();
        $customer_ids = collect();
        foreach ($projects as $project) {
            foreach ($project->tasks as $task) {
                foreach ($task->roles as $role) {
                    if ($role->pivot->role_id == 1) {
                        $director_ids->push($role->pivot->user_id);
                    }
                    if ($role->pivot->role_id == 2) {
                        $executor_ids->push($role->pivot->user_id);
                    }
                    if ($role->pivot->role_id == 3) {
                        $customer_ids->push($role->pivot->user_id);
                    }
                }
            }
        }
        $directors = $user->whereIn('id', $director_ids);
        $executors = $user->whereIn('id', $executor_ids);
        $customers = $user->whereIn('id', $customer_ids);

        return view('home', compact('projectsSel', 'projects', 'tasks', 'taskStatuses', 'directors', 'executors', 'customers'));
    }
}
