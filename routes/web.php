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
//Logout route
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::resource('events','EventsController');

Route::resource('items','ItemsController');

Route::resource('invoices','InvoicesController');

Route::resource('bookings','BookingsController');

Route::get('booking/{bookingId}/approve','BookingsController@approve');

Route::get('booking/{bookingId}/decline','BookingsController@decline');

Route::get('/view-event/{id}', 'HomeController@viewEvent');

Route::post('imageUploadForm', 'HomeController@updateProofOfPayment' );

Route::post('proofOfPayment/{bookingId}', 'HomeController@proofOfPayment' );

Route::get('/booking/create-event-booking/{id}', 'BookingsController@createEventBooking');

Route::get('/events/{id}/submitEvent', 'EventsController@submitEvent');

Route::get('/home', 'HomeController@index');

Route::get('/my-invoices', 'HomeController@loadInvoices');

Route::get('/invoices/{id}/print', 'InvoicesController@printInvoice');


Route::get('/process-bookings', 'CronsController@processBookings');

// Verification function of HomeController
Route::post('/verification', 'HomeController@verification');

//ajax for knobs
Route::get('/ajax/knobs', ['as'=>'ajax.knobs', 'uses' => 'HomeController@updateKnobs']);

// Profile Resource routes
Route::resource('/profile',  'UsersController');

// Password update
Route::patch('/password/update/', ['as' => 'password.update', 'uses' => 'UsersController@updatePassword']);

// Notifications Resources
Route::resource('notifications',  'NotificationsController');

// Get Unread Notifications route
Route::get('/unread/notifications', function () { 
    $notifications = new App\Notification;
    $unreadNotifications = $notifications->where(['user_id' => Auth::id(), 'viewed'=> false])->get();
    session(['unread-notifications:'.Auth::user()->id =>  $unreadNotifications]);
    return response()->json(['status' => 200, 'data' => $unreadNotifications]);
});

//Contact us form  routes
Route::post('/contact-us', ['as' => 'contact-us', 'uses' => 'HomeController@contact_us']);

//unsuscribe get Route
Route::get('/unsubscribe/{id}/{verification}', function($id, $verification){
    $user = App\User::where(['id' => $id, 'code' => $verification])->first();
    return view('layouts.unsubscribe', compact('user'));
});

//unsuscribe post Route
Route::post('/unsubscribe/{id}/{verification}', function($id, $verification){
    $user = App\User::where(['id' => $id, 'code' => $verification])->update(['subscription' => false]);  
    flash('You\'ve unsubscribed successfully to our email communications', 'info');
    return redirect('/');
});

// Payment post Routes
Route::post('/payment/accepted', ['as' => 'payment.accepted', 'uses' => 'BookingsController@sagepay_accepted']);
Route::post('/payment/declined', ['as' => 'payment.declined', 'uses' => 'BookingsController@sagepay_declined']);
Route::post('/payment/redirect', ['as' => 'payment.redirect', 'uses' => 'BookingsController@sagepay_redirect']);
Route::post('/payment/notify', ['as' => 'payment.notify', 'uses' => 'BookingsController@sagepay_notify']);


//Attendee Routes
Route::post('/attendees/{event}/save', ['as' =>'attendees.save', 'uses' => 'BookingsController@save_attendees']);
Route::get('/attendees/{event}/add', ['as' =>'attendees.add', 'uses' => 'BookingsController@add_attendees']);
Route::post('/attendees/{event}/book', ['as' => 'attendees.book', 'uses' => 'BookingsController@add_attendees_booking']);
Route::get('/attendees/{event}/print', ['as' => 'attendees.print', 'uses' => 'EventsController@print_attendees']);