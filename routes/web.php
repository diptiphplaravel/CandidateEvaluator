<?php

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

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/guestFormSubmit',"GuestFormController@submitGuestFormData");

Route::get('/viewProfileList','GuestFormController@viewProfileList');

Route::get('/editProfileDetail/{profile_id}/{editprofile}','GuestFormController@editProfileDetail');

Route::post('/updateProfileDetails','GuestFormController@updateProfileDetails');

