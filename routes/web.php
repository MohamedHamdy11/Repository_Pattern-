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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function(){
    // posts routes
    Route::get('posts', 'PostController@index');
    Route::post('post/store', 'PostController@store');
    Route::get('post/{postId}', 'PostController@show');
    Route::get('post/{postId}/edit', 'PostController@show');
    Route::patch('post/{postId}/edit', 'PostController@update');
    Route::delete('post/{postId}', 'PostController@destroy');

    // Comments routes
    Route::post('comment/store', 'CommentController@storeComment');
});
