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
date_default_timezone_set("Asia/Ho_Chi_Minh");

// trang index
Route::get('/', 'FlightController@getList')->name('/');


// auth route
Auth::routes();

// goi sau khi login
Route::get('/home', 'HomeController@index')->name('home');
Route::post('postLogin', 'LoginController@authenticate')->name('postlogin');

// search flights
Route::get('search-flight', 'FlightController@getSearch')->name('search');

// flight-detail 
Route::get('flight-detail/{flight_id}/{total}/{flight_class}/{time_from}', 'FlightController@detail');

// flight-booking
Route::get('flight-booking/{flight_id}/{total}/{flight_class}/{time_from}', 'FlightController@booking');

// flight-booking
Route::get('flight-booking-2', 'FlightController@booking_2')->name('booking');

//get view edit user
Route::get('getEdit', 'UserController@getEdit')->name('getEdit');
Route::POST('postEdit', 'UserController@postEdit')->name('postEdit');

// dat ve
Route::POST('postBooking', 'FlightController@postBooking')->name('postBooking');

