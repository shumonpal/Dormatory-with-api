<?php

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

Route::get('/', function () {
    return redirect('/admin');
});

Route::get('/worldmeter', function () {

    $crawler = Goutte::request('GET', 'https://www.worldometers.info/coronavirus/');

    $crawler->filter('.main_table_countries_div')->each(function ($node) {

        print_r($node->html());
    });
});

Route::post('/registration', 'UserController@store')->name('registration');

Route::group(['prefix' => 'admin'], function () {

    Route::get('/people/by-room', 'PeopleController@peopleByRoom')->name('people.by-room');
    Route::get('/temparatures/record', 'TemparatureController@record')->name('temparatures.record');
    Route::get('/temparatures/add', 'TemparatureController@add')->name('temparatures.add');
    Route::post('/temparatures/store', 'TemparatureController@store')->name('temparatures.store');

    Voyager::routes();
});
