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
// Route::get('about', ['uses' => 'HomeController@about', 'as' => 'about']);
Route::get('solution', ['uses' => 'HomeController@solution', 'as' => 'solution']);
Route::get('contact', ['uses' => 'HomeController@contact', 'as' => 'contact']);
Route::get('demo', ['uses' => 'HomeController@demo', 'as' => 'demo']);
Route::get('verify', ['uses' => 'HomeController@verify', 'as' => 'verify']);

Route::get('qrLogin', ['uses' => 'QrLoginController@index']);
Route::get('qrLogin-option1', ['uses' => 'QrLoginController@indexoption2']);
Route::post('qrLogin', ['uses' => 'QrLoginController@checkUser']);
Route::auth();

Route::group(['middleware' => 'fw-block-blacklisted'], function () 
{
        Route::get('about', ['uses' => 'HomeController@about', 'as' => 'about']);
});

Route::group(['middleware' => ['web', 'auth', 'permission' ] ], function () {
        Route::post('ajax_update', 'HomeController@ajax_update');
        Route::post('ajax_update_copy', 'HomeController@ajax_update_copy');
        Route::post('ajax_catgories_update1', 'CategoryController@ajax_update1');
        Route::post('ajax_catgories_update2', 'CategoryController@ajax_update2');
        Route::post('ajax_catgories_update3', 'CategoryController@ajax_update3');
        Route::post('ajax_catgories_update4', 'CategoryController@ajax_update4');
        Route::post('ajax_catgories_update5', 'CategoryController@ajax_update5');

        Route::post('ajax_catgories_update11', 'ProductController@ajax_update1');
        Route::post('ajax_catgories_update12', 'ProductController@ajax_update2');
        Route::post('ajax_catgories_update13', 'ProductController@ajax_update3');
        Route::post('ajax_catgories_update14', 'ProductController@ajax_update4');
        Route::post('ajax_catgories_update15', 'ProductController@ajax_update5');

        Route::post('ajax_sub_cat_delete', 'CategoryController@deleteSubCat');
        Route::post('ajax_sub_cat_add', 'CategoryController@addSubCat');
        Route::post('ajax_sub_cat_update', 'CategoryController@editSubCat');
        
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

        //categories
        Route::resource('category', 'CategoryController');
        Route::resource('product', 'ProductController');

        //Update User Qr Code
        Route::get('my-qrcode', ['uses' => 'QrLoginController@ViewUserQrCode']);
        Route::post('qrLogin-autogenerate', ['uses' => 'QrLoginController@QrAutoGenerate']);
 });

 Route::get('/login/{social}','Auth\LoginController@socialLogin')->where('social','twitter|facebook|linkedin|google|github|bitbucket');
 Route::get('/login/{social}/callback','Auth\LoginController@handleProviderCallback')->where('social','twitter|facebook|linkedin|google|github|bitbucket');
 
// Test #1
// https://github.com/antonioribeiro/firewall
// Route::group(['middleware' => 'ipcheck'], function () {
//         Route::get('about', ['uses' => 'HomeController@about', 'as' => 'about']);
// });