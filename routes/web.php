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
Route::post('/pages/teacher/debug/add_answer', [Controller::class, 'teacher_store_answer'])->name('teacher.debug.add_answer.store')->middleware('checkUserLevel:teacher');
/* evaluation page */
Route::get('/pages/teacher/debug/evaluations', [Controller::class, 'teacher_evaluation'])->name('teacher.debug.evaluation')->middleware('checkUserLevel:teacher');
Route::post('/pages/teacher/debug/answer_question', [Controller::class, 'teacher_store_evaluation'])->name('teacher.debug.evaluation.store')->middleware('checkUserLevel:teacher');
/* evaluation detail */
Route::get('/pages/teacher/debug/evaluations/{id}', [Controller::class, 'teacher_evaluation_detail'])->name('teacher.debug.evaluation.detail')->middleware('checkUserLevel:teacher');

/* teacher */
/* classroom page */
Route::get('/pages/teacher/classroom', [Controller::class, 'teacher_classroom'])->name('teacher.classroom')->middleware('checkUserLevel:teacher');
/* delete classroom */
Route::delete('/pages/teacher/classroom/{id}', [Controller::class, 'teacher_classroom_delete'])->name('teacher.classroom.delete')->middleware('checkUserLevel:teacher');
/* clasroom add page */
Route::get('/pages/teacher/classroom/add', [Controller::class, 'teacher_classroom_add'])->name('teacher.classroom.add')->middleware('checkUserLevel:teacher');
/* classroom store */
Route::post('/pages/teacher/classroom/add', [Controller::class, 'teacher_classroom_store'])->name('teacher.classroom.store')->middleware('checkUserLevel:teacher');
/* classroom edit */
Route::get('/pages/teacher/classroom/edit/{id}', [Controller::class, 'teacher_classroom_edit'])->name('teacher.classroom.edit')->middleware('checkUserLevel:teacher');
/* classroom update */
Route::put('/pages/teacher/classroom/edit/{id}', [Controller::class, 'teacher_classroom_update'])->name('teacher.classroom.update')->middleware('checkUserLevel:teacher');
/* classroom add student page */
Route::get('/pages/teacher/classroom/add_student/{id}', [Controller::class, 'teacher_classroom_add_student'])->name('teacher.classroom.add_student')->middleware('checkUserLevel:teacher');
/* classroom update student */
Route::put('/pages/teacher/classroom/add_student/{id}', [Controller::class, 'teacher_classroom_update_student'])->name('teacher.classroom.update_student')->middleware('checkUserLevel:teacher');
/* classrom delete student */
Route::delete('/pages/teacher/classroom/add_student/{id}', [Controller::class, 'teacher_classroom_delete_student'])->name('teacher.classroom.delete_student')->middleware('checkUserLevel:teacher');
/* student list page */
Route::get('/pages/teacher/students', [Controller::class, 'teacher_students'])->name('teacher.students')->middleware('checkUserLevel:teacher');
/* test list page*/
Route::get('/pages/teacher/tests', [Controller::class, 'teacher_tests'])->name('teacher.tests')->middleware('checkUserLevel:teacher');
/* add test */
Route::get('/pages/teacher/tests/add', [Controller::class, 'teacher_tests_add'])->name('teacher.tests.add')->middleware('checkUserLevel:teacher');
/* test store */
Route::post('/pages/teacher/tests/add', [Controller::class, 'teacher_tests_store'])->name('teacher.tests.store')->middleware('checkUserLevel:teacher');
/* test delete */
Route::delete('/pages/teacher/tests/{id}', [Controller::class, 'teacher_tests_delete'])->name('teacher.tests.delete')->middleware('checkUserLevel:teacher');
/* test edit */
Route::get('/pages/teacher/tests/edit/{id}', [Controller::class, 'teacher_tests_edit'])->name('teacher.tests.edit')->middleware('checkUserLevel:teacher');
/* test update */
Route::put('/pages/teacher/tests/edit/{id}', [Controller::class, 'teacher_tests_update'])->name('teacher.tests.update')->middleware('checkUserLevel:teacher');
/* test question delete */
Route::delete('/pages/teacher/tests/edit/{id}', [Controller::class, 'teacher_test_delete_question'])->name('teacher.question.delete')->middleware('checkUserLevel:teacher');
/* test question add */
Route::get('/pages/teacher/tests/add_question/{id}', [Controller::class, 'teacher_tests_add_question'])->name('teacher.tests.add_question')->middleware('checkUserLevel:teacher');
/* test question store */
Route::post('/pages/teacher/tests/add_question', [Controller::class, 'teacher_tests_store_question'])->name('teacher.tests.store_question')->middleware('checkUserLevel:teacher');
/* test evaluation page */
Route::get('/pages/teacher/tests/evaluations/{id}', [Controller::class, 'teacher_tests_evaluation'])->name('teacher.tests.evaluation')->middleware('checkUserLevel:teacher');
