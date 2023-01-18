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
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

// WIP
Route::middleware(['auth'])->group(function () {
    //
});

Route::post('/projects', 'ProjectController@store');
Route::get('/projects/{project}', 'ProjectController@show');
Route::post('/projects/{project}/entries', 'EntryController@start');
Route::put('/projects/{project}/entries/{entry}', 'EntryController@stop');

// WIP Routes
// Route::get('/projects/{project}/entries', 'ProjectEntryController@index');
// Route::get('/projects/{project}/entries/{entry}', 'ProjectEntryController@show');
// Route::put('/projects/{project}/entries/{entry}', 'ProjectEntryController@update');
// Route::post('/projects/{project}/entries/start', 'StartEntryController');
// Route::put('/projects/{project}/entries/{entry}/stop', 'StopEntryController');

Route::fallback(function(){
    return redirect('login');
});
