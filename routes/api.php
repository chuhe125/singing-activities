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
 * lyt
 */
Route::prefix('student')->group(function () {
    Route::post('ShowDetails','StudentController@ShowDetails'); //查看细节
    Route::post('updateChuan','StudentController@updateChuan'); //更新传唱
    Route::post('updateYuan','StudentController@updateYuan'); //更新原厂
    Route::get('ShowAll','StudentController@ShowAll'); //查看所有
    Route::get('ShowAllCName','StudentController@ShowAllCName'); //查看传唱的作品名称
});
