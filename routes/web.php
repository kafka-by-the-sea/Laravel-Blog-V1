<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('blog/{slug}', 'BlogController@getSingle')->name('blog.single')->where('slug', '[\w\d\-\_]+');
Route::get('blog', 'BlogController@getIndex')->name('blog.index');
Route::get('contact', 'PagesController@getContact');
Route::post('contact', 'PagesController@postContact');
Route::get('about', 'PagesController@getAbout');
Route::get('/', 'PagesController@getIndex');
Route::post('comments/{post_id}', 'CommentsController@store')->name('comments.store');
Route::get('comments/{id}/edit', 'CommentsController@edit')->name('comments.edit');
Route::put('comments/{id}', 'CommentsController@update')->name('comments.update');
Route::delete('comments/{id}', 'CommentsController@destroy')->name('comments.destroy');
Route::get('comments/{id}/delete', 'CommentsController@delete')->name('comments.delete');

Route::get('logout', 'Auth\LoginController@logout');
Route::group(['middleware' => 'auth'], function() {
    Route::resource('posts', 'PostController');
    Route::resource('categories', 'CategoryController', ['except' => ['create']]);
    Route::resource('tags', 'TagController', ['except' => ['create']]);
});

Auth::routes();
