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
    Route::post('/question/set', 'Question\QuestionController@set')->name('set_question');
    Route::post('/question/set_coupon', 'Question\QuestionController@setCoupon')->name('set_coupon');
    Route::get('/question/check', 'Question\QuestionController@check')->name('check_question');
    /**  ----------- END ------------- **/


    /** -------------- WALLET ---------------  **/
    Route::get('wallet','Wallet\UserWalletController@index')->name('wallet');
    Route::get('wallet/charge','Wallet\UserWalletController@charge')->name('charge');
    Route::get('wallet/verify','Wallet\UserWalletController@verify')->name('verify');



    /** -------------- PROFILE ---------------  **/
    Route::get('/change-password','Profile\ChangePassword@index')->name('password');
    Route::post('/change-password','Profile\ChangePassword@update')->name('change_password');
    Route::get('/change-data','Profile\UserDataManageMent@index')->name('data');
    Route::post('/change-data','Profile\UserDataManageMent@update')->name('change_data');
});


Route::resource('user','User\UserController');
Route::resource('request','Request\RequestController');
Route::resource('transaction','Transaction\TransactionController');
Route::resource('comment','Comment\CommentController');
Route::resource('coupon','Coupon\CouponController');
Route::resource('attachment','Attachment\Attachment');
Route::get('comment/reject', 'Comment\CommentController@reject')->name('comment.reject');

Route::get('/wallet/order','User\UserWalletController@index')->name('wallet_order');
Route::put('/wallet/order', 'User\UserWalletController@changeStatus')->name('wallet_order_status');



