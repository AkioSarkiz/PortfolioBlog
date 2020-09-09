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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/post/{context}', 'PostController@index')->name('post');
Route::get('/profile/{context?}', 'ProfileController@index')->name('profile');

Route::get('/post-create', 'PostCreateController@index')->name('new_blog');
Route::post('/post-create', 'PostCreateController@handleCreate');
Route::post('/update-avatar', 'UpdateUserSettings@handleAvatar')->name('update_avatar');
