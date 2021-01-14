<?php
declare (strict_types = 1);

namespace app\admin\controller;
use app\BaseController;
use app\admin\controller\AdminBase;
class Index extends AdminBase
{
    public function index()
    {
        // return '您好！这是一个[admin]示例应用';
        return view();
    }
    public function welcome()
    {
        // return '您好！这是一个[admin]示例应用';
        return view();
    }
}
