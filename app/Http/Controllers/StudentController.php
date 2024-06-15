<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = User::where("is_student", true)->get();
        return view("main.student.index", compact("students"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("main.student.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $vaLidated = $request->validate([
            "fullname" => ["required", "string", "max:255"],
            "email" => ["required", "string", "email", "max:255", "unique:users"],
            "password" => ["required", "string", "min:8", "confirmed"],
        ]);


        $validated["is_student"] = true;
        $data = $request->all();
        $data["password"] = bcrypt($data["password"]);
        $user = User::create($data);

        return redirect()->route("students.index")->with("success","User created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = User::find($id);
        return view("main.student.show", compact("student"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student = User::find($id);
        return view("main.student.edit", compact("student"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $vaLidated = $request->validate([
            "email" => ["required", "string", "email", "max:255", "unique:users,email," . $user->id],
            "fullname" => ["required", "string", "max:255"]]);

        $user->update($vaLidated);

        return redirect()->route("students.index")->with("success","User updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route("students.index")->with("success","User deleted successfully");
    }
}
