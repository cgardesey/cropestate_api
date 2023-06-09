<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('/register', 'UserController@register');
Route::post('/login', 'UserController@login');
Route::get('password/reset/{token}', 'Auth\RegisterController@resetPassword');


Route::resource('/users', 'UserController')->middleware('auth:api');
Route::resource('/leases', 'LeaseController')->middleware('auth:api');
Route::resource('/lease-holders', 'LeaseHolderController')->middleware('auth:api');
Route::resource('/lease-uploads', 'LeaseUploadController')->middleware('auth:api');

