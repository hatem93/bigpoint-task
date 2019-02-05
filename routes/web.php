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
    return view('welcome');
});

Route::post('login','Accounts\UserController@login');
Route::post('user/add','Accounts\UserController@addItem');
Route::get('user/items','Accounts\UserController@getUserItems');
Route::get('user/notaddeditems','Accounts\UserController@getNonUserItems');
