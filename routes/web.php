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

Route::get('/', ['uses' => 'HomeController@index', 'as' => 'home']);


Route::get('/payment/create/', ['uses' => 'PaymentController@create', 'as' => 'payment/create']);
Route::post('/payment/create/', ['uses' => 'PaymentController@store', 'as' => 'payment/create']);

Route::get('/admin/payments/', [ 'uses' => 'PaymentController@adminPayments', 'as' => 'admin/payments']);
Route::post('/admin/payments/', [ 'uses' => 'PaymentController@approvePayment', 'as' => 'admin/payments']);
Route::get('/admin/houses/', [ 'uses' => 'HouseController@listHouses', 'as' => 'admin/houses']);
Route::post('/admin/houses/', [ 'uses' => 'HouseController@assignHouseToUser', 'as' => 'admin/houses']);

Auth::routes();

