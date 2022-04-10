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
Route::prefix('enroll')->group( function () {
    Route::post('sing','student\EnrollController@sing');//学生端填报传唱歌曲表单
    Route::post('original','student\EnrollController@original');//学生端填原创歌曲表单
});
Route::post('upload','student\UploadController@upload');//oss上传图片音频返回url
