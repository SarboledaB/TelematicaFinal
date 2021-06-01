<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();
Route::get('/', 'App\Http\Controllers\HomeController@index')->name("home.index");
Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

// Language
Route::get('lang/{lang}', 'App\Http\Controllers\LanguageController@switchLang')->name('lang.switch');


//Survey Routes
Route::get('/survey', 'App\Http\Controllers\admin\SurveyController@create')->name("admin.survey.create");
Route::post('/survey/save', 'App\Http\Controllers\admin\SurveyController@save')->name("admin.survey.save");

Route::get('/stats', 'App\Http\Controllers\admin\StatsController@sendStats')->name("admin.stats.sendStats");
//For user

Route::get('/profile', 'App\Http\Controllers\user\ProfileController@show')->name("user.profile.show");

Route::get('/register', 'App\Http\Controllers\Auth\RegisterController@register')->name("user.register");
Route::post('/register/save', 'App\Http\Controllers\Auth\RegisterController@save')->name("user.save");

Route::get('/list', 'App\Http\Controllers\user\SurveyController@list')->name("user.petItem.list");
