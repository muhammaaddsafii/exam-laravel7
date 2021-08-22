<?php

use Illuminate\Support\Facades\Route;

//route untuk home
Route::get('/', 'HomeController@index');

//route untuk about
Route::get('/about', 'AboutController@index');

//route untuk post
Route::get('/post', 'PostController@index');

Route::get('/post/create', 'PostController@create');
Route::post('/post/store', 'PostController@store');
Route::get('/post/{post:slug}', 'PostController@show');

Route::get('/post/{post:slug}/edit', 'PostController@edit');
Route::patch('/post/{post:slug}/edit', 'PostController@update');
Route::delete('/post/{post:slug}/delete', 'PostController@destroy');

Route::get('/post/categories/{category:slug}', 'CategoryController@show');

Route::get('/post/tags/{tag:slug}', 'TagController@show');

//route untuk contact
Route::get('/contact', 'ContactController@index');

//route untuk login
Route::get('/login', 'LoginController@index');
