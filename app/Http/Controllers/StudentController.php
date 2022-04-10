<?php


namespace App\Http\Controllers;


use App\Http\Requests\YuanRequest;
use App\Model\enroll;
use App\Model\information;
use Illuminate\Http\Request;


class StudentController extends Controller
{
    /**
     * 节目查看-原创歌曲和传唱歌曲的详情
     */
    public function ShowDetails(YuanRequest $request)
    {
        $id  = $request['enrollId'];
        $pId = enroll::selectCOrY($id);

        if ($pId == 2) {
            $id             = $request['enrollId'];
            $res1           = enroll::ShowCi($id);
            $res2           = enroll::ShowQv($id);
            $res3           = enroll::ShowFz($id);
            $res4           = enroll::ShowYDetails($id);
            $date['ci']     = $res1;
            $date['qv']     = $res2;
            $date['fz']     = $res3;
            $date['enroll'] = $res4;
            return $date ?
                json_success('查看成功!', $date, 200) :
                json_fail('查看失败!', null, 100);
        } else {
            $res = enroll::ShowCDetails($id);
            return $res ?
                json_success('查看成功!', $res, 200) :
                json_fail('查看失败!', null, 100);
        }
    }

    /**
     *查看所有项目enroll
     */
    public function ShowAll()
    {
        $res = enroll::ShowAllMo();
        return $res ?
            json_success('查看成功!', $res, 200) :
            json_fail('查看失败!', null, 100);
    }

    /**
     * 显示所有传唱歌曲的名称
     */
    public function ShowAllCName()
    {
        $res = enroll::selectCWorkName();
        return $res ?
            json_success('显示成功!', $res, 200) :
            json_fail('显示失败!', null, 100);
    }

    /**
     * 修改原唱信息
     */
    public function updateYuan(Request $request)
    {
        //enroll
        $id = $request['data']['enroll'][0]['id'];

        $schoolName     = $request['data']['enroll'][0]['school_name'];
        $worksName      = $request['data']['enroll'][0]['works_name'];
        $creationTime   = $request['data']['enroll'][0]['creation_time'];
        $worksType      = $request['data']['enroll'][0]['works_type'];
        $worksTime      = $request['data']['enroll'][0]['works_time'];
        $singer         = $request['data']['enroll'][0]['singer'];
        $audioFrequency = $request['data']['enroll'][0]['audio_frequency'];
        $score          = $request['data']['enroll'][0]['score'];
        $introduction   = $request['data']['enroll'][0]['introduction'];
        $commitment     = $request['data']['enroll'][0]['commitment'];

        if ($request['data']['qv'] != null) {
            //作曲者信息
            $name1         = $request['data']['qv'][0]['name'];
            $contact1      = $request['data']['qv'][0]['contact'];
            $identityCard1 = $request['data']['qv'][0]['identity_card'];
            information::updateQv($id, $name1, $contact1, $identityCard1);
        }

        if ($request['data']['fz'] != null) {
            //负责人信息
            $name2         = $request['data']['fz'][0]['name'];
            $contact2      = $request['data']['fz'][0]['contact'];
            $identityCard2 = $request['data']['fz'][0]['identity_card'];
        information::updateFz($id, $name2, $contact2, $identityCard2);
        }

        if ($request['data']['ci'] != null) {
            //作词者信息
            $name3         = $request['data']['ci'][0]['name'];
            $contact3      = $request['data']['ci'][0]['contact'];
            $identityCard3 = $request['data']['ci'][0]['identity_card'];
        information::updateCi($id, $name3, $contact3, $identityCard3);
        }

        $res = enroll::updateYuanMo($id, $schoolName, $worksName, $creationTime, $worksType, $worksTime, $singer, $audioFrequency, $score, $introduction, $commitment);



        return $res ?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }


    /**
     * 修改传唱信息
     */
    public function updateChuan(Request $request)
    {

        $id             = $request['id'];
        $worksName      = $request['works_name'];
        $schoolName     = $request['school_name'];
        $creationTime   = $request['creation_time'];
        $worksTime      = $request['works_time'];
        $singer         = $request['singer'];
        $audioFrequency = $request['audio_frequency'];

        $res = enroll::updateChuanMo($id, $worksName, $schoolName, $creationTime, $worksTime, $singer, $audioFrequency);
        return $res ?
            json_success('更新成功!', $res, 200) :
            json_fail('更新失败!', null, 100);
    }


}
