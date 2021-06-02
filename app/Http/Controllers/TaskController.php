<?php

namespace App\Http\Controllers;

use App\File;
use App\Filters\TaskFilter;
use App\Project;
use App\Role;
use App\RoleTask;
use App\Task;
use App\Http\Requests\TaskRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class TaskController extends Controller
{
    public function changeStatus(Request $request)
    {
//        dd($request);
        Task::find($request->taskId)->update(['status_id' => $request->statusId]);

        return response(['status' => true]);
    }

    public function edit($id)
    {
        $task = Task::find($id);
        if ($task->is_active == 1) {
            $task->is_active = 0;
        } else {
            $task->is_active = 1;
        }
        $task->save();

        return redirect::back();
    }

    public function destroy($id)
    {
//        dd(Task::find($id)->id);
        $task = Task::find($id);
        $task->roles()->detach();
        $task->delete();

        return redirect::route('tasks.index')->with('message-success', 'Задача успешно удалена!');
    }

    public function update(TaskRequest $request, $id)
    {
        $task = Task::find($id);
        $task->update([
            'name' => $request->name,
            'text' => $request->text,
            'time' => $request->time,
            'fact_time' => $request->fact_time,
            'price' => $request->price,
            'limit' => $request->limit,
            'importance' => $request->importance,
            'project_id' => $request->project,
        ]);

//        $executorId = Role::where('name', 'Исполнитель')->value('id');
//        dd($executorId);
//        $task->roles()->sync([$executorId]);

        RoleTask::where('task_id', '=', $id)->first()->update([
            'user_id' => $request->executor,
            'role_id' => 2,
        ]);

        RoleTask::where('task_id', '=', $id)->get()->last()->update([
            'user_id' => $request->customer,
            'role_id' => 3,
        ]);

        if ($request->hasfile('files')) {
            foreach ($request->file('files') as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path() . '/files/', $name);
                $query = File::where(['task_id' => $id]);
                if ($query->exists() == true) {
                    $query->update([
                        'name' => '/files/' . $name,
                    ]);
                } else {
                    $query->create([
                        'name' => '/files/' . $name,
                        'task_id' => $id,
                    ]);
                }
            }
        }

        return redirect::route('tasks.index')->with('message-success', 'Задача успешно отредактирована!');
    }

    public function show($id)
    {
        $task = Task::find($id);
        $users = User::where(['company_id' => Auth::user()->company_id])->get();
        $projects = Project::where(['company_id' => Auth::user()->company_id])->get();
        $executor = RoleTask::where(['task_id' => $id])->first();
        $customer = RoleTask::where(['task_id' => $id])->get()->last();

//        dd(Role::with('tasks')->get());
//        dd(Task::with('roles')->where('task_id', '=', 1)->first());
        $roles = Role::all();

        return view('tasks.update', compact(['task', 'users', 'projects', 'executor', 'customer', 'roles']));
    }

    public function store(TaskRequest $request)
    {
        $task = Task::create([
            'name' => $request->name,
            'text' => $request->text,
            'time' => $request->time,
            'fact_time' => $request->fact_time,
            'price' => $request->price,
            'limit' => $request->limit,
            'importance' => $request->importance,
            'project_id' => $request->project,
            'company_id' => Auth::user()->company_id,
        ]);

        $task->roles()->attach(2, [
            'user_id' => $request->executor,
            'task_id' => $task->id,
            'project_id' => $task->project_id,
            'company_id' => $task->company_id,
        ]);

        $task->roles()->attach(3, [
            'user_id' => $request->customer,
            'task_id' => $task->id,
            'project_id' => $task->project_id,
            'company_id' => $task->company_id,
        ]);

//        RoleTask::create([
//            'user_id' => $request->executor,
//            'role_id' => 2,
//            'task_id' => $task->id,
//            'project_id' => $task->project_id,
//            'company_id' => $task->company_id,
//        ]);
//
//        RoleTask::create([
//            'user_id' => $request->customer,
//            'role_id' => 3,
//            'task_id' => $task->id,
//            'project_id' => $task->project_id,
//            'company_id' => $task->company_id,
//        ]);

        if ($request->hasfile('files')) {
            foreach ($request->file('files') as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path() . '/files/', $name);
                File::create([
                    'name' => '/files/' . $name,
                    'task_id' => $task->id,
                ]);
            }
        }

        return redirect::route('tasks.index')->with('message-success', 'Задача успешно добавлена!');
//        return redirect(session('links')[2])->withInput();
    }

    public function create()
    {
        $users = User::where(['company_id' => Auth::user()->company_id])->get();
        $projects = Project::where(['company_id' => Auth::user()->company_id])->get();

        return view('tasks.create', compact(['users', 'projects']));
    }

    public function index()
    {
        $tasks = Task::where(['company_id' => Auth::user()->company_id])->paginate(4);
        $projects = Project::where(['company_id' => Auth::user()->company_id])->get();

        return view('tasks.tasks', compact(['tasks', 'projects']));
    }
}
