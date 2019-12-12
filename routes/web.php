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

Route::get('/', 'BlogController@index')->name('blog');

Route::get('/blog/{post}', 'BlogController@show')->name('show');

Route::get('/category/{category}', 'BlogController@category')->name('category');
Route::get('/author/{author}', 'BlogController@author')->name('author');

Auth::routes();

Route::get('/home', 'Backend\HomeController@index')->name('home');

Route::put('/backend/blog/restore/{blog}', 'Backend\BlogController@restore')->name('blog.restore');
Route::resource('/backend/blog', 'Backend\BlogController');
