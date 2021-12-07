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
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::prefix('/user')->name('user.')->group(function(){
    /**  ----------- QUESTION AND GATEWAY ---------- **/
    Route::get('/question/send', 'Question\QuestionController@create')->name('send_question');
    Route::post('/question/send', 'Question\QuestionController@set')->name('set_question');
    Route::get('/question/check', 'Question\QuestionController@check')->name('check_question');
    /**  ----------- END ------------- **/


    /** -------------- WALLET ---------------  **/
    Route::get('wallet','Wallet\UserWalletController@index')->name('wallet');
    Route::get('wallet/charge','Wallet\UserWalletController@charge')->name('charge');
    Route::get('wallet/verify','Wallet\UserWalletController@verify')->name('verify');



    /** -------------- PROFILE ---------------  **/
    Route::get('/change-password','Profile\ChangePassword@index')->name('password');
    Route::put('/change-password','Profile\ChangePassword@update')->name('change_password');
    Route::get('/change-data','Profile\UserDataManageMent@index')->name('data');
    Route::put('/change-data','Profile\UserDataManageMent@update')->name('change_data');

     /** -------------- ADMIN EDITS USER ---------------  **/
    Route::get('/change-password/{userid}','Profile\ChangePassword@index')->name('a_password')->middleware('can:admin,superadmin');
    Route::put('/change-password/{userid}','Profile\ChangePassword@update')->name('a_change_password')->middleware('can:admin,superadmin');
    Route::get('/change-data/{userid}','Profile\UserDataManageMent@index')->name('a_data')->middleware('can:admin,superadmin');
    Route::put('/change-data/{userid}','Profile\UserDataManageMent@update')->name('a_change_data')->middleware('can:admin,superadmin');
});


Route::resource('user','User\UserController')->middleware('can:admin,superadmin');
Route::post('/user/clear-wallet/{id}', 'User\UserController@clearingWallet')->middleware('can:admin,superadmin')->name('user.clear-wallet');
Route::resource('request','Request\RequestController')->middleware('can:admin,superadmin,expert');
Route::resource('transaction','Transaction\TransactionController')->middleware('can:admin,superadmin');
Route::resource('comment','Comment\CommentController')->middleware('can:admin,superadmin,expert');
Route::resource('coupon','Coupon\CouponController')->middleware('can:admin,superadmin');
Route::resource('attachment','Attachment\Attachment')->middleware('can:admin,superadmin');
Route::get('comment/reject', 'Comment\CommentController@reject')->name('comment.reject');

Route::get('/wallet/order','User\UserWalletController@index')->name('wallet_order')->middleware('can:admin,superadmin');
Route::put('/wallet/order', 'User\UserWalletController@changeStatus')->name('wallet_order_status')->middleware('can:admin,superadmin');



Route::get('/test',function(){
 
});