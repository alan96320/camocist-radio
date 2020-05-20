<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\User\AccountController;
use App\Http\Controllers\Frontend\User\ProfileController;
use App\Http\Controllers\Frontend\User\DashboardController;
use App\Http\Controllers\Frontend\ApiController;
/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
Route::get('/post/{title}', "HomeController@showPost")->name('single-post');
Route::post('/get-filtred-posts', "HomeController@getFiltredPosts")->name('getFilter');
Route::get('contact', [ContactController::class, 'index'])->name('contact');
Route::post('contact/send', [ContactController::class, 'send'])->name('contact.send');

Route::get('/883jia', [HomeController::class, 'info_883jia'])->name('info_883jia');

Route::get('/power98', [HomeController::class, 'info_power98'])->name('info_power98');

Route::get('/music_drama', [HomeController::class, 'music_drama'])->name('music_drama');

//get Lyrics Api//
Route::post('get_lyrics', [HomeController::class, 'get_lyrics'])->name('get_lyrics');
Route::post('get_songs_lyrics/{channel}', [HomeController::class, 'get_songs_lyrics'])->name('get_songs_lyrics');

Route::get('/about_us', [HomeController::class, 'about_us'])->name('about_us');

/*
 * These frontend controllers require the user to be logged in
 * All route names are prefixed with 'frontend.'
 * These routes can not be hit if the password is expired
 */
Route::group(['middleware' => ['auth', 'password_expires']], function () {
    Route::group(['namespace' => 'User', 'as' => 'user.'], function () {
        /*
         * User Dashboard Specific
         */
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        /*
         * User Account Specific
         */
        Route::get('account', [AccountController::class, 'index'])->name('account');

        /*
         * User Profile Specific
         */
        Route::patch('profile/update', [ProfileController::class, 'update'])->name('profile.update');
    });
});

Route::post('/api-post-channel', [ApiController::class, 'apiPostChannel'])->name('api-post-channel');
// Route::post('/api_883JIA', [ApiController::class, 'api_883JIA'])->name('api_883JIA');
// Route::post('/api_JIA_WEBHITS_S01', [ApiController::class, 'api_JIA_WEBHITS_S01'])->name('api_JIA_WEBHITS_S01');
// Route::post('/api_JIA_KPOP_S01', [ApiController::class, 'api_JIA_KPOP_S01'])->name('api_JIA_KPOP_S01');
// Route::post('/api_POWER_98_HITS_S01', [ApiController::class, 'api_POWER_98_HITS_S01'])->name('api_POWER_98_HITS_S01');
// Route::post('/api_POWER98_LOVESONGS', [ApiController::class, 'api_POWER98_LOVESONGS'])->name('api_POWER98_LOVESONGS');
// Route::post('/api_POWER_98_RAW_S01', [ApiController::class, 'api_POWER_98_RAW_S01'])->name('api_POWER_98_RAW_S01');

Route::get('response-get-channel/{channel}', [HomeController::class, 'responseGetChannel'])->name('response-get-channel');
// Route::get('response_883jia', [HomeController::class, 'response_883jia'])->name('response_883jia');
// Route::get('response_883jia_2', [HomeController::class, 'response_883jia_2'])->name('response_883jia_2');
// Route::get('response_883jia_3', [HomeController::class, 'response_883jia_3'])->name('response_883jia_3');
// Route::get('response_power_98', [HomeController::class, 'response_power_98'])->name('response_power_98');
// Route::get('response_power_98_hits', [HomeController::class, 'response_power_98_hits'])->name('response_power_98_hits');
// Route::get('response_power_98_ls', [HomeController::class, 'response_power_98_ls'])->name('response_power_98_ls');