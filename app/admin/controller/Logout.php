<?php
/**
 * Created by PhpStorm.
 * User: sikwansing
 * Date: 2021/1/14
 * Time: 23:13
 */

namespace app\admin\controller;

use app\admin\controller\AdminBase;
class Logout extends AdminBase
{
    public function index(){
        //消除session
        session(config('admin.session_admin'), null);
        // 执行跳转
        return redirect(url('login/index'));
    }
}