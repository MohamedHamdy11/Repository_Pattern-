<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace' => 'API'], function () {

    Route::group(['namespace' => 'Auth'], function () {
        // users auth routes
        Route::post('login', 'UserLoginController@login');
        Route::post('register', 'UserRegisterController@register');
    });

    // posts routes
    Route::get('posts', 'PostController@index');
    Route::post('post/store', 'PostController@store'); 
    Route::get('post/{postId}', 'PostController@show');
    Route::patch('post/{postId}', 'PostController@update');
    Route::delete('post/{postId}', 'PostController@destroy');


    // Comments routes
    Route::post('comment/store', 'CommentController@storeComment'); 
    Route::get('comments_Post/{post}', 'CommentController@commmentsPost'); 

}); 
