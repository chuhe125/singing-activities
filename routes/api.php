<?php

use Illuminate\Http\Request;

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





/**
 * 市级模块
 */
Route::prefix('city')->group(function () {
    Route::get('selectEnroll', 'City\Controllers\CityController@SelectEnroll'); //查看未审批节目
    Route::get('selectEnrollRecording', 'City\Controllers\CityController@SelectEnrollRecording'); //查看审批了节目
    Route::post('selectEnrollByid', 'City\Controllers\CityController@SelectEnrollByid'); //根据id查看节目详细信息
    Route::post('enrollPass', 'City\Controllers\CityController@EnrollPass'); //单个通过
    Route::post('enrollBack', 'City\Controllers\CityController@EnrollBack'); //单个驳回
    Route::post('enrollAllBack', 'City\Controllers\CityController@EnrollAllBack'); //一键驳回
});

