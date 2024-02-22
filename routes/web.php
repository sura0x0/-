<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\SchoolGradesController;
use App\Http\Controllers\StudentsController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// 学生登録画面
Route::get('/student_register', [StudentsController::class, 'create'])->name('register');
Route::post('/student_register', [StudentsController::class, 'store'])->name('student.register');

//学生一覧画面
Route::get('/index', [App\Http\Controllers\StudentsController::class, 'index'])->name('students.index');

//学生一覧検索機能
Route::get('/search', [App\Http\Controllers\StudentsController::class, 'search'])->name('search');

//学生一覧ソート機能
Route::get('/sort', [App\Http\Controllers\StudentsController::class, 'sort'])->name('sort');

//学年更新機能
Route::post('/home/updateAll', [App\Http\Controllers\StudentsController::class, 'updateAllGrades'])->name('student.updateAllGrades');

//学生編集画面
Route::get('/index/{id}/student_edit', [App\Http\Controllers\StudentsController::class, 'edit'])->name('student.edit');
Route::post('/index/{id}/student.update', [App\Http\Controllers\StudentsController::class, 'update'])->name('student.update');

//詳細ページ
Route::get('/index/{id}', [App\Http\Controllers\StudentsController::class, 'show'])->name('show');
//成績検索
Route::get('/index/grade/{id}', [App\Http\Controllers\SchoolGradesController::class, 'search'])->name('grade.search');
//削除機能
Route::post('/index/destroy/{id}', [App\Http\Controllers\StudentsController::class, 'destroy'])->name('student.destroy');

//成績登録
Route::get('/index/{id}/grade', [App\Http\Controllers\SchoolGradesController::class, 'create'])->name('grade.create');
Route::post('/index/{id}/grade', [App\Http\Controllers\SchoolGradesController::class, 'store'])->name('grade.store');

//成績編集 putかpatchか
Route::get('/index/{id}/edit', [App\Http\Controllers\SchoolGradesController::class, 'edit'])->name('grade.edit');
Route::put('/index/{id}/edit', [App\Http\Controllers\SchoolGradesController::class, 'update'])->name('grade.update');