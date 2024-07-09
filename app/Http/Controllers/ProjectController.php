<?php

namespace App\Http\Controllers;

use App\Enums\ProjectUserRole;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    protected $project;

    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    public function addProject(Request $request)
    {
        $name = $request->input('name');
        $id = $this->project->add($name);
        return redirect()->route('showProyect', ['id'  => $id])->with('ok', 'Proyecto nuevo creado');
    }

    public function showProyect($id)
    {
        return view('projects.project-info', ['project' => $this->project->getProjectById($id)]);
    }

    public function deleteProject($id)
    {
        Project::find($id)->delete();
        return redirect()->route('/')->with('ok', 'Proyecto borrado correctamente');
    }
}
