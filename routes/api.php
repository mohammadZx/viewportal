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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/v1')->group(function(){
    Route::get('/get-options', 'Question\QuestionController@getOptions');
    Route::post('/question/setdiscount', 'Question\QuestionController@setCoupon');



    Route::get('/option/{id}/types', 'Option\OptionTypeController@index');
    Route::get('/option/{id}/vars', 'Option\OptionVarController@index');


    Route::delete('/types/{id}', 'Option\OptionTypeController@destrory');
    Route::delete('/vars/{id}', 'Option\OptionVarController@destrory');

    Route::post('/types', 'Option\OptionTypeController@store');
    Route::post('/vars', 'Option\OptionVarController@store');
});
