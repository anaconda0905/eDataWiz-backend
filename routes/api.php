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

Route::post('lists', 'API\FilesAPIController@getList');

Route::post('productlist', 'API\CategoryAPIController@productlist');
Route::post('category1', 'API\CategoryAPIController@getCatgory1');
Route::post('category2', 'API\CategoryAPIController@getCatgory2');
Route::post('category3', 'API\CategoryAPIController@getCatgory3');
Route::post('category4', 'API\CategoryAPIController@getCatgory4');
Route::post('category5', 'API\CategoryAPIController@getCatgory5');
Route::post('category6', 'API\CategoryAPIController@getCatgory6');

Route::post('login', 'API\UserAPIController@login');
Route::post('register', 'API\UserAPIController@register');
Route::post('send_reset_code_email', 'API\UserAPIController@sendResetCodeEmail');
Route::post('reset_code_verify', 'API\UserAPIController@verifyCode');
Route::post('resetpassword', 'API\UserAPIController@resetpassword');

Route::post('send_verify_account_email', 'API\UserAPIController@sendVerifyAccountCodeEmail');
Route::post('verify_account', 'API\UserAPIController@VerifyAccount');

Route::post('logout', 'API\UserAPIController@logout');
Route::post('changepassword', 'API\UserAPIController@changepassword');
Route::post('login/{social}','API\UserAPIController@socialLogin')->where('social','twitter|facebook|linkedin|google|github|bitbucket');
