<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $templates = Template::all();

        if(auth()->user()->is_student) {
            $newTemplates = [];
            $userId = auth()->user()->id;
            foreach($templates as $template) {
                foreach($template->project->projectMembers as $member) {
                    if ($member->id == $userId) {
                        $newTemplates[] = $template;
                    }
                }
            }
            $templates = $newTemplates;
        }

        if(auth()->user()->is_teacher) {
            $newTemplates = [];
            $userId = auth()->user()->id;
            foreach($templates as $template) {
                if ($template->project->adviser_id == $userId) {
                    $newTemplates[] = $template;
                }
            }
            $templates = $newTemplates;
        }

        return view("main.template.index", compact("templates"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects = Project::all();
        return view("main.template.create", compact("projects"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $path = Storage::putFile("public/contact_images", $request->file("src"));
        $path = Storage::url($path);
        $data["src"] = $path;
        Template::create($data);
        return redirect()->route("templates.index")->with("success","Template Created Successfuly");
    }

    /**
     * Display the specified resource.
     */
    public function show(Template $template)
    {
        $projects = Project::all();
        return view("main.template.show", compact("template" , "projects"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Template $template)
    {
        $projects = Project::all();
        return view("main.template.edit", compact("template" , "projects"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Template $template)
    {
        $data = $request->all();
        if($request->hasFile("src")) {
            Storage::delete($template->src);
            $path = Storage::putFile("public/contact_images", $request->file("src"));
            $path = Storage::url($path);
            $data["src"] = $path;
        }
        $template->update($data);
        return redirect()->route("templates.index")->with("success","Template Updated Successfuly");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Template $template)
    {
        $template->delete();
        return redirect()->route("templates.index")->with("success","Template Deleted Successfuly");
    }
}
