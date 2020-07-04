<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth',
    'namespace' => 'API\Auth',

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user;
});

Route::middleware('auth:api')->namespace('API')->group(function () {
    Route::apiResource('companies', 'CompanyController');
    Route::apiResource('rooms', 'RoomController');
    Route::apiResource('companyrooms', 'CompanyRoomController');
    Route::apiResource('people', 'PeopleController');
    Route::resource('temparature', 'TemparatureController')->only(['index', 'create', 'store']);
});
