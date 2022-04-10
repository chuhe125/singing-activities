<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class enroll extends Model
{
    protected $table = "enroll";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];
    /**
     * 节目审批信息展示
     */
    public static function show()
    {
        try {

            $res=self::join('program', 'program.id', 'enroll.program_id')
                ->select('school_name', 'program.type', 'works_name', 'program_id')->get();

            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }

/**
 *根据活动类型查询
 */
    public static function type($type)
    {
        try {

            $res=self::join('program', 'program.id', 'enroll.program_id')
                ->where('program.type',$type)
                ->select('school_name', 'program.type', 'works_name', 'program_id')->get();

            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }
    /**
     *根据学校查询
     */
    public static function inquire($school_name)
    {
        try {

            $res=self::join('program', 'program.id', 'enroll.program_id')
                ->where('school_name',$school_name)
                ->select('school_name', 'program.type', 'works_name', 'program_id')->get();

            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }

    /**
     *审批记录
     */
    public static function look()
    {
        try {

            $res=self::join('program', 'program.id', 'enroll.program_id')
                ->select('school_name', 'program.type', 'works_name', 'program_id','enroll.updated_at','province_state')->get();

            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }


    /**
     *一键驳回
     */
    public static function reject($program_ids,$reason)
    {
        try {
            foreach($program_ids as $program_id) {
                $res=self::where('program_id',$program_id)
                    ->update([
                        'province_state'=> 2,
                        'province_reason'=>$reason
                    ]);
            }
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
   }


    /**
     *审批详情的词作者信息，项目负责人，曲作者信息
     *
     */
public static function ci($id){
    try {

        $res=self::join('information', 'information.enroll_id', 'enroll.id')
            ->where('words_state',1)
            ->where('enroll.id',$id)
            ->select('name','contact','identity_card')
            ->get();

        return $res ?
            $res :
            false;
    } catch (\Exception $e) {
        logError('搜索错误', [$e->getMessage()]);
        return false;
    }
}
    public static function xiangmu($id){
        try {

            $res=self::join('information', 'information.enroll_id', 'enroll.id')
                ->where('leader_state',1)
                ->where('enroll.id',$id)
                ->select('name','contact','identity_card')
                ->get();

            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }
    public static function qu($id){
        try {

            $res=self::join('information', 'information.enroll_id', 'enroll.id')
                ->where('song_state',1)
                ->where('enroll.id',$id)
                ->select('name','contact','identity_card')
                ->get();

            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }
    /**
     *审批详情的其他内容
     *
     */
    public static function qita($id){
        try {

            $res=self::where('program_id',$id)
                ->select('school_name','works_name','creation_time','works_type','works_time','singer','audio_frequency','score','introduction')
                ->get();

            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }



}
