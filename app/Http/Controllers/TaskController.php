<?php

namespace App\Http\Controllers;

use App\File;
use App\Project;
use App\RoleTask;
use App\Task;
use App\Http\Requests\TaskRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class TaskController extends Controller
{
    //Метод смены статуса задач в канбане
    public function changeStatus(Request $request)
    {
        Task::find($request->taskId)->update(['status_id' => $request->statusId]);
    }

    //Метод помещения задачи в архив
    public function edit($id)
    {
//        $task = Task::find($id);
//        if ($task->status_id != 5) {
//            $prevStatus = $task->status_id;
//            $task->status_id = 5;
//        }
//        if ($task->status_id == 5) {
//            $task->status_id = $prevStatus;
//        }
//        $task->save();

        $task = Task::find($id);
        if ($task->is_active == 1) {
            $task->is_active = 0;
        } else {
            $task->is_active = 1;
        }
        $task->save();

        return redirect::back();
    }

    //Метод удаления задач в админ панели
    public function destroy($id)
    {
        $success = 'Задача успешно удалена!';
        Task::find($id)->delete();
        return redirect::route('tasks.index')->with('message-success', $success);
    }

    //Метод редактирования задач в админ панели
    public function update(TaskRequest $request, $id)
    {
        $success = 'Задача успешно отредактирована!';
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

        RoleTask::where('task_id', '=', $id)->skip(0)->first()->update([
            'user_id' => Auth::user()->id,
        ]);

        RoleTask::where('task_id', '=', $id)->skip(1)->first()->update([
            'user_id' => $request->executor,
        ]);

        RoleTask::where('task_id', '=', $id)->skip(2)->first()->update([
            'user_id' => $request->customer,
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

        return redirect(session()->get('links'))->with('message-success', $success);
    }

    //Метод подключения страницы редактирования задач в админ панели
    public function show($id)
    {
        $task = Task::find($id);
        $users = User::where(['company_id' => Auth::user()->company_id])->get();
        $projects = Project::where(['company_id' => Auth::user()->company_id])->get();
        $executor = RoleTask::where(['task_id' => $id])->skip(1)->first();
        $customer = RoleTask::where(['task_id' => $id])->skip(2)->first();

        return view('tasks.update', compact(['task', 'users', 'projects', 'executor', 'customer']));
    }

    //Метод создания задач в админ панели
    public function store(TaskRequest $request)
    {
        $success = 'Задача успешно добавлена!';
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

        $task->roles()->attach(1, [
            'user_id' => Auth::user()->id,
            'task_id' => $task->id,
        ]);

        $task->roles()->attach(2, [
            'user_id' => $request->executor,
            'task_id' => $task->id,
        ]);

        $task->roles()->attach(3, [
            'user_id' => $request->customer,
            'task_id' => $task->id,
        ]);

        if ($request->hasfile('files')) {
            foreach ($request->file('files') as $file) {
                $name = $file->getClientOriginalName();
//                $file->move(public_path() . '/files/'.$task->project->name.'/'.$task->name.'/'.Carbon::now()->format('l j F Y/H-i-s'), $name);
                $file->move(public_path() . '/files/', $name);
                File::create([
//                    'name' => '/files/'.$task->project->name.'/'.$task->name.'/'.Carbon::now()->format('l j F Y/H-i-s').'/'. $name,
                    'name' => '/files/'. $name,
                    'task_id' => $task->id,
                ]);
            }
        }

        return redirect(session()->get('links'))->with('message-success', $success);
    }

    //Метод подключения страницы создания задач в админ панели
    public function create()
    {
        $users = User::where(['company_id' => Auth::user()->company_id])->get();
        $projects = Project::where(['company_id' => Auth::user()->company_id])->get();

        return view('tasks.create', compact(['users', 'projects']));
    }

    //Метод подключения страницы задач в админ панели
    public function index()
    {
        $tasks = Task::where(['company_id' => Auth::user()->company_id])->paginate(4);

        return view('tasks.tasks', compact(['tasks']));
    }
}
