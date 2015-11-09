<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');
Route::get('home', 'HomeController@index');

Route::get('entries',[
    'middleware' => 'auth',
    'uses' => 'AttendanceController@currentMonth'
]);
    
Route::post('/arrived',[
    'middleware' => 'auth',
    'uses' => 'AttendanceController@userArrived'
]);

Route::post('/departed',[
    'middleware' => 'auth',
    'uses' => 'AttendanceController@userDeparted'
]);


Route::get('show_departed/{id}', 'AttendanceController@showDeparted');
Route::get('show_arrived/{id}',  'AttendanceController@showArrived');
Route::get('show_workhours/{id}', 'AttendanceController@showWorkhours');
Route::get('show_brhours/{id}',  'AttendanceController@showBrhours');
Route::get('show_othours/{id}', 'AttendanceController@showOthours');
Route::get('show_date/{id}',  'AttendanceController@showDate');
Route::get('show_notes/{id}',  'AttendanceController@showNotes');



Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


Route::patch('/update_departed/{id}','AttendanceController@updateDeparted');
Route::patch('/update_date/{id}','AttendanceController@updateDate');
Route::patch('/update_notes/{id}','AttendanceController@updateNotes');
Route::patch('/update_arrived/{id}','AttendanceController@updateArrived');
Route::patch('/update_work_hours/{id}','AttendanceController@updateWorkhours');
Route::patch('/update_br_hours/{id}','AttendanceController@updateBrhours');
Route::patch('/update_ot_hours/{id}','AttendanceController@updateOthours');
