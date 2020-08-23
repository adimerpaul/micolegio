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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/planificacion', function () {
    return view('planificacion');
})->name('planificacion')->middleware('auth');
Route::get('/teacher', function () {
    return view('teacher');
})->name('teacher')->middleware('auth');
Route::get('/vermateria', function () {
    return view('materia');
})->name('vermateria')->middleware('auth');

Route::get('/vercurso', function () {
    return view('curso');
})->name('vercurso')->middleware('auth');

Route::get('/veralumno', function () {
    return view('alumno');
})->name('veralumno')->middleware('auth');

Route::get('/comunicacion', function () {
    return view('comunicacion');
})->name('comunicacion')->middleware('auth');

Route::get('/planificaciondocente', function () {
    return view('planificaciondocente');
})->name('planificaciondocente')->middleware('auth');


Route::post('import', 'HomeController@import')->name('import');
Route::post('importmateria', 'HomeController@importmateria')->name('importmateria');
Route::post('importcurso', 'HomeController@importcurso')->name('importcurso');
Route::post('importalumno', 'HomeController@importalumno')->name('importalumno');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user', 'HomeController@users')->middleware('auth');
Route::get('/usuario', 'HomeController@usuario')->middleware('auth');
Route::delete('/user/{id}', 'HomeController@deleteuser')->middleware('auth');


Route::apiResource('/materia','MateriaController')->middleware('auth');
Route::apiResource('/curso','CursoController')->middleware('auth');
Route::apiResource('/assign','AssignController')->middleware('auth');
Route::apiResource('/plan','PlanController')->middleware('auth');
Route::apiResource('/tarea','TareaController')->middleware('auth');
Route::get('/materiasdocente','AssignController@materiasdocente')->middleware('auth');
