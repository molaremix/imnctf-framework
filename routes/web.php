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

Route::prefix('admin')->group(function () {
    Route::get('/', function (){
        return redirect()->route('admin.challenge.index');
    });
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.check');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
});

Route::middleware('auth:admin')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::name('admin.')->group(function () {
            Route::resource('about', 'Admin\AboutController');
            Route::resource('participant', 'Admin\TeamController');
            Route::resource('challenge', 'Admin\ChallengeController');
            Route::resource('submission', 'Admin\SubmissionController');
            Route::resource('team', 'Admin\TeamController');
            Route::resource('news', 'Admin\NewsController');
        });
    });
});

Route::middleware('auth:team')->group(function () {
    Route::resource('challenge', 'ChallengeController')->only(['index']);
    Route::resource('profile', 'ProfileController')->only(['index', 'update']);
});

Route::get('/login', 'Auth\TeamLoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\TeamLoginController@login')->name('login.check');
Route::get('/logout', 'Auth\TeamLoginController@logout')->name('logout');
Route::resource('/', 'AboutController')->only(['index']);
Route::resource('news', 'NewsController')->only(['index']);
Route::resource('scoreboard', 'SubmissionController')->only(['index']);