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
Route::get('/home', 'FlightController@getList')->name('home');
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
Route::post('postEdit', 'UserController@postEdit')->name('postEdit');

// dat ve
Route::post('postBooking', 'FlightController@postBooking')->name('postBooking');


//================TEST 2==================

// hiển thị danh sách các sân bay
Route::get('getListAirport', 'HomeController@getListAirport')->name('listAirport'); 

// hiển thị danh sách các hãng bay
Route::get('getListAirline', 'HomeController@listAirline')->name('listAirline');

// thêm chuyến bay
Route::get('getAddFlight', 'FlightController@getAdd')->name('addFlight');
Route::post('postAddFlight', 'FlightController@postAdd')->name('postFlight');

// Quản lí danh sách vé đã đặt
Route::get('getViewBooked', 'UserController@getViewBook')->name('viewBook');

// xem chi tiết vé đã đặt
Route::get('getDetailBook', 'UserController@getDetailBook')->name('getDetailBook');

// xóa vé đã đặt
Route::get('deleteBooked/{idBook}', 'UserController@deleteBooked')->name('deleteBooked');

// hiển thị danh sách passenger theo id
Route::get('getPassenger/{idPassenger}', 'UserController@getPassenger')->name('getPassenger');

// sửa thông tin passenger
Route::post('postEditPassenger', 'UserController@postEditPassenger')->name('postEditPassenger');