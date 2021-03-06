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
Route::get('/pdf', 'Article\CreateController@upload');
Route::get('/login', 'LoginController@index');
Route::post('/login', 'LoginController@login');
Route::any('/logout', 'LoginController@logout');

Route::group(['middleware' => ['login_check']], function () {
    Route::get('/', function () {
        return view('index');
    });
    Route::get('get_menu','User\MenuController@get_menu');
    include('blog.php');
});