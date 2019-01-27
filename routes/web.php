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


Route::get('/', 'AuthController@login')->name('login');
Route::post('/do-login', 'AuthController@do_login')->name('do_login');
Route::get('/logout', 'AuthController@logout')->name('logout');
Route::get('/register', 'AuthController@register')->name('register');
Route::post('/register', 'AuthController@do_register')->name('do_register');
Route::get('/email-verified', 'AuthController@verify_email')->name('email_verify');
Route::get('/verify-email', 'AuthController@do_verify')->name('do_verify');

Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');