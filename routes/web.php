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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::resource('events','EventsController');

Route::resource('bookings','BookingsController');

Route::get('booking/{bookingId}/approve','BookingsController@approve');

Route::get('booking/{bookingId}/decline','BookingsController@decline');

Route::get('/view-event/{id}', 'HomeController@viewEvent');

Route::post('imageUploadForm', 'HomeController@updateProofOfPayment' );

Route::post('proofOfPayment/{bookingId}', 'HomeController@proofOfPayment' );

Route::get('/booking/create-event-booking/{id}', 'BookingsController@createEventBooking');

Route::get('/events/{id}/submitEvent', 'EventsController@submitEvent');

Route::get('/home', 'HomeController@index');

// Verification function of HomeController
Route::post('/verification', 'HomeController@verification');

//ajax for knobs
Route::get('/ajax/knobs', ['as'=>'ajax.knobs', 'uses' => 'HomeController@updateKnobs']);

// Profile Resource routes
Route::resource('/profile',  'UsersController');

// Password update
Route::patch('/password/update/', ['as' => 'password.update', 'uses' => 'UsersController@updatePassword']);

