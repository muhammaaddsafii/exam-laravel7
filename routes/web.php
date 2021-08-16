<?php

use Illuminate\Support\Facades\Route;

//route untuk home
Route::get('/', 'HomeController@index');

//route untuk about
Route::get('/about', 'AboutController@index');

//route untuk post
Route::get('/post', 'PostController@index');
Route::get('/post/create', 'PostController@create');
Route::post('/post/create', 'PostController@store');

//route untuk contact
Route::get('/contact', 'ContactController@index');

//route untuk login
Route::get('/login', 'LoginController@index');
