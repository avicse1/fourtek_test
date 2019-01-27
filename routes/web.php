<?php


Route::get('/', 'AuthController@login')->name('login');
Route::post('/do-login', 'AuthController@do_login')->name('do_login');
Route::get('/logout', 'AuthController@logout')->name('logout');
Route::get('/register', 'AuthController@register')->name('register');
Route::post('/register', 'AuthController@do_register')->name('do_register');
Route::get('/email-verified', 'AuthController@verify_email')->name('email_verify');
Route::get('/verify-email', 'AuthController@do_verify')->name('do_verify');

Route::group(['middleware' => ['web', 'login.check']], function(){
    Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');
    Route::post('/mark-attendance', 'DashboardController@markAttendance')->name('mark_attendance');
});

Route::group(['prefix' => 'admin'], function(){
    Route::get('/', 'AdminAuthController@login')->name('admin_login');
    Route::post('/do-login', 'AdminAuthController@do_login')->name('do_admin_login');
});
Route::group(['prefix' => 'admin', 'middleware' => ['web', 'login.check']], function(){
    Route::get('/dashboard', 'AdminDashboardController@dashboard')->name('admin_dashboard');
});
