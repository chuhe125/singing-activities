<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enroll extends Model
{

    protected $table = 'enroll';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = [];


    /**
     * 查看未审批节目
     * @return false
     */
    public static function SelectEnroll()
    {
        try {
            $res=self::select('program.type','enroll.school_name','enroll.id','enroll.works_name')
                ->leftJoin('program','program.id','enroll.program_id')  //右表找from id
                ->where('enroll.city_state','0')     //查询被借的设备
/*                ->distinct('equipment.equipment_id')  //去重
                ->where('equipment.status','1')     //查询被借的设备*/
                ->get();
            return $res;
        }catch (\Exception $e){
            logError('信息录入成功',[$e->getMessage()]);
            return false;
        }
    }

    /**
     * 查看审批过的记录
     * @return false
     */
    public static function SelectEnrollRecording()
    {
        try {
            $res=self::select('program.type','enroll.school_name','enroll.id','enroll.works_name','enroll.city_state')
                ->leftJoin('program','program.id','enroll.program_id')  //右表找from id
                ->where('enroll.city_state','1')     //查询被借的设备
                ->orwhere('enroll.city_state','2')     //查询被借的设备
                ->get();
            return $res;
        }catch (\Exception $e){
            logError('信息录入成功',[$e->getMessage()]);
            return false;
        }
    }


    /**
     * 根据id查看详细信息
     * @param $id
     * @return false
     */
    public static function SelectEnrollByid($id)
    {
        try {
            $res=self::where('id',$id)->get();
            return $res;
        }catch (\Exception $e){
            logError('信息录入成功',[$e->getMessage()]);
            return false;
        }
    }


    /**
     * 传 节目编号 通过
     * @param $id
     * @return false
     */
    public static function EnrollPass($id)
    {
        try {
            $res=self::where('id',$id)->
            update([
                'city_state'=>1,
            ]);
            return $res;
        }catch (\Exception $e){
            logError('审批通过',[$e->getMessage()]);
            return false;
        }
    }

    /**
     *
     * 单个驳回
     * @param $id
     * @param $city_reason
     * @return false
     */
    public static function EnrollBack($id,$city_reason)
    {
        try {
            $res=self::where('id',$id)->
            update([
                'city_state'=>2,
                'city_reason'=>$city_reason,
            ]);
            return $res;
        }catch (\Exception $e){
            logError('审批通过',[$e->getMessage()]);
            return false;
        }
    }

    /**
     * 一件驳回
     */
    public static function EnrollAllBack($city_reason,$arr)
    {
        try {
            foreach($arr as $v)
            {
               $res=self::where('id',$v)->update([
                    'city_reason'=>$city_reason,
                ]);
            }
            return $res;
        }catch (\Exception $e){
            logError('审批通过',[$e->getMessage()]);
            return false;
        }
    }


}
