<?php

namespace App\Http\Controllers\City\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\City\EnrollAllBackRequest;
use App\Http\Requests\City\EnrollBackRequest;
use App\Http\Requests\City\EnrollPassRequest;
use App\Http\Requests\City\SelectEnrollByidRequest;
use App\Models\Enroll;
use Illuminate\Http\Request;

class CityController extends Controller
{

    //查看节目
    public function SelectEnroll(){
        $res = Enroll::SelectEnroll();
        return $res ?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }

    //驳回记录
    public function SelectEnrollRecording(){
        $res = Enroll::SelectEnrollRecording();
        return $res ?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }


    //根据id查看
    public function SelectEnrollByid(SelectEnrollByidRequest  $request){
        $id=$request['id'];
        $res = Enroll::SelectEnrollByid($id);
        return $res ?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }


    //根据id通过
    public function EnrollPass(EnrollPassRequest  $request){
        $id=$request['id'];
        $res = Enroll::EnrollPass($id);
        return $res ?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }


    //根据id 驳回
    public function EnrollBack(EnrollBackRequest  $request){
        $id=$request['id'];
        $city_reason=$request['city_reason'];
        $res = Enroll::EnrollBack($id,$city_reason);
        return $res ?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }



    //一键 驳回
    public function EnrollAllBack(EnrollAllBackRequest  $request){
        $city_reason=$request['city_reason'];
        $arr=$request['arr'];
        $res = Enroll::EnrollAllBack($city_reason,$arr);
        return $res ?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }


}
