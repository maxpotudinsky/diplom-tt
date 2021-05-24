<?php

namespace App\Http\Controllers;

use App\Filters\ProjectFilter;
use App\Project;
use App\Http\Requests\ProjectRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
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

    public function destroy($id)
    {
//        dd(Project::find($id)->id);
        Project::find($id)->delete();
        return redirect::route('projects.index')->with('message-success', 'Проект успешно удален!');
    }

    public function update(ProjectRequest $request, $id)
    {
        Project::find($id)->update([
            'name' => $request->name,
            'budget' => $request->budget,
            'text' => $request->text,
        ]);
        return redirect::route('projects.index')->with('message-success', 'Проект успешно отредактирован!');
    }

    public function show($id)
    {
        $project = Project::find($id);

        return view('projects.update', compact(['project']));
    }

    public function store(ProjectRequest $request)
    {
        Project::create([
            'name' => $request->name,
            'budget' => $request->budget,
            'text' => $request->text,
            'code' => Str::random(50),
            'company_id' => Auth::user()->company_id,
        ]);
        return redirect::route('projects.index')->with('message-success', 'Проект успешно добавлен!');
    }

    public function create()
    {
        return view('projects.create');
    }

    public function index()
    {
        $projects = Project::where(['company_id' => Auth::user()->company_id])->paginate(4);

        return view('projects.projects', compact(['projects']));
    }
}
