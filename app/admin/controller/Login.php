<?php
declare (strict_types = 1);

namespace app\admin\controller;

use app\BaseController;
use think\facade\View;
use app\admin\controller\AdminBase;

use app\common\model\mysql\AdminUser;
class Login extends AdminBase
{
    public function  initialize()
    {
        return parent::initialize(); // TODO: Change the autogenerated stub
        /*if($this->isLogin()){
            return $this->redirect(url("index/index"));
        }*/
    }

    public function index()
    {
        // return '您好！这是一个[admin]示例应用';
        // $aaa = 1;
        return View::fetch();

    }
    public function login()
    {
        // return '您好！这是一个[admin]示例应用';
        return View::fetch();
    }

    public function check(){
        if(!$this->request->isPost()){
            return show(config('status.error'), 'must post');
        }
        //参数校验 原生或tp6
        $captcha = $this->request->param('captcha', 'trim');
        $username = $this->request->param('username', 'trim');
        $password = $this->request->param('password', 'trim');
        /*if(empty($captcha) || empty($username) || empty($password)){
            return show(config('status.error'),'isnull');

        }*/
        $validate = new \app\admin\validate\AdminUser();
        $data = compact('captcha','username','password');
        if(!$validate->check($data)){
            return show(config('status.error'),$validate->getError());
        }
        /*if(!Verify::captcha_check($captcha)){ // 验证码存于session中，需要开启session
            return show(config('status.error'),'captcha eroor');
        }*/
        // 校验密码等
        $res = \app\admin\business\AdminUser::login($data);
        return $res;
    }























}
