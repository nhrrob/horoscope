<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');
Route::post('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');
Route::get('/events', [App\Http\Controllers\HomeController::class, 'events'])->name('home.events');

Auth::routes();

Route::group(['prefix' => 'admin/', 'middleware' => 'auth'], function () { 
  Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
  Route::resource('zodiac-signs', '\App\Http\Controllers\ZodiacSignController'); 
  Route::resource('horoscopes', '\App\Http\Controllers\HoroscopeController'); 
  Route::resource('zodiac-sign-scores', '\App\Http\Controllers\ZodiacSignScoreController'); 
  Route::resource('score-comments', '\App\Http\Controllers\ScoreCommentController'); 


});