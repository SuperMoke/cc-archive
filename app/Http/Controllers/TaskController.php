<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Stage;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {


        $project = Project::find($_GET["project_id"]);
        $students = $project->projectMembers;


        return view("main.task.create", compact("students" , "project"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // check percentage
        $project = Project::find($request->project_id);
        $percentage = $request->percentage;

        if ($project->task_total_percentage + $percentage > 100) {
            return redirect()->back()->withErrors(["error" => "The total percentage of the tasks in this project exceeds 100%"]);
        }
        $data = $request->all();

        if($request->user_id)
            $data["user_name"] = User::find($request->user_id)->fullname;

        $data["stage_id"] = 1;

        $task = $project->tasks()->create($data);

        return redirect()->route("projects.kanban", $request->project_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $project = Project::find($task->project_id);
        $students = $project->projectMembers;

        return view("main.task.show", compact("task" , "students"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $project = Project::find($task->project_id);
        $students = $project->projectMembers;
        return view("main.task.edit", compact("task" , "students" , "project"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $project = Project::find($request->project_id);
        $percentage = $request->percentage;

        if (($project->task_total_percentage - $task->percentage) + $percentage > 100) {
            return redirect()->back()->withErrors(["error" => "The total percentage of the tasks in this project exceeds 100%"]);
        }

        $data = $request->all();
        if($request->user_id)
            $data["user_name"] = User::find($request->user_id)->fullname;
        $task->update($data);
        return redirect()->route("projects.kanban", $task->project_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route("projects.kanban", $task->project_id);
    }

    public function changeStage(Request $request)
    {
        $task = Task::find($request->task_id);
        $stage = Stage::where("j_kanban_id" , $request->stage_id)->first();
        $task->update(["stage_id" => $stage->id]);
        return json_encode(["success" => true]);
    }
}
