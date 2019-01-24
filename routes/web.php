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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resources([
    'activities' => 'ActivityController',
    'daytimes' => 'DaytimeController',
    'eye_conditions' => 'EyeConditionController',
    'glasses' => 'GlassesController',
    'monitors' => 'MonitorController',
    'seats' => 'SeatController',
    'segments' => 'SegmentController',
    'sessions' => 'SessionController',
    'symptoms' => 'SymptomController',
]);

Route::get('/sessions/date/{date}', 'SessionController@showByDate');
