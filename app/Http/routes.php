<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('layouts1.auth');
});

Route::auth();

Route::get('/home', 'HomeController@index');
Route::get('/dashboard', 'DashboardController@dashboardIndex');
Route::post('/getCompanyUsers', 'DashboardController@getCompanyUsers');
Route::post('/saveImage', 'DashboardController@saveImage');
Route::post('/saveBackgroundImage', 'DashboardController@saveBackgroundImage');

Route::post('/getContacts', 'CardController@getContacts');


Route::post('/process', 'CardController@processCard');

Route::get('/getFrontCard', 'CardController@frontCard');
Route::get('/getBackCard', 'CardController@backCard');


Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'RolesAndPermissions'], function () {

        Route::get('/dashboard/create-company', [
            'permission' => env("permission_for_create_company"),
            'as' => 'create-company-view',
            'uses' => 'CompanyController@index'
        ]);

        Route::get('/dashboard/companies-listing', [
            'permission' => env("permission_for_create_company"),
            'as' => 'companies-listing-view',
            'uses' => 'CompanyController@companiesListing'
        ]);

        Route::get('/dashboard/create-user', [
            'permission' => env("permission_for_create_user"),
            'as' => 'create-user',
            'uses' => 'UserController@index'
        ]);

        Route::get('dashboard/design-card', [
            'permission' => env("permission_for_card_design"),
            'as' => 'create-user',
            'uses' => 'DashboardController@designCards'
        ]);

        Route::post('/create-company', [
            'permission' => env("permission_for_create_company"),
            'as' => 'create-company',
            'uses' => 'CompanyController@createCompany'
        ]);

        Route::post('/create-user', [
            'permission' => env("permission_for_create_user"),
            'as' => 'create-user',
            'uses' => 'UserController@createUser'
        ]);

        //
        Route::get('/dashboard/users-listing', [
            'permission' => env("permission_for_create_user"),
            'as' => 'users-listing-view',
            'uses' => 'UserController@usersListing'
        ]);
    });
});
