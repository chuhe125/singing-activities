<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProgramidRequest;
use App\Http\Requests\SchoolRequest;
use App\Http\Requests\TypeRequest;
use App\Model\enroll;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    /**
     *
     * 节目审批展示
     */
    public function Show(){
        $res=enroll::show();

        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }


    /**
     * 一键驳回
     */
    public function Reject(Request $request){
        $reason=$request['reason'];
        $program_ids=$request['program_ids'];
        $res=enroll::reject( $program_ids,$reason);

        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }

    /**
     * 查看详情中词作者信息，项目负责人，曲作者信息
     */
    public function Showci(ProgramidRequest $request){
        $id=$request['program_id'];
        $res=enroll::ci( $id);


        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }
    public function Showxiangmu(ProgramidRequest $request){
        $id=$request['program_id'];
        $res=enroll::xiangmu( $id);
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }
    public function Showqu(ProgramidRequest $request){
        $id=$request['program_id'];
        $res=enroll::qu( $id);
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }
    public function Showall(ProgramidRequest $request){
        $id=$request['program_id'];
        $res=enroll::qita($id);
        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }
    /**
     * 根据活动类型查询
     */
    public function Type(TypeRequest $request){
        $type=$request['type'];
        $res=enroll::type($type);

        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }

    /**
     * 根据学校名查询
     */
    public function Inquire(SchoolRequest $request){
        $name=$request['school_name'];
        $res=enroll::inquire($name);

        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }


    /**
     * 审批记录
     */
    public function Look(){
        $res=enroll::look();

        return $res?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
}


}
