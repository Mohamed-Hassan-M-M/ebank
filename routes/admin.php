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
date_default_timezone_set("Africa/Cairo");
//App::setLocale('ar');

//Auth::routes();

Route::group(['prefix'=>'admin'],function (){

    Route::group(["middleware"=>'auth:admin'],function (){
        Route::get('/','AdminAuthController@index')->name('admin.dashboard');
        Route::get('/logout','AdminAuthController@logout')->name('admin.logout');

        Route::group(['prefix'=>'bank'],function (){
            Route::get('/','BankController@index')->name('admin.bank.index');
            Route::get('/create','BankController@create')->name('admin.bank.create');
            Route::post('/Create','BankController@doCreate')->name('admin.bank.doCreate');
            Route::get('/edit/{id}','BankController@edit')->name('admin.bank.edit');
            Route::post('/edit/{id}','BankController@doEdit')->name('admin.bank.doEdit');
            Route::get('/delete/{id}','BankController@delete')->name('admin.bank.delete');
            Route::get('/status/{id}','BankController@status')->name('admin.bank.status');
        });

        Route::group(['prefix'=>'admin','middleware'=>'superAdmin'],function (){
            Route::get('/','AdminController@index')->name('admin.admin.index');
            Route::get('/create','AdminController@create')->name('admin.admin.create');
            Route::post('/Create','AdminController@doCreate')->name('admin.admin.doCreate');
            Route::get('/edit/{id}','AdminController@edit')->name('admin.admin.edit');
            Route::post('/edit/{id}','AdminController@doEdit')->name('admin.admin.doEdit');
            Route::get('/delete/{id}','AdminController@delete')->name('admin.admin.delete');
            Route::get('/status/{id}','AdminController@status')->name('admin.admin.status');
        });
        Route::group(['prefix'=>'customer'],function (){
            Route::get('/','CustomerController@index')->name('admin.customer.index');
            Route::get('/status/{id}','CustomerController@status')->name('admin.customer.status');
        });
    });

    Route::group(['middleware'=>'guest:admin'],function (){
        Route::get('/login','AdminAuthController@login')->name('admin.login');
        Route::post('/login','AdminAuthController@doLogin')->name('admin.doLogin');
    });
});
