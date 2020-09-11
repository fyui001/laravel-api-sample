<?php

use Illuminate\Http\Request;

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

/* Users */
Route::prefix('users')->middleware('auth:api')->group(function() {
    Route::get('/logout', 'UsersController@logout')->name('users.logout');
});
Route::prefix('users')->group(function() {
    Route::post('/login', 'UsersController@login')->name('users.login');
    Route::get('/', 'UsersController@show')->name('users.show');
});

/* Photos */
Route::prefix('photos')->middleware('auth:api')->group(function() {
    Route::post('/create', 'PhotosController@create')->name('photo.create');
});
Route::prefix('photos')->group(function() {
    Route::get('/', 'PhotosController@index')->name('photos.index');
    Route::get('/{photo}', 'PhotosController@show')->name('photos.show');
});
