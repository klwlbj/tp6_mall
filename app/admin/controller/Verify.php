<?php

namespace app\admin\controller;

use think\captcha\facade\Captcha;
class Verify
{
    public function index(){ // 指定admin这个应用开启session，只能走自定义的验证码方法
        return Captcha::create('abc');
    }
    public static function captcha_check($value){
        return Captcha::check($value);
    }

}