<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::resource('projects','ProjectController');
Route::get('/projects/{project}/sprints','SprintController@index');
Route::get('/sprints/{sprint}','SprintController@show');
Route::put('/sprints/{sprint}','SprintController@update');
Route::delete('/sprints/{sprint}','SprintController@destroy');
Route::post('/projects/{project}/sprints','SprintController@store');
Route::get('/sprints/{sprint}/tasks','TaskController@index');
Route::get('/tasks/{task}','TaskController@show');
Route::put('/tasks/{task}','TaskController@update');
Route::delete('/tasks/{task}','TaskController@destroy');
Route::post('/sprints/{sprint}/tasks','TaskController@store');
