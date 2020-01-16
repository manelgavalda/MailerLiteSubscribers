<?php

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

Route::resource('subscribers', 'SubscriberController')
	->only(['index', 'store', 'update', 'destroy']);

Route::resource('fields', 'FieldController')
	->only(['store', 'update', 'destroy']);
