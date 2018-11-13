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
    Route::get('/', function () {
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
            Route::resource('team', 'Admin\TeamController');
            Route::resource('challenge', 'Admin\ChallengeController');
            Route::post('challenge/{challenge}/hide', 'Admin\ChallengeController@hide')->name('challenge.hide');
            Route::resource('submission', 'Admin\SubmissionController');
            Route::resource('team', 'Admin\TeamController');
            Route::post('team/{team}/hide', 'Admin\TeamController@hide')->name('team.hide');
            Route::post('team/{team}/verify', 'Admin\TeamController@verify')->name('team.verify');
            Route::resource('news', 'Admin\NewsController');
            Route::resource('category', 'Admin\CategoryController')->except(['show', 'create']);
            Route::resource('hint', 'Admin\HintController');
            Route::resource('attachment', 'Admin\AttachmentController')->only(['destroy']);
            Route::resource('scoreboard', 'Admin\ScoreboardController')->only(['index']);
            Route::get('scoreboard/standing', 'Admin\ScoreboardController@standing')->name('standing');
        });
    });
});

Route::middleware('auth:team')->group(function () {
    Route::resource('challenge', 'ChallengeController')->only(['index', 'show']);
    Route::resource('submission', 'SubmissionController')->only(['store']);
    Route::get('challenges', 'Admin\ChallengeController@list')->name('challenges');
    Route::resource('profile', 'ProfileController')->only(['index', 'update']);
});

Route::get('/login', 'Auth\TeamLoginController@showLoginForm')->name('login');
Route::get('/register', 'Auth\TeamLoginController@showRegisterForm')->name('register');

Route::post('/login', 'Auth\TeamLoginController@login')->name('login.check');
Route::post('/register', 'Auth\TeamLoginController@registerTeam')->name('team.register');
Route::get('/logout', 'Auth\TeamLoginController@logout')->name('logout');
Route::get('/download/{files}', function (\App\Models\Attachment $files) {
    try {
        return \Illuminate\Support\Facades\Storage::disk('local')->download('/attachment/' . $files['name']);
    } catch (\League\Flysystem\FileNotFoundException $e) {

    }
})->name('download');
Route::resource('/', 'AboutController')->only(['index']);
Route::resource('news', 'NewsController')->only(['index']);
Route::resource('scoreboard', 'ScoreboardController')->only(['index']);
Route::get('scoreboard/standing', 'ScoreboardController@standing')->name('standing');