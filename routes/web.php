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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'GeneralController@index');
Route::get('/index', 'GeneralController@index');

Route::get('/activity', 'GeneralController@activity');

Route::get('login', 'GeneralController@login');
Route::get('loginConfirm', 'GeneralController@loginConfirm');
Route::get('logout', 'GeneralController@logout');

Route::get('reset', 'GeneralController@reset');
Route::get('requestReset', 'GeneralController@requestReset');
Route::get('resetForm', 'GeneralController@resetForm');
Route::get('resetConfirm', 'GeneralController@resetConfirm');
Route::get('passwordForm', 'GeneralController@passwordForm');
Route::get('updatePassword', 'GeneralController@updatePassword');


Route::get('signup', 'GeneralController@signup');
Route::get('createUser', 'GeneralController@createUser')->name('createUser');

Route::get('wishForm', 'GeneralController@wishForm');
Route::get('submitWish', 'GeneralController@submitWish');

Route::get('mypage', 'GeneralController@mypage');
Route::get('remove', 'GeneralController@remove');

Route::get('trees', 'GeneralController@trees');
Route::get('treeDetail', 'GeneralController@treeDetail');
Route::get('practice', 'GeneralController@practice');


// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
