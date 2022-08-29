<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\downloadController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\userController;
use App\Models\Resume;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Home Route
Route::view('/', 'home');



// Login Routes
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

// Register Routes
Route::get('/register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

// Resume Routes
Route::get('/resumes', [ResumeController::class, 'index'])->middleware('auth'); // get all resumes
Route::get('/resume/{resume:slug}/edit', [ResumeController::class, 'edit'])->middleware('auth'); // view edit resume
Route::put('/resume/{resume:slug}', [ResumeController::class, 'update']); // update resume
Route::post('/create/resume', [ResumeController::class, 'store']); // create resume
Route::delete('/resume/{resume:slug}', [ResumeController::class, 'destroy']); // delete resume
Route::delete('/education/{education}/delete', [EducationController::class, 'destroy']); //delete education item
Route::delete('/experience/{experience}/delete', [ExperienceController::class, 'destroy']); //delete experience item
Route::delete('/skill/{skill}/delete', [SkillController::class, 'destroy']); //delete skill item
Route::delete('/photo/{resume:slug}', [ResumeController::class, 'deletePhoto']); //delete photo profile

// Render resume
Route::get('/{resume:slug}/download', [DownloadController::class, 'pdf']); // download resume

// admin dashboard
Route::get('/admin/dashboard', [userController::class, 'isAdmin'])->middleware('auth');