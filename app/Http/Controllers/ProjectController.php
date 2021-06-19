<?php

namespace App\Http\Controllers;

use App\Project;
use App\Http\Requests\ProjectRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    //Метод отключения проекта в админ панели
    public function edit($id)
    {
        $project = Project::find($id);
        if ($project->is_active == 1) {
            $project->is_active = 0;
        } else {
            $project->is_active = 1;
        }
        $project->save();

        return redirect::back();
    }

    //Метод удаления проекта в админ панели
    public function destroy($id)
    {
        $success = 'Проект успешно удален!';
        Project::find($id)->delete();
        return redirect::route('projects.index')->with('message-success', $success);
    }

    //Метод редактирования проектов в админ панели
    public function update(ProjectRequest $request, $id)
    {
        $success = 'Проект успешно отредактирован!';
        Project::find($id)->update([
            'name' => $request->name,
            'budget' => $request->budget,
            'text' => $request->text,
        ]);
        return redirect::route('projects.index')->with('message-success', $success);
    }

    //Метод подключения страницы редактирования проектов в админ панели
    public function show($id)
    {
        $project = Project::find($id);

        return view('projects.update', compact(['project']));
    }

    //Метод создания проектов в админ панели
    public function store(ProjectRequest $request)
    {
        $success = 'Проект успешно добавлен!';
        Project::create([
            'name' => $request->name,
            'budget' => $request->budget,
            'text' => $request->text,
            'code' => Str::random(50),
            'company_id' => Auth::user()->company_id,
        ]);
//        return redirect::route('projects.index')->with('message-success', 'Проект успешно добавлен!');
        return redirect(session()->get('links'))->with('message-success', $success);
    }

    //Метод подключения страницы создания проектов в админ панели
    public function create()
    {
        return view('projects.create');
    }

    //Метод подключения страницы проектов в админ панели
    public function index()
    {
        $projects = Project::where(['company_id' => Auth::user()->company_id])->paginate(4);

        return view('projects.projects', compact(['projects']));
    }
}
