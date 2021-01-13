<?php

namespace app\admin\controller;

use think\captcha\facade\Captcha;
class Verify
{
    public function index(){
        return Captcha::create('abc');
    }
    public static function captcha_check($value){
        return Captcha::check($value);
    }

}