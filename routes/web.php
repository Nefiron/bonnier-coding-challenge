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

Auth::routes(['register' => false]);

Route::get('/', function () {
    return redirect(route('login'));
});

Route::middleware(['auth'])->group(function () {
    Route::get('/projects', 'ProjectController@index');
    Route::post('/projects', 'ProjectController@store');
    Route::get('/projects/{project}', 'ProjectController@show');
    Route::put('/projects/{project}', 'ProjectController@update');
    Route::delete('/projects/{project}', 'ProjectController@destroy');
    Route::put('/projects/{project}/entries/{entry}', 'ProjectEntryController@update');
    Route::delete('/projects/{project}/entries/{entry}', 'ProjectEntryController@destroy');
    Route::post('/projects/{project}/entries/start', 'StartEntryController');
    Route::put('/projects/{project}/entries/{entry}/stop', 'StopEntryController');
});

Route::fallback(function(){
    return redirect('login');
});
