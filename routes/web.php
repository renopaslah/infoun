<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])
->name('home')->middleware('role_for_controller:1,readonly');

Auth::routes();

Route::get('/debug', [App\Http\Controllers\DebugController::class, 'index']);

Route::get('/role-change/{role_id}', [App\Http\Controllers\RoleController::class, 'change']);
Route::get('/year-change/{year_id}', [App\Http\Controllers\YearController::class, 'change_current']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
->name('home')->middleware('role_for_controller:1,readonly');

Route::get('/score', [App\Http\Controllers\ScoreController::class, 'index'])
->name('score')->middleware('role_for_controller:3,readonly');

Route::get('/score/download/template', [App\Http\Controllers\ScoreController::class, 'createFormImport'])
->name('download-template')->middleware('role_for_controller:3,readonly');

Route::get('/score/download/template', [App\Http\Livewire\Score::class, 'downloadTemplate'])
->name('download-template')->middleware('role_for_controller:5,readonly');

Route::get('data/student', [App\Http\Controllers\StudentController::class, 'index'])
->name('student')->middleware('role_for_controller:5,readonly');


Route::get('data/subject', [App\Http\Controllers\SubjectController::class, 'index'])
->name('subject')->middleware('role_for_controller:6,readonly');

Route::get('reference/group', [App\Http\Controllers\GroupController::class, 'index'])
->name('group')->middleware('role_for_controller:7,readonly');

Route::get('reference/year', [App\Http\Controllers\YearController::class, 'index'])
->name('year')->middleware('role_for_controller:9,readonly');

