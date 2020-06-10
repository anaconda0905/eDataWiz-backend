<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'API\UserAPIController@login');
Route::post('register', 'API\UserAPIController@register');
Route::post('send_reset_link_email', 'API\UserAPIController@sendResetLinkEmail');

Route::get('login/{social}','API\UserAPIController@socialLogin')->where('social','twitter|facebook|linkedin|google|github|bitbucket');
Route::get('login/{social}/callback','API\UserAPIController@handleProviderCallback')->where('social','twitter|facebook|linkedin|google|github|bitbucket');