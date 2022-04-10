<?php


namespace App\Http\Controllers\student;

use App\Http\Requests\OriginalRequest;
use App\Http\Requests\SingRequest;
use App\Models\student\Enroll;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EnrollController extends Controller
{
    /**
     * 学生端填报传唱歌曲表单
     * @author zqz
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sing(SingRequest $request)
    {

        $u_login_id      = $request['u_login_id'];//学生端登录的id
        $works_name      = $request['works_name'];//作品名称
        $school_name     = $request['school_name'];//学校名称
        $creation_time   = $request['creation_time'];//创作时间
        $works_time      = $request['works_time'];//作品时长
        $singer          = $request['singer'];//演唱者
        $audio_frequency = $request['audio_frequency'];//音频
        $res=Enroll::enrollSing($u_login_id,$works_name,$school_name,$creation_time,$works_time,$singer,$audio_frequency);
        return $res ?
            json_success('成功!', null, 200) :
            json_fail('失败!', null, 100);
    }

    /**
     * 学生端填报原创歌曲表单
     * @author zqz
     * @param OriginalRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function original(OriginalRequest $request)
    {
        $u_login_id         = $request['u_login_id'];//学生端登录的id
        $school_name        = $request['school_name'];//学校名称
        $works_name         = $request['works_name'];//作品名称
        $creation_time      = $request['creation_time'];//创作时间
        $works_type         = $request['works_type'];//作品类别
        $works_time         = $request['works_time'];//作品时长
        $singer             = $request['singer'];//演唱者
        $words_information  = $request['words_information'];//词作者信息
        $song_information   = $request['song_information'];//曲作者信息
        $leader_information = $request['leader_information'];//项目负责人信息
        $audio_frequency    = $request['audio_frequency'];//音频
        $score              = $request['score'];//歌谱
        $introduction       = $request['introduction'];//作品简介
        $commitment         = $request['commitment'];//版权承诺书

        $res=Enroll::Original($u_login_id,$school_name,$works_name,$creation_time,$works_type, $works_time,$singer,
            $words_information,$song_information,$leader_information,$audio_frequency,$score,$introduction,$commitment);
        return $res ?
            json_success('成功!', null, 200) :
            json_fail('失败!', null, 100);
    }
}
