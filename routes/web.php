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

Route::get('/', ['uses' => 'HomeController@home', 'as' => 'home']);
Route::get('about', ['uses' => 'HomeController@about', 'as' => 'about']);
Route::get('solution', ['uses' => 'HomeController@solution', 'as' => 'solution']);
Route::get('contact', ['uses' => 'HomeController@contact', 'as' => 'contact']);
Route::get('demo', ['uses' => 'HomeController@demo', 'as' => 'demo']);
Route::get('verify', ['uses' => 'HomeController@verify', 'as' => 'verify']);
Route::post('verifyCode', 'UserController@verifyCode');
Route::post('resend_verification_email', 'UserController@resendCode');
Route::get('qrLogin', ['uses' => 'QrLoginController@index']);
Route::get('qrLogin-option1', ['uses' => 'QrLoginController@indexoption2']);
Route::post('qrLogin', ['uses' => 'QrLoginController@checkUser']);

Route::group(['middleware' => 'ipcheck'], function () {
        Route::auth();
        Route::get('/login/{social}','Auth\LoginController@socialLogin')->where('social','twitter|facebook|linkedin|google|github|bitbucket');
        Route::get('/login/{social}/callback','Auth\LoginController@handleProviderCallback')->where('social','twitter|facebook|linkedin|google|github|bitbucket');
});

Route::group(['middleware' => ['web', 'auth', 'permission' ] ], function () {
        Route::post('ajax_update', 'HomeController@ajax_update');
        Route::post('ajax_update_copy', 'HomeController@ajax_update_copy');
        
        Route::post('updateQuestion','API\QuestionController@updateQuestion');
        Route::post('deleteQuestion','API\QuestionController@deleteQuestion');
        Route::post('searchProduct','API\QuestionController@searchProduct');

        Route::resource('questions','API\QuestionController');
        Route::resource('categories','API\CategoryController');
        Route::get('createGeneral','API\CategoryController@createGeneral');
        Route::get('editGeneral','API\CategoryController@editGeneral');
        Route::get('deleteGeneral','API\CategoryController@deleteGeneral');

        Route::get('createClassification','API\CategoryController@createClassification');
        Route::get('editClassification','API\CategoryController@editClassification');
        Route::get('deleteClassification','API\CategoryController@deleteClassification');

        Route::get('createHeader','API\CategoryController@createHeader');
        Route::get('editHeader','API\CategoryController@editHeader');
        Route::get('deleteHeader','API\CategoryController@deleteHeader');

        Route::get('createList','API\CategoryController@createList');
        Route::get('editList','API\CategoryController@editList');
        Route::get('deleteList','API\CategoryController@deleteList');

        Route::get('createDList','API\CategoryController@createDList');
        Route::get('editDList','API\CategoryController@editDList');
        Route::get('deleteDList','API\CategoryController@deleteDList');


        Route::get('createBrand','API\CategoryController@createBrand');
        Route::get('editBrand','API\CategoryController@editBrand');
        Route::get('deleteBrand','API\CategoryController@deleteBrand');

        
        

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

 