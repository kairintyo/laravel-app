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

// github login/logout
Route::get('login/github', 'Auth\LoginController@redirectToProvider');
Route::get('login/github/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('/logout', 'Auth\LoginController@logout');

// main
Route::get('/', 'Main\TopController@index');
Route::get('/user', 'Main\UserController@index');
Route::post('/post/upload', 'Main\PostController@upload');
Route::get('/post', 'Main\PostController@index');
Route::get('/home', 'Main\HomeController@index');
Route::post('/like', 'Main\LikeController@like');
Route::get('/favo', 'Main\FavoController@index');
Route::get('/like/list', 'Main\LikeController@index');
Route::get('/search', 'Main\SearchController@search');
Route::post('/post/delete', 'Main\PostController@delete');
Route::get('post/{id}', 'Main\PostController@show');
Route::post('comment/create', 'Main\CommentController@create');
