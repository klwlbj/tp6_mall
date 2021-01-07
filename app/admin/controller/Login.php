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
}
