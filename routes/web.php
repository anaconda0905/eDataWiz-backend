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
Route::auth();
Route::get('/', ['uses' => 'HomeController@home', 'as' => 'home']);
Route::get('about', ['uses' => 'HomeController@about', 'as' => 'about']);
Route::get('solution', ['uses' => 'HomeController@solution', 'as' => 'solution']);
Route::get('contact', ['uses' => 'HomeController@contact', 'as' => 'contact']);
Route::get('demo', ['uses' => 'HomeController@demo', 'as' => 'demo']);

Route::get('qrLogin', ['uses' => 'QrLoginController@index']);
Route::get('qrLogin-option1', ['uses' => 'QrLoginController@indexoption2']);
Route::post('qrLogin', ['uses' => 'QrLoginController@checkUser']);
Route::get('fs', ['uses' => 'HomeController@fs', 'as' => 'fs']);

Route::group(['middleware' => ['web', 'auth', 'permission'] ], function () {
        // Route::get('/laravel-filemanager', '\UniSharp\LaravelFilemanager\Controllers\LfmController@show');
        // Route::get('/demo', '\UniSharp\LaravelFilemanager\Controllers\DemoController@index');
        // Route::post('/laravel-filemanager/upload', '\UniSharp\LaravelFilemanager\Controllers\UploadController@upload');

        Route::get('dashboard', ['uses' => 'HomeController@dashboard', 'as' => 'home.dashboard']);
        //users
        Route::resource('user', 'UserController');
        Route::get('user/logout/now', ['uses' => 'Auth\LoginController@logout']);
        Route::get('user/{user}/permissions', ['uses' => 'UserController@permissions', 'as' => 'user.permissions']);
        Route::post('user/{user}/save', ['uses' => 'UserController@save', 'as' => 'user.save']);
        Route::get('user/{user}/activate', ['uses' => 'UserController@activate', 'as' => 'user.activate']);
        Route::get('user/{user}/deactivate', ['uses' => 'UserController@deactivate', 'as' => 'user.deactivate']);
        Route::post('user/ajax_all', ['uses' => 'UserController@ajax_all']);

        //roles
        Route::resource('role', 'RoleController');
        Route::get('role/{role}/permissions', ['uses' => 'RoleController@permissions', 'as' => 'role.permissions']);
        Route::post('role/{role}/save', ['uses' => 'RoleController@save', 'as' => 'role.save']);
        Route::post('role/check', ['uses' => 'RoleController@check']);
        //Update User Qr Code
        Route::get('my-qrcode', ['uses' => 'QrLoginController@ViewUserQrCode']);
        Route::post('qrLogin-autogenerate', ['uses' => 'QrLoginController@QrAutoGenerate']);
 });

 Route::get('/login/{social}','Auth\LoginController@socialLogin')->where('social','twitter|facebook|linkedin|google|github|bitbucket');
 Route::get('/login/{social}/callback','Auth\LoginController@handleProviderCallback')->where('social','twitter|facebook|linkedin|google|github|bitbucket');
 
