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

Route::get('/', function () {
//    return view('welcome');
    return view('index');
});
Route::get('get_menu','User\MenuController@get_menu');
//Route::get('/get_role_menu','User\MenuController@/get_role_menu');

include('blog.php');