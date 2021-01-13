<?php
declare (strict_types = 1);

namespace app\admin\controller;

use app\BaseController;
use think\facade\View;
class Login extends BaseController
{
    public function index()
    {
        // return '您好！这是一个[admin]示例应用';
        return View::fetch();

    }
    public function login()
    {
        // return '您好！这是一个[admin]示例应用';
        return View::fetch();
    }
    public function password_md5($password='klwbj'){
        return md5($password.'klwlbj');
    }
    public function check(){
        if(!$this->request->isPost()){
            return show(config('status.error'), 'must post');
        }
        $captcha = $this->request->param('captcha', 'trim');
        $username = $this->request->param('username', 'trim');
        $password = $this->request->param('password', 'trim');
        if(empty($captcha) || empty($username) || empty($password)){
            return show(config('status.error'),'isnull');

        }
        if(!Verify::captcha_check($captcha)){ // 验证码存于session中，需要开启session
            return show(config('status.error'),'captcha eroor');
        }
        // 校验密码等
        // return 'ddd';
        return show(config('status.success'), 'success');
    }
}
