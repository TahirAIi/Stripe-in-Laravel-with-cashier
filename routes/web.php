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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/subscribe', function () {
    return view('create-subscription',[
        'intent' => \Illuminate\Support\Facades\Auth::user()->createSetupIntent()
    ]);
});

Route::get('/ltd', function () {
    return view('ltd-payment',[
        'intent' => \Illuminate\Support\Facades\Auth::user()->createSetupIntent()
    ]);
});

Auth::routes();

Route::get('/home', 'HomeController@index');
//Route::get('/create-payment-intent','StripeController@createPaymentIntent');
Route::post('/create-subscription','StripeController@setPaymentMethod');
Route::post('/create-ltd','StripeController@createPaymentIntent');

Route::post(
    'stripe/webhook',
    '\App\Http\Controllers\StripeWebhook@@handleInvoicePaymentSucceeded'
);
