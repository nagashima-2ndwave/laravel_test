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

Route::group(['middleware' => 'auth'], function() {
    Route::resource('posts','PostsController', ['only' => ['create','store','edit','update','destroy']]);
});
Route::resource('posts','PostsController',['only' => ['index','show']]);
Route::resource('comments', 'CommentsController', ['only' => ['store']]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
