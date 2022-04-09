<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use App\Http\Requests\Change;
use App\Http\Requests\Delete;
use App\Http\Requests\Find;
use App\Http\Requests\State;
use App\Models\AdminLogin;
use App\Models\UsersLogin;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    /**
     * 注册
     * @param Request $registeredRequest
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function registered(Request $registeredRequest)
    {
        $count = AdminLogin::checknumber($registeredRequest);   //检测账号密码是否存在
        if($count == 0)
        {
            $student_id = AdminLogin::createUser(self::userHandle($registeredRequest));
            return  $student_id ?
                json_success('注册成功!',$student_id,200  ) :
                json_fail('注册失败!',null,100  ) ;
        }
        else{
            return
                json_success('注册失败!该工号已经注册过了！',null,100  ) ;
        }
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {

        $credentials = self::credentials($request);   //从前端获取账号密码
        //以手机号登录测试，具体根据自己的业务逻辑
        //    $user = DB::table('users')->first();
        /*   if(!$user){
              $user = new UsersModel();
              $user->phone = $phone;
              $user->save();
          }*/
        //方式一
        // $token = JWTAuth::fromUser($user);
        //方式二
        $token = Auth::guard('admin')->attempt($credentials);   //获取token
//        if(!$token){
//            return response()->json(['error' => 'Unauthorized'],401);
//        }
//        return self::respondWithToken($token, '登录成功!');   //可选择返回方式
        return $token?
            json_success('登录成功!',$token,  200):
            json_fail('登录失败!账号或密码错误',null, 100 ) ;
        //       json_success('登录成功!',$this->respondWithToken($token,$user),  200);
    }

    //封装token的返回方式
    protected function respondWithToken($token, $msg)
    {
        // $data = Auth::user();
        return json_success( $msg, array(
            'token' => $token,
            //设置权限  'token_type' => 'bearer',
            'expires_in' => auth('admin')->factory()->getTTL() * 60
        ),200);
    }
    protected function credentials($request)   //从前端获取账号密码
    {
        return ['username' => $request['username'], 'password' => $request['password']];
    }

    protected function userHandle($request)   //对密码进行哈希256加密
    {
        $registeredInfo = $request->except('password_confirmation');
        $registeredInfo['password'] = bcrypt($registeredInfo['password']);
        $registeredInfo['username'] = $registeredInfo['username'];
        return $registeredInfo;
    }

    /**
     * 修改密码时从新加密
     */
    protected function userHandle111($password)   //对密码进行哈希256加密
    {
        $red = bcrypt($password);
        return $red;
    }
    /**
     * 重置密码
     */
    public function again(Request $registeredRequest)
    {
        $shool_name     = $registeredRequest['shool_name'];
        $newpassword = 123456;

        $password3 = self::userHandle111($newpassword);
        $red = DB::table('u_login')->where('shool_name', '=', $shool_name)->update([
            'password' => $password3
        ]);
        return $red ?
            json_success('重置成功!', $red, 200) :
            json_fail('重置失败!', null, 100);
    }
    /**
     * 查询权限与账号
     */
    public function look()
    {
        $red = DB::table('u_login')->select('u_login.id','u_login.shool_name','jurisdiction.state')
            ->join('jurisdiction','u_login.id','jurisdiction.u_login_id')
            ->get();
        return $red ?
            json_success('查询成功!', $red, 200) :
            json_fail('查询失败!', null, 100);
    }
    /**
     * 查询权限与账号
     */
    public function state(State $request)
    {
        $id = $request['id'];
        $state = DB::table('jurisdiction')->where('u_login_id',$id)->value('state');
        if($state==1)
        {
            $red = DB::table('jurisdiction')->where('u_login_id',$id)->update(
                [
                    'state'=>0
                ]
            );
        $state1 = 1 ;

        }

        else {
            $red = DB::table('jurisdiction')->where('u_login_id', $id)->update(
                [
                    'state' => 1
                ]
            );
            $state1 = 2;
        }
        return $red ?
            json_success('更改成功!', $state1, 200) :
            json_fail('更改失败!', null, 100);
    }
    /**
     * 修改学校名
     */
    public function change(Change $request)
    {
        $id = $request['id'];
        $shool_name = $request['shool_name'];
        $red = UsersLogin::where('id',$id)->update([
            'shool_name'=>$shool_name
        ]);
        return $red ?
            json_success('更改成功!', $red, 200) :
            json_fail('更改失败!', null, 100);
    }
    /**
     * 修改学校名
     */
    public function delete(Delete $request)
    {
        $id = $request['id'];
        $red = UsersLogin::where('id',$id)->delete();
        $res = DB::table('jurisdiction')->where('u_login_id',$id)->delete();
        $date['red'] = $red;
        $date['res'] = $res;
        return $red ?
            json_success('删除成功!', $red, 200) :
            json_fail('删除失败!', null, 100);
    }
    /**
     * 根据姓名查询权限与账号
     */
    public function find(Find $request)
    {
        $shool_name=$request['shool_name'];
        $red = DB::table('u_login')->select('u_login.id','u_login.shool_name','jurisdiction.state')
            ->where('shool_name',$shool_name)
            ->join('jurisdiction','u_login.id','jurisdiction.u_login_id')
            ->get();
        return $red ?
            json_success('查询成功!', $red, 200) :
            json_fail('查询失败!', null, 100);
    }
}
