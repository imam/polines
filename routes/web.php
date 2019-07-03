<?php

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

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::resource('/students', 'StudentController');
    Route::resource('/lecturers', 'LecturerController');
    Route::resource('/lectures', 'LectureController');
    Route::resource('/classrooms', 'ClassroomController');
    Route::resource('/schedules', 'ScheduleController');
    Route::resource('/presences', 'PresenceController');
});

Auth::routes(['register' => false, 'request' => false]);

Route::get('/home', 'HomeController@index')->name('home');
