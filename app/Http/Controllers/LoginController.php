<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view("main.login");
    }

    public function authenticate(Request $request)
    {
        $loginField = $request->input("email");
        $password = $request->input("password");

        $credentials = ["email" => $loginField, "password" => $password];
        $user = User::where("email", $loginField)->first();

        if ($user) {
            if($request->input("teacher")) {
                if(!$user->is_teacher) {
                    return redirect()->back()->withInput()->withErrors(["loginError" => "Invalid credentials."]);
                }
            }

            if($request->input("student")) {
                if(!$user->is_student) {
                    return redirect()->back()->withInput()->withErrors(["loginError" => "Invalid credentials."]);
                }
            }

            if($request->input("admin")) {
                if(!$user->is_admin) {
                    return redirect()->back()->withInput()->withErrors(["loginError" => "Invalid credentials."]);
                }
            }
        }


        if (Auth::attempt($credentials)) {
            return redirect()->intended("/admin/dashboard");
        }

        return redirect()->back()->withInput()->withErrors(["loginError" => "Invalid credentials."]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route("login");
    }
}
