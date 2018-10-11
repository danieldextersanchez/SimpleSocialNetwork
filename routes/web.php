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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',function(){
    return view('welcome');
});

Auth::routes();

Route::put('/posts','Posts@store');

Route::get('/home', 'ViewsController@index')->name('home');

Auth::routes();

Route::get('/views/spinkit', 'ViewsController@spinkit');

Route::get('/home', 'ViewsController@index')->name('home');
