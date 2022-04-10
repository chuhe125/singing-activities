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
=======


/**

 * 学校登录操作
 */
Route::prefix('users')->group(function (){
    Route::post('login','Login\UsersController@login');  //用户登录
    Route::post('again','Login\UsersController@again');  //修改用户密码
});//--wzh

/**
 * 超级管理员登录操作
 */
Route::prefix('admin')->group(function (){
    Route::post('login','Login\AdminController@login');  //超级管理员登录
    Route::post('registered','Login\AdminController@registered');  //超级管理员注册

});//--wzh

/**
 * 市级登录操作
 */
Route::prefix('city')->group(function (){
    Route::post('login','Login\CityController@login');  //市级用户登录
    Route::post('registered','Login\CityController@registered');  //市级用户注册
});//--wzh

/**
 * 省级登录操作
 */
Route::prefix('province')->group(function (){
    Route::post('login','Login\ProvinceController@login');  //省级用户登录
    Route::post('registered','Login\ProvinceController@registered');  //省级用户注册
});//--wzh

    Route::middleware('jwt.role:admin')->prefix('adminjk')->group(function () {
    Route::post('registered','Login\UsersController@registered');  //用户注册
    Route::post('again','Login\AdminController@again');  //重置用户密码
    Route::post('look','Login\AdminController@look');  //查询所有账户信息与状态
    Route::post('state','Login\AdminController@state');  //权限变更
    Route::post('change','Login\AdminController@change');  //修改学校名
    Route::post('delete','Login\AdminController@delete');  //删除学校
    Route::post('find','Login\AdminController@find');  //根据名称查询学校
});//--wzh
=======
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

=======
/**
 * csl
 */
Route::prefix('province')->group(function () {
    Route::get('show','ProvinceController@Show');//节目审批展示
    Route::post('showci','ProvinceController@Showci');//查看详词作者
    Route::post('showxiangmu','ProvinceController@Showxiangmu');//查看详情项目负责人
    Route::post('showqu','ProvinceController@Showqu');//查看详情曲作者
    Route::post('showall','ProvinceController@Showall');//查看详情
    Route::post('reject','ProvinceController@Reject');//一键驳回
    Route::post('type','ProvinceController@Type');//活动类型
    Route::post('inquire','ProvinceController@Inquire');//根据学校名查询
    Route::get('look','ProvinceController@Look');//审批记录
});


