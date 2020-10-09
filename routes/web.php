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

/*Route::get('/home', 'ProfilesController@index')->name('home');*/

Route::post('/follow/{user}', 'FollowsController@store');
Route::post('/like/{post}', 'LikesController@store');


Route::get('/p/create', 'PostsController@create')->name('post.create');
Route::post('/p', 'PostsController@store');
Route::get('/p/{post}', 'PostsController@show');
Route::delete('/p/{post}', 'PostsController@destroy')->name('post.destroy');
Route::get('/', 'PostsController@index');

Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.index');
Route::get('/profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit');
Route::get('/profile/{user}/followings', 'ProfilesController@followings')->name('profile.followings');
Route::get('/profile/{user}/followers', 'ProfilesController@followers')->name('profile.followers');
Route::patch('/profile/{user}', 'ProfilesController@update')->name('profile.update');


