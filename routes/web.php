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
//Auth::routes();

Route::get('/', 'WebsiteController@index')->name('website.home');

Route::group(['prefix'=>'user'],function (){

    Route::group(['middleware'=>['auth:web','verified','blocked']],function (){

        Route::get('/logout', 'CustomerAuthController@logout')->name('user.logout');

        Route::get('/', 'AccountController@index')->name('account.index');
        Route::get('/manageaccount', 'AccountController@manageaccount')->name('account.manageaccount');
        Route::get('/ourservice', 'AccountController@ourservice')->name('account.ourservice');
        Route::get('/transaction', 'AccountController@transaction')->name('account.transaction');
        Route::post('/deposit', 'AccountController@doDeposit')->name('account.doDeposit');

        Route::group(['middleware'=>'Soft-block'],function (){

            Route::post('/withdrawal', 'AccountController@doWithdrawal')->name('account.doWithdrawal');

            Route::group(['prefix'=>'transfer'],function (){
                Route::get('/', 'AccountController@transfer')->name('account.transfer');
                Route::post('/', 'AccountController@doTransfer')->name('account.doTransfer');
                Route::post('/checkemail', 'AccountController@transferCheckEmail')->name('account.transferCheckEmail');
                Route::post('/checkamount', 'AccountController@transferCheckAmount')->name('account.transferCheckAmount');
            });

        });

        Route::group(['prefix'=>'bank'],function (){
            Route::post('/link', 'AccountController@doLink')->name('account.doLink');
            Route::get('/unlink/{bankid}', 'AccountController@unlink')->name('account.unlink');
        });

    });

    Route::group(['middleware'=>'guest:web'],function (){
        Route::get('/login', 'CustomerAuthController@login')->name('user.login');
        Route::post('/login', 'CustomerAuthController@doLogin')->name('user.doLogin');
        Route::get('/register', 'CustomerAuthController@register')->name('user.register');
        Route::post('/register', 'CustomerAuthController@doRegister')->name('user.doRegister');
    });

    Route::group(['namespace'=>'Auth'],function (){
        //email verification routes
        Route::get('email/verify', 'VerificationController@show')->name('verification.notice');
        Route::get('email/verify/{id}/{hash}', 'VerificationController@verify')->name('verification.verify');
        Route::post('email/resend', 'VerificationController@resend')->name('verification.resend');
        //reset password routes
        Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('password/reset', 'ResetPasswordController@reset')->name('password.update');
    });

});


