<?php

use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TemplateController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('main.login');
});

Route::get("/login", [LoginController::class, "login"])->name("login");
Route::get("/login", [LoginController::class, "login"])->name("login");
Route::post("/login", [LoginController::class, "authenticate"])->name("authenticate");
Route::post("/logout", [LoginController::class, "logout"])->name("logout");

Route::prefix("/admin")->middleware("auth")->group(function () {
    Route::resource('students', StudentController::class);
    Route::resource('teachers', TeacherController::class);
    Route::resource('projects', ProjectController::class);
    Route::get('projects/kanban/{project}', [ProjectController::class, "kanban"])->name("projects.kanban");
    Route::resource('templates', TemplateController::class);
    Route::resource('consultations', ConsultationController::class);
    Route::resource('tasks', TaskController::class);
    Route::post('tasks/change-stage', [TaskController::class, "changeStage"])->name("tasks.changeStage");
    Route::get("/dashboard", [DashboardController::class,"index"])->name("dashboard.index");
});
