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
