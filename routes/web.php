<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ChatGPTController;


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
    return view('welcome');
});

Route::get('/test', [Controller::class, 'test'])->name('test');
Route::get('/chat', [App\Http\Controllers\ChatGPTController::class, 'askToChatGpt']);
Route::get('/analyze', [App\Http\Controllers\Controller::class, 'executePythonScript']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/pages/student/home', function () {
    return view('pages.student.home');
})->name('student.home')->middleware('checkUserLevel:student');

/* Route::get('/pages/teacher/home', function () {
    return view('pages.teacher.home');
})->name('teacher.home')->middleware('checkUserLevel:teacher'); */

Route::get('/pages/teacher/home', [Controller::class, 'dashboard_teacher'])->name('teacher.home')->middleware('checkUserLevel:teacher');

/* debug */
Route::get('/pages/teacher/debug/input_question', [Controller::class, 'teacher_input_question'])->name('teacher.debug.input_question')->middleware('checkUserLevel:teacher');
/* add question */
Route::get('/pages/teacher/debug/add_question', [Controller::class, 'teacher_add_question'])->name('teacher.debug.add_question')->middleware('checkUserLevel:teacher');
Route::post('/pages/teacher/debug/add_question', [Controller::class, 'teacher_store_question'])->name('teacher.debug.add_question.store')->middleware('checkUserLevel:teacher');
/* delete question */
Route::delete('/pages/teacher/debug/add_question/{id}', [Controller::class, 'teacher_delete_question'])->name('teacher.debug.add_question.delete')->middleware('checkUserLevel:teacher');
/* answer question */
Route::get('/pages/teacher/debug/answer_question', [Controller::class, 'teacher_answer_question'])->name('teacher.debug.answer_question')->middleware('checkUserLevel:teacher');
Route::get('/pages/teacher/debug/fill_question/{id}', [Controller::class, 'teacher_fill_question'])->name('teacher.debug.fill_question')->middleware('checkUserLevel:teacher');
