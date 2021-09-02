<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/posts/search', 'SearchController@post');
Route::get('/all-post', 'PostController@index')->name('post');

Route::middleware('auth')->group(function () {
    //route untuk post
    Route::get('/post/create', 'PostController@create');
    Route::post('/post/store', 'PostController@store');

    Route::get('/post/{post:slug}/edit', 'PostController@edit');
    Route::patch('/post/{post:slug}/edit', 'PostController@update');
    Route::delete('/post/{post:slug}/delete', 'PostController@destroy');
});

Route::get('/post/{post:slug}', 'PostController@show');
Route::get('/post/categories/{category:slug}', 'CategoryController@show');
Route::get('/post/tags/{tag:slug}', 'TagController@show');

//route untuk about
Route::get('/about', 'AboutController@index')->name('about');

//route untuk contact
Route::get('/contact', 'ContactController@index')->name('contact');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
