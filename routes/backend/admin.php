<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\TimebeltController;
use App\Http\Controllers\Backend\LogoSettingController;
/*
 * All route names are prefixed with 'admin.'.
 */
Route::redirect('/', '/admin/dashboard', 301);
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::post('news/update-news-label', 'NewsController@updateNewsLabel')->name('update-news-label');
Route::post('news/update-ordering', 'NewsController@updateNewsOrdering')->name('update-ordering');
Route::resource('news', 'NewsController');
Route::resource('categories', 'CategoryController');
Route::post('posts/upload', 'PostController@upload')->name('upload');
Route::post('posts/update-filters', 'PostController@updateFilters')->name('update-filters');
Route::resource('posts', 'PostController');
Route::post('posts/deleteimage', 'PostController@deleteimage')->name('deleteimage');
Route::get('timebelt', [TimebeltController::class, 'index'])->name('timebelt');

Route::get('timebelt/index', [TimebeltController::class, 'index'])->name('timebelt.index');

Route::get('timebelt/create', [TimebeltController::class, 'create'])->name('timebelt.create');

Route::post('timebelt', [TimebeltController::class, 'store'])->name('timebelt.store');

Route::get('timebelt/edit/{id}', [TimebeltController::class, 'edit'])->name('timebelt.edit');

Route::patch('timebelt/update/{id}', [TimebeltController::class, 'update'])->name('timebelt.update');

Route::delete('timebelt/delete/{id}', [TimebeltController::class, 'delete'])->name('timebelt.delete');


Route::get('logo_setting', [LogoSettingController::class, 'index'])->name('logo_setting');

Route::get('logo_setting/index', [LogoSettingController::class, 'index'])->name('logo_setting.index');

Route::get('logo_setting/create', [LogoSettingController::class, 'create'])->name('logo_setting.create');

Route::post('logo_setting', [LogoSettingController::class, 'store'])->name('logo_setting.store');

Route::get('logo_setting/edit/{id}', [LogoSettingController::class, 'edit'])->name('logo_setting.edit');

Route::patch('logo_setting/update/{id}', [LogoSettingController::class, 'update'])->name('logo_setting.update');

Route::delete('logo_setting/delete/{id}', [LogoSettingController::class, 'delete'])->name('logo_setting.delete');