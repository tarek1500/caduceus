<?php

use App\Enums\UserType;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
	return view('welcome');
});

Auth::routes();

Route::get('home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::get('profile', 'ProfileController@index')->name('profile.index');
	Route::put('profile', 'ProfileController@update')->name('profile.update');

	Route::resource('appointments', 'AppointmentController')->only(['index', 'create', 'store', 'show', 'update']);
	Route::resource('cases', 'CaseController')->middleware('authorize:' . UserType::DOCTOR)->only(['index', 'show', 'update']);
	Route::resource('notifications', 'NotificationController')->only(['index', 'show']);

	Route::group(['prefix' => 'dashboard', 'namespace' => 'Dashboard', 'as' => 'dashboard.', 'middleware' => 'authorize:' . UserType::ADMIN], function () {
		Route::get('', 'DashboardController@index')->name('index');
		Route::resource('users', 'UserController');
		Route::resource('appointments', 'AppointmentController');
	});
});