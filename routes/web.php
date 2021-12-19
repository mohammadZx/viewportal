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

    Route::get('/question/request/{id}', 'Question\QuestionRequestController@create')->name('question_request');
    Route::post('/question/request/{id}', 'Question\QuestionRequestController@store')->name('question_request');
    /**  ----------- END ------------- **/

    Route::get('/transactions', 'Transaction\TransactionController@index')->name('transactions');
    Route::get('/requests', 'Request\RequestController@index')->name('requests');
    Route::get('/request/{id}', 'Request\RequestController@show')->name('request');

    /** -------------- WALLET ---------------  **/
    Route::get('wallet','Wallet\UserWalletController@index')->name('wallet');
    Route::post('wallet/charge','Wallet\UserWalletController@charge')->name('charge');
    Route::get('wallet/verify','Wallet\UserWalletController@verify')->name('verify');
    Route::post('wallet/liquidation','Wallet\UserWalletController@liquidation')->name('liquidation');



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
Route::resource('request','Request\RequestController');
Route::resource('transaction','Transaction\TransactionController')->middleware('can:admin,superadmin');
Route::get('comment/reference', 'Comment\CommentController@reference')->middleware('can:reference')->name('comment.reject');
Route::get('comment/{id}/approveforrequest', 'Comment\CommentController@approveforrequest')->name('comment.approve');
Route::get('comment/{id}/disapproveforrequest', 'Comment\CommentController@disapproveforrequest')->name('comment.disapprove');
Route::resource('comment','Comment\CommentController');
Route::resource('coupon','Coupon\CouponController')->middleware('can:admin,superadmin');
Route::resource('option','Option\OptionController')->middleware('can:admin,superadmin');
Route::resource('option-var','Coupon\OptionVarController')->middleware('can:admin,superadmin');
Route::resource('option-type','Coupon\OptionTypeController')->middleware('can:admin,superadmin');


Route::get('/wallet/order','User\UserWalletController@index')->name('wallet_order')->middleware('can:admin,superadmin');
Route::put('/wallet/order', 'User\UserWalletController@changeStatus')->name('wallet_order')->middleware('can:admin,superadmin');



Route::get('/test',function(){
 
});