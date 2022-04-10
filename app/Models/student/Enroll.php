<?php


namespace App\Models\student;


use Illuminate\Database\Eloquent\Model;

class Enroll extends Model
{
    protected  $table = 'enroll';
    public $timestamps = true ;
    protected $primaryKey = 'id';
    protected $guarded = [];

    /**
     * 学生端填报传唱歌曲表单
     * @author zqz
     * @param $u_login_id 学生端登录的id
     * @param $works_name 	曲目
     * @param $school_name 	学校名称
     * @param $creation_time 创作时间
     * @param $works_time 作品时长
     * @param $singer 演唱者
     * @param $audio_frequency 音频
     * @return 结果不为空表示填报成功
     */
    public static function enrollSing($u_login_id,$works_name,$school_name,$creation_time,$works_time,$singer,$audio_frequency){
        try {
            $res = self::create(
                [
                    'u_login_id'      =>$u_login_id,
                    'program_id'      =>1,
                    'works_name'      =>$works_name,
                    'school_name'     =>$school_name,
                    'creation_time'   =>$creation_time,
                    'works_time'      =>$works_time,
                    'singer'          =>$singer,
                    'audio_frequency' =>$audio_frequency,
                ]);
            return $res;
        }

        catch (\Exception $e){
            logError('注册失败',[$e->getMessage()]);
            return false;
        }
    }

    /**
     * @param $u_login_id 学生端登录的id
     * @param $school_name 学校名称
     * @param $works_name 作品名称
     * @param $creation_time 创作时间
     * @param $works_type 作品类别
     * @param $works_time 作品时长
     * @param $singer 演唱者
     * @param $words_information 词作者信息
     * @param $song_information 曲作者信息
     * @param $leader_information 项目负责人信息
     * @param $audio_frequency 音频
     * @param $score 歌谱
     * @param $introduction 作品简介
     * @param $commitment 版权承诺书
     * @return false   结果不为空表示填报成功
     */
    public static function Original($u_login_id,$school_name,$works_name,$creation_time,$works_type, $works_time,$singer,
                                    $words_information,$song_information,$leader_information,$audio_frequency,$score,$introduction,$commitment){
        try {

            $res = self::create(
                [
                    'u_login_id'       =>$u_login_id,
                    'program_id'       =>2,
                    'school_name'      =>$school_name,
                    'works_name'       =>$works_name,
                    'creation_time'    =>$creation_time,
                    'works_type'       =>$works_type,
                    'works_time'       =>$works_time,
                    'singer'           =>$singer,
                    'audio_frequency'  =>$audio_frequency,
                    'score'            =>$score,
                    'introduction'     =>$introduction,
                    'commitment'       =>$commitment,

                ]);
            $enroll_id=$res['id'];
            for ($i=0;$i<sizeof($words_information);$i++){
                Information::create(
                    [
                        'enroll_id'        =>$enroll_id,
                        'name'             =>$words_information[$i]['name'],
                        'contact'          =>$words_information[$i]['contact'],
                        'identity_card'    =>$words_information[$i]['identity_card'],
                        'words_state'      =>1,
                    ]);
            }
            for ($i=0;$i<sizeof($song_information);$i++){
                Information::create(
                    [
                        'enroll_id'        =>$enroll_id,
                        'name'             =>$song_information[$i]['name'],
                        'contact'          =>$song_information[$i]['contact'],
                        'identity_card'    =>$song_information[$i]['identity_card'],
                        'song_state'       =>1,
                    ]);
            }
            for ($i=0;$i<sizeof($leader_information);$i++){
                 Information::create(
                    [
                        'enroll_id'        =>$enroll_id,
                        'name'             =>$leader_information[$i]['name'],
                        'contact'          =>$leader_information[$i]['contact'],
                        'leader_state'     =>1,
                    ]);
            }

            return $res;
        }

        catch (\Exception $e){
            logError('注册失败',[$e->getMessage()]);
            return false;
        }
    }
}
