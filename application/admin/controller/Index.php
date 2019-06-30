<?php

namespace app\admin\controller;
use think\facade\Session;
use app\admin\model\AdminModel;
use think\Controller;
use think\facade\Request;

class Index extends Controller
{
    public function login()
    {
        return $this->fetch();
    }

    public function dologin()
    {
        $data = Request::param();
        $verifycode = $data['verifycode'];
        if (trim($data['username']) == '') {
            return json(['res' => 1, 'msg' => '用户名不允许为空']);
        }
        if (trim($data['password']) == '') {
            return json(['res' => 1, 'msg' => '密码不能为空']);
        }
        if (!captcha_check($verifycode)) {
            return json(['res' => 1, 'msg' => '验证码错误']);
        }
        $res = AdminModel::where('username', $data['username'])
            ->where('password', $data['password'])->find();
        if ($res['statue'] == 0) {
            Session::set('username',$data['username']);
            return json(['res' => 0, 'msg' => '登录成功']);
        } else {
            return json(['res' => 1, 'msg' => '管理员已被禁用']);
        }
    }


}