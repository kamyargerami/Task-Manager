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


Route::get('/', 'TaskController@index')->name('index');
Route::post('/', 'TaskController@store')->name('task.store');
Route::put('/', 'TaskController@update')->name('task.update');

Route::post('sort', 'TaskController@sort')->name('task.sort');
Route::get('delete/{task}', 'TaskController@delete')->name('task.delete');
