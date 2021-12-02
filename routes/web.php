<?php

use App\Http\Controllers\AdController;
use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PluginController;

Auth::routes();

Route::get('/', function () { return redirect()->route('home'); });
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/plugin/{plugin}', [PluginController::class, 'show'])->name('plugin');
Route::get('/developers', [DeveloperController::class, 'index'])->name('developers');
Route::get('/staff', [StaffController::class, 'index'])->name('staff');
Route::group(['middleware' => 'auth'], function () {
    Route::get('/developer/submit', [DeveloperController::class, 'submit'])->name('submit_new_plugin');
    Route::post('/developer/submit', [DeveloperController::class, 'submit_post'])->name('submit_new_plugin_post');
    Route::get('/favorites', [FavoriteController::class, 'show'])->name('favorites');
    Route::post('/form/update-overview/{plugin}', [PluginController::class, 'update_overview']);
    Route::post('/form/new-release/{plugin}', [PluginController::class, 'new_release']);
    Route::get('/ads', [AdController::class, 'index'])->name('ads');
    Route::post('/ads', [AdController::class, 'submit'])->name('ads.submit');
});
