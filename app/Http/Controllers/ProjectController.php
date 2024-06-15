<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Stage;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();

        if(auth()->user()->is_student) {
            $newProjects = [];
            $userId = auth()->user()->id;
            foreach($projects as $project) {
                foreach($project->projectMembers as $member) {
                    if ($member->id == $userId) {
                        $newProjects[] = $project;
                    }
                }
            }
            $projects = $newProjects;
        }

        if(auth()->user()->is_teacher) {
            $newProjects = [];
            $userId = auth()->user()->id;
            foreach($projects as $project) {
                if ($project->adviser_id == $userId) {
                    $newProjects[] = $project;
                }
            }
            $projects = $newProjects;
        }

        return view("main.research-project.index", compact("projects"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = User::where("is_student", true)->get();
        $teachers = User::where("is_teacher", true)->get();

        return view("main.research-project.create", compact("students" , "teachers"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data["adviser_id"] = auth()->user()->id;
        $project = Project::create($data);
        $project->projectMembers()->attach($request->project_members);
        return redirect()->route("projects.index")->with("success","Project Created Successfuly");
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $students = User::where("is_student", true)->get();
        $teachers = User::where("is_teacher", true)->get();
        return view("main.research-project.show", compact("project" , "students" , "teachers"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $students = User::where("is_student", true)->get();
        $teachers = User::where("is_teacher", true)->get();

        return view("main.research-project.edit", compact("students", "project", "teachers"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $project->update($request->all());
        $project->projectMembers()->sync($request->project_members);
        return redirect()->route("projects.index")->with("success","Project updated Successfuly");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route("projects.index")->with("success","Project deleted Successfuly");
    }

    public function kanban(Project $project)
    {
        $stages = Stage::all();
        return view("main.research-project.kanban", compact("project" , "stages"));
    }

}
