<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubjectController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'],function(){
    Route::get('/home', [SubjectController::class, 'index'])->name('home');
    Route::post('/subjects/add', [SubjectController::class, 'store'])->name('subject.add');
    Route::post('/subjects/list', [SubjectController::class, 'getSubjectList'])->name('subject.list');
    Route::delete('/subjects/delete/{id}', [SubjectController::class, 'destroy'])->name('subject.delete');
});
