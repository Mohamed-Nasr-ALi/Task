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
Route::get('/all', function () {
  return  \App\Models\Project::all();
});
Route::get('/admin', function (){
   return view('home');
})->name('home');
Route::get('/', function (){
   return view('welcome');
})->name('welcome');
Route::group(['prefix'=>'admin','middleware' => 'auth'], function()
{
    Route::resources([
        'projects' => 'ProjectController',
        'tasks' => 'TaskController',
    ]);

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
