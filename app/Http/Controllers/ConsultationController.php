<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Project;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $consultations = Consultation::all();

        if(auth()->user()->is_student) {
            $newConsultations = [];
            $userId = auth()->user()->id;
            foreach($consultations as $consultation) {
                foreach($consultation->project->projectMembers as $member) {
                    if ($member->id == $userId) {
                        $newConsultations[] = $consultation;
                    }
                }
            }
            $consultations = $newConsultations;
        }

        if(auth()->user()->is_teacher) {
            $newConsultations = [];
            $userId = auth()->user()->id;
            foreach($consultations as $consultation) {
                if ($consultation->project->adviser_id == $userId) {
                    $newConsultations[] = $consultation;
                }
            }
            $consultations = $newConsultations;
        }

        return view("main.consultation.index", compact("consultations"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects = Project::all();
        return view("main.consultation.create", compact("projects"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data["user_id"] = auth()->user()->id;
        Consultation::create($data);
        return redirect()->route("consultations.index")->with("success","Consultation Created Successfuly");
    }

    /**
     * Display the specified resource.
     */
    public function show(Consultation $consultation)
    {
        $projects = Project::all();
        return view("main.consultation.show", compact("consultation" , "projects"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Consultation $consultation)
    {
        $projects = Project::all();
        return view("main.consultation.edit", compact("consultation" , "projects"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Consultation $consultation)
    {
        $data = $request->all();
        $consultation->update($data);
        return redirect()->route("consultations.index")->with("success","Consultation Updated Successfuly");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Consultation $consultation)
    {
        $consultation->delete();
        return redirect()->route("consultations.index")->with("success","Consultation Deleted Successfuly");
    }
}
